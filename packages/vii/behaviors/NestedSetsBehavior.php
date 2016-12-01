<?php
/**
 * @link https://github.com/maibaduy/yii2-nested-sets-mongodb
 */

namespace vii\behaviors;

use yii\base\Behavior;
use yii\base\NotSupportedException;
use yii\mongodb\ActiveRecord; //use yii\db\ActiveRecord;
use yii\db\Exception;

/**
 * NestedSetsBehavior
 *
 * @property ActiveRecord $owner
 */
class NestedSetsBehavior extends Behavior
{
    const OPERATION_MAKE_ROOT = 'makeRoot';
    const OPERATION_PREPEND_TO = 'prependTo';
    const OPERATION_APPEND_TO = 'appendTo';
    const OPERATION_INSERT_BEFORE = 'insertBefore';
    const OPERATION_INSERT_AFTER = 'insertAfter';
    const OPERATION_DELETE_WITH_CHILDREN = 'deleteWithChildren';

    /**
     * @var string|false
     */
    public $rootAttribute = 'root'; //false
    /**
     * @var string
     */
    public $leftAttribute = 'lft';
    /**
     * @var string
     */
    public $rightAttribute = 'rgt';
    /**
     * @var string
     */
    public $depthAttribute = 'depth';
    /**
     * @var string|null
     */
    protected $operation;
    /**
     * @var ActiveRecord|null
     */
    protected $node;

    /**
     * @inheritdoc
     */
    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_INSERT => 'beforeInsert',
            ActiveRecord::EVENT_AFTER_INSERT => 'afterInsert',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'beforeUpdate',
            ActiveRecord::EVENT_AFTER_UPDATE => 'afterUpdate',
            ActiveRecord::EVENT_BEFORE_DELETE => 'beforeDelete',
            ActiveRecord::EVENT_AFTER_DELETE => 'afterDelete',
        ];
    }

    /**
     * Creates the root node if the active record is new or moves it
     * as the root node.
     * @param boolean $runValidation
     * @param array $attributes
     * @return boolean
     */
    public function makeRoot($runValidation = true, $attributes = null)
    {
        $this->operation = self::OPERATION_MAKE_ROOT;

        return $this->owner->save($runValidation, $attributes);
    }

    /**
     * Creates a node as the first child of the target node if the active
     * record is new or moves it as the first child of the target node.
     * @param ActiveRecord $node
     * @param boolean $runValidation
     * @param array $attributes
     * @return boolean
     */
    public function prependTo($node, $runValidation = true, $attributes = null)
    {
        $this->operation = self::OPERATION_PREPEND_TO;
        $this->node = $node;

        return $this->owner->save($runValidation, $attributes);
    }

    /**
     * Creates a node as the last child of the target node if the active
     * record is new or moves it as the last child of the target node.
     * @param ActiveRecord $node
     * @param boolean $runValidation
     * @param array $attributes
     * @return boolean
     */
    public function appendTo($node, $runValidation = true, $attributes = null)
    {
        $this->operation = self::OPERATION_APPEND_TO;
        $this->node = $node;

        return $this->owner->save($runValidation, $attributes);
    }

    /**
     * Creates a node as the previous sibling of the target node if the active
     * record is new or moves it as the previous sibling of the target node.
     * @param ActiveRecord $node
     * @param boolean $runValidation
     * @param array $attributes
     * @return boolean
     */
    public function insertBefore($node, $runValidation = true, $attributes = null)
    {
        $this->operation = self::OPERATION_INSERT_BEFORE;
        $this->node = $node;

        return $this->owner->save($runValidation, $attributes);
    }

    /**
     * Creates a node as the next sibling of the target node if the active
     * record is new or moves it as the next sibling of the target node.
     * @param ActiveRecord $node
     * @param boolean $runValidation
     * @param array $attributes
     * @return boolean
     */
    public function insertAfter($node, $runValidation = true, $attributes = null)
    {
        $this->operation = self::OPERATION_INSERT_AFTER;
        $this->node = $node;

        return $this->owner->save($runValidation, $attributes);
    }

    /**
     * Deletes a node and its children.
     * @return integer|false the number of rows deleted or false if
     * the deletion is unsuccessful for some reason.
     * @throws \Exception
     */
//    public function deleteWithChildren()
//    {
//        $this->operation = self::OPERATION_DELETE_WITH_CHILDREN;
//
//        if (!$this->owner->isTransactional(ActiveRecord::OP_DELETE)) {
//            return $this->deleteWithChildrenInternal();
//        }
//
//        $transaction = $this->owner->getDb()->beginTransaction();
//
//        try {
//            $result = $this->deleteWithChildrenInternal();
//
//            if ($result === false) {
//                $transaction->rollBack();
//            } else {
//                $transaction->commit();
//            }
//
//            return $result;
//        } catch (\Exception $e) {
//            $transaction->rollBack();
//            throw $e;
//        }
//    }
    public function deleteWithChildren()
    {
        $this->operation = self::OPERATION_DELETE_WITH_CHILDREN;

        try {
            return $this->deleteWithChildrenInternal();
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * @return integer|false the number of rows deleted or false if
     * the deletion is unsuccessful for some reason.
     */
    protected function deleteWithChildrenInternal()
    {
        if (!$this->owner->beforeDelete()) {
            return false;
        }

        $condition = [
            'and',
            [$this->leftAttribute => ['$gte' => $this->owner->getAttribute($this->leftAttribute)]],
            [$this->rightAttribute => ['$lte' => $this->owner->getAttribute($this->rightAttribute)]],
        ];


        $this->applyTreeAttributeCondition($condition);
        $result = $this->owner->deleteAll($condition);
        $this->owner->setOldAttributes(null);
        $this->owner->afterDelete();

        return $result;
    }

    /**
     * Gets the parents of the node.
     * @param integer|null $depth the depth
     * @return \yii\db\ActiveQuery
     */
    public function parents($depth = null)
    {
        $condition = [
            'and',
            [$this->leftAttribute => ['$lt' => $this->owner->getAttribute($this->leftAttribute)]],
            [$this->rightAttribute => ['$gt' => $this->owner->getAttribute($this->rightAttribute)]],
        ];

        if ($depth !== null) {
            $condition[] = [$this->depthAttribute => ['$gte' => $this->owner->getAttribute($this->depthAttribute) - $depth]];
        }

        $this->applyTreeAttributeCondition($condition);

        return $this->owner->find()->andWhere($condition)->addOrderBy([$this->leftAttribute => SORT_ASC]);
    }

    /**
     * Gets the children of the node.
     * @param integer|null $depth the depth
     * @return \yii\db\ActiveQuery
     */
    public function children($depth = null)
    {
        $condition = [
            'and',
            [$this->leftAttribute => ['$gt' => $this->owner->getAttribute($this->leftAttribute)]],
            [$this->rightAttribute => ['$lt' => $this->owner->getAttribute($this->rightAttribute)]],
        ];        

        if ($depth !== null) {
            $condition[] = [$this->depthAttribute => ['$lte' => $this->owner->getAttribute($this->depthAttribute) + $depth]];
        }

        $this->applyTreeAttributeCondition($condition);

        return $this->owner->find()->andWhere($condition)->addOrderBy([$this->leftAttribute => SORT_ASC]);
    }

    /**
     * Gets the leaves of the node.
     * @return \yii\db\ActiveQuery
     */
    public function leaves()
    {
        $condition = [
            'and',
            [$this->leftAttribute => ['$gt' => $this->owner->getAttribute($this->leftAttribute)]],
            [$this->rightAttribute => ['$lt' => $this->owner->getAttribute($this->rightAttribute)]],
            ['$where' => "this.{$this->rightAttribute} = this.{$this->leftAttribute} + 1"]
        ];

        $this->applyTreeAttributeCondition($condition);

        return $this->owner->find()->andWhere($condition)->addOrderBy([$this->leftAttribute => SORT_ASC]);
    }

    /**
     * Gets the previous sibling of the node.
     * @return \yii\db\ActiveQuery
     */
    public function prev()
    {
        $condition = [$this->rightAttribute => $this->owner->getAttribute($this->leftAttribute) - 1];
        $this->applyTreeAttributeCondition($condition);

        return $this->owner->find()->andWhere($condition);
    }

    /**
     * Gets the next sibling of the node.
     * @return \yii\db\ActiveQuery
     */
    public function next()
    {
        $condition = [$this->leftAttribute => $this->owner->getAttribute($this->rightAttribute) + 1];
        $this->applyTreeAttributeCondition($condition);

        return $this->owner->find()->andWhere($condition);
    }

    /**
     * Determines whether the node is root.
     * @return boolean whether the node is root
     */
    public function isRoot()
    {
        return $this->owner->getAttribute($this->leftAttribute) == 1;
    }

    /**
     * Determines whether the node is child of the parent node.
     * @param ActiveRecord $node the parent node
     * @return boolean whether the node is child of the parent node
     */
    public function isChildOf($node)
    {
        $result = $this->owner->getAttribute($this->leftAttribute) > $node->getAttribute($this->leftAttribute)
            && $this->owner->getAttribute($this->rightAttribute) < $node->getAttribute($this->rightAttribute);

        if ($result && $this->rootAttribute !== false) {
            $result = $this->owner->getAttribute($this->rootAttribute) === $node->getAttribute($this->rootAttribute);
        }

        return $result;
    }

    /**
     * Determines whether the node is leaf.
     * @return boolean whether the node is leaf
     */
    public function isLeaf()
    {
        return $this->owner->getAttribute($this->rightAttribute) - $this->owner->getAttribute($this->leftAttribute) === 1;
    }

    /**
     * @throws NotSupportedException
     */
    public function beforeInsert()
    {
        if ($this->node !== null && !$this->node->getIsNewRecord()) {
            $this->node->refresh();
        }

        switch ($this->operation) {
            case self::OPERATION_MAKE_ROOT:
                $this->beforeInsertRootNode();
                break;
            case self::OPERATION_PREPEND_TO:
                $this->beforeInsertNode($this->node->getAttribute($this->leftAttribute) + 1, 1);
                break;
            case self::OPERATION_APPEND_TO:
                $this->beforeInsertNode($this->node->getAttribute($this->rightAttribute), 1);
                break;
            case self::OPERATION_INSERT_BEFORE:
                $this->beforeInsertNode($this->node->getAttribute($this->leftAttribute), 0);
                break;
            case self::OPERATION_INSERT_AFTER:
                $this->beforeInsertNode($this->node->getAttribute($this->rightAttribute) + 1, 0);
                break;
            default:
                throw new NotSupportedException('Method "'. get_class($this->owner) . '::insert" is not supported for inserting new nodes.');
        }
    }

    /**
     * @throws Exception
     */
    protected function beforeInsertRootNode()
    {
        if ($this->rootAttribute === false && $this->owner->find()->roots()->exists()) {
            throw new Exception('Can not create more than one root when "rootAttribute" is false.');
        }

        $this->owner->setAttribute($this->leftAttribute, 1);
        $this->owner->setAttribute($this->rightAttribute, 2);
        $this->owner->setAttribute($this->depthAttribute, 0);
    }

    /**
     * @param integer $value
     * @param integer $depth
     * @throws Exception
     */
    protected function beforeInsertNode($value, $depth)
    {
        if ($this->node->getIsNewRecord()) {
            throw new Exception('Can not create a node when the target node is new record.');
        }

        if ($depth === 0 && $this->node->isRoot()) {
            throw new Exception('Can not create a node when the target node is root.');
        }

        $this->owner->setAttribute($this->leftAttribute, $value);
        $this->owner->setAttribute($this->rightAttribute, $value + 1);
        $this->owner->setAttribute($this->depthAttribute, $this->node->getAttribute($this->depthAttribute) + $depth);

        if ($this->rootAttribute !== false) {
            $this->owner->setAttribute($this->rootAttribute, $this->node->getAttribute($this->rootAttribute));
        }

        $this->shiftLeftRightAttribute($value, 2);
    }

    /**
     * @throws Exception
     */
    public function afterInsert()
    {
        if ($this->operation === self::OPERATION_MAKE_ROOT && $this->rootAttribute !== false) {
            $this->owner->setAttribute($this->rootAttribute, $this->owner->getPrimaryKey());
            $primaryKey = $this->owner->primaryKey();

            if (!isset($primaryKey[0])) {
                throw new Exception('"' . get_class($this->owner) . '" must have a primary key.');
            }

            $this->owner->updateAll(
                [$this->rootAttribute => $this->owner->getAttribute($this->rootAttribute)],
                [$primaryKey[0] => $this->owner->getAttribute($this->rootAttribute)]
            );
        }

        $this->operation = null;
        $this->node = null;
    }

    /**
     * @throws Exception
     */
    public function beforeUpdate()
    {
        if ($this->node !== null && !$this->node->getIsNewRecord()) {
            $this->node->refresh();
        }

        switch ($this->operation) {
            case self::OPERATION_MAKE_ROOT:
                if ($this->rootAttribute === false) {
                    throw new Exception('Can not move a node as the root when "rootAttribute" is false.');
                }

                if ($this->owner->isRoot()) {
                    throw new Exception('Can not move the root node as the root.');
                }

                break;
            case self::OPERATION_INSERT_BEFORE:
            case self::OPERATION_INSERT_AFTER:
                if ($this->node->isRoot()) {
                    throw new Exception('Can not move a node when the target node is root.');
                }
            case self::OPERATION_PREPEND_TO:
            case self::OPERATION_APPEND_TO:
                if ($this->node->getIsNewRecord()) {
                    throw new Exception('Can not move a node when the target node is new record.');
                }

                if ($this->owner->equals($this->node)) {
                    throw new Exception('Can not move a node when the target node is same.');
                }

                if ($this->node->isChildOf($this->owner)) {
                    throw new Exception('Can not move a node when the target node is child.');
                }
        }
    }

    /**
     * @return void
     */
    public function afterUpdate()
    {
        switch ($this->operation) {
            case self::OPERATION_MAKE_ROOT:
                $this->moveNodeAsRoot();
                break;
            case self::OPERATION_PREPEND_TO:
                $this->moveNode($this->node->getAttribute($this->leftAttribute) + 1, 1);
                break;
            case self::OPERATION_APPEND_TO:
                $this->moveNode($this->node->getAttribute($this->rightAttribute), 1);
                break;
            case self::OPERATION_INSERT_BEFORE:
                $this->moveNode($this->node->getAttribute($this->leftAttribute), 0);
                break;
            case self::OPERATION_INSERT_AFTER:
                $this->moveNode($this->node->getAttribute($this->rightAttribute) + 1, 0);
                break;
            default:
                return;
        }

        $this->operation = null;
        $this->node = null;
    }

    /**
     * @return void
     */
    protected function moveNodeAsRoot()
    {
        $db = $this->owner->getDb();
        $leftValue = $this->owner->getAttribute($this->leftAttribute);
        $rightValue = $this->owner->getAttribute($this->rightAttribute);
        $depthValue = $this->owner->getAttribute($this->depthAttribute);
        $rootValue = $this->owner->getAttribute($this->rootAttribute);

        $this->owner->updateAll(
            [
                '$inc' => [
                    $this->leftAttribute => (1 - $leftValue),
                    $this->rightAttribute => (1 - $leftValue),
                    $this->depthAttribute => (-$depthValue),
                ],
                '$set' => [
                    $this->rootAttribute => $this->owner->getPrimaryKey()
                ],
            ],
            [
                'and',
                [$this->leftAttribute => ['$gte' => $leftValue]],
                [$this->rightAttribute => ['$lte' => $rightValue]],
                [$this->rootAttribute => $rootValue]
            ]
        );

        $this->shiftLeftRightAttribute($rightValue + 1, $leftValue - $rightValue - 1);
    }

    /**
     * @param integer $value
     * @param integer $depth
     */
    protected function moveNode($value, $depth)
    {
        $db = $this->owner->getDb();
        $leftValue = $this->owner->getAttribute($this->leftAttribute);
        $rightValue = $this->owner->getAttribute($this->rightAttribute);
        $depthValue = $this->owner->getAttribute($this->depthAttribute);

        $depth = $this->node->getAttribute($this->depthAttribute) - $depthValue + $depth;

        if ($this->rootAttribute === false
            || $this->owner->getAttribute($this->rootAttribute) === $this->node->getAttribute($this->rootAttribute)) {
            $delta = $rightValue - $leftValue + 1;
            $this->shiftLeftRightAttribute($value, $delta);

            if ($leftValue >= $value) {
                $leftValue += $delta;
                $rightValue += $delta;
            }

            $condition = [
                'and',
                [$this->leftAttribute => ['$gte' => $leftValue]],
                [$this->rightAttribute => ['$lte' => $rightValue]],
            ];

            $this->applyTreeAttributeCondition($condition);

            $this->owner->updateAll(
                [
                    '$inc' => [
                        $this->depthAttribute => $depth,
                    ]
                ],
                $condition
            );

            foreach ([$this->leftAttribute, $this->rightAttribute] as $attribute) {
                $condition = [
                    'and',
                    [$attribute => ['$gte' => $leftValue]],
                    [$attribute => ['$lte' => $rightValue]],
                ];


                $this->applyTreeAttributeCondition($condition);

                $this->owner->updateAll(
                    [
                        '$inc' => [
                            $attribute => $value - $leftValue,
                        ]
                    ],
                    $condition
                );
            }

            $this->shiftLeftRightAttribute($rightValue + 1, -$delta);
        } else {
            $nodeRootValue = $this->node->getAttribute($this->rootAttribute);

            foreach ([$this->leftAttribute, $this->rightAttribute] as $attribute) {
                $this->owner->updateAll(
                    [
                        '$inc' => [
                            $attribute => $rightValue - $leftValue + 1,
                        ]
                    ],
                    [
                        'and',
                        [$attribute => ['$gte' => $value]],
                        [$this->rootAttribute => $nodeRootValue]
                    ]
                );
            }

            $delta = $value - $leftValue;

            $this->owner->updateAll(
                [
                    '$inc' => [
                        $this->leftAttribute => $delta,
                        $this->rightAttribute => $delta,
                        $this->depthAttribute => $depth,
                    ],
                    '$set' => [
                        $this->rootAttribute => $nodeRootValue
                    ],
                ],
                [
                    'and',
                    [$this->leftAttribute => ['$gte' => $leftValue]],
                    [$this->rightAttribute => ['$lte' => $rightValue]],
                    [$this->rootAttribute => $this->owner->getAttribute($this->rootAttribute)],
                ]
            );

            $this->shiftLeftRightAttribute($rightValue + 1, $leftValue - $rightValue - 1);
        }
    }

    /**
     * @throws Exception
     * @throws NotSupportedException
     */
    public function beforeDelete()
    {
        if ($this->owner->getIsNewRecord()) {
            throw new Exception('Can not delete a node when it is new record.');
        }

        if ($this->owner->isRoot() && $this->operation !== self::OPERATION_DELETE_WITH_CHILDREN) {
            throw new NotSupportedException('Method "'. get_class($this->owner) . '::delete" is not supported for deleting root nodes.');
        }

        $this->owner->refresh();
    }

    /**
     * @return void
     */
    public function afterDelete()
    {
        $leftValue = $this->owner->getAttribute($this->leftAttribute);
        $rightValue = $this->owner->getAttribute($this->rightAttribute);

        if ($this->owner->isLeaf() || $this->operation === self::OPERATION_DELETE_WITH_CHILDREN) {
            $this->shiftLeftRightAttribute($rightValue + 1, $leftValue - $rightValue - 1);
        } else {
            $condition = [
                'and',
                [$this->leftAttribute => ['$gte' => $this->owner->getAttribute($this->leftAttribute)]],
                [$this->rightAttribute => ['$lte' => $this->owner->getAttribute($this->rightAttribute)]],
            ];

            $this->applyTreeAttributeCondition($condition);
            $db = $this->owner->getDb();

            $this->owner->updateAll(
                [
                    '$inc' => [
                        $this->leftAttribute => -1,
                        $this->rightAttribute => -1,
                        $this->depthAttribute => -1,
                    ]
                ],
                $condition
            );

            $this->shiftLeftRightAttribute($rightValue + 1, -2);
        }

        $this->operation = null;
        $this->node = null;
    }

    /**
     * @param integer $value
     * @param integer $delta
     */
    protected function shiftLeftRightAttribute($value, $delta)
    {
        $db = $this->owner->getDb();

        foreach ([$this->leftAttribute, $this->rightAttribute] as $attribute) {
            $condition = [$attribute => ['$gte' => $value]];
            
            $this->applyTreeAttributeCondition($condition);
            
            $this->owner->updateAll(                
                [
                    '$inc' => [
                        $attribute => $delta
                    ],
                ]
                ,
                $condition
            );
        }
    }

    /**
     * @param array $condition
     */
    protected function applyTreeAttributeCondition(&$condition)
    {
        if ($this->rootAttribute !== false) {
            $condition = [
                'and',
                $condition,
                [$this->rootAttribute => $this->owner->getAttribute($this->rootAttribute)]
            ];
        }

    }
}
