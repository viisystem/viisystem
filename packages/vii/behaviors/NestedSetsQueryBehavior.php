<?php
/**
 * JuraKIT (http://www.jurakit.com)
 *
 * @package yii2-nested-sets-mongodb
 * @author Mai Ba Duy <maibaduy@gmail.com>
 * @copyright Copyright (c) 2015 JuraKIT
 * @license http://www.jurakit.com/license
 * @version 1.0.0
 * @link https://github.com/maibaduy/yii2-nested-sets-mongodb
 */

namespace vii\behaviors;

use yii\base\Behavior;
use yii\db\Expression;

/**
 * NestedSetsQueryBehavior
 *
 * @property \yii\db\ActiveQuery $owner
 *
 * @author Alexander Kochetov <creocoder@gmail.com>
 */
class NestedSetsQueryBehavior extends Behavior
{
    /**
     * Gets the root nodes.
     * @return \yii\db\ActiveQuery the owner
     */
    public function roots()
    {
        $model = new $this->owner->modelClass();

        $this->owner
            ->andWhere([$model->leftAttribute => 1])
            ->addOrderBy([$model->primaryKey()[0] => SORT_ASC]);

        return $this->owner;
    }

    /**
     * Gets the leaf nodes.
     * @return \yii\db\ActiveQuery the owner
     */
    public function leaves()
    {
        $model = new $this->owner->modelClass();
        $db = $model->getDb();

        $columns = [$model->leftAttribute => SORT_ASC];

        if ($model->treeAttribute !== false) {
            $columns = [$model->treeAttribute => SORT_ASC] + $columns;
        }

        // // jurakit
        // $this->owner
        //     ->andWhere([$model->rightAttribute => new Expression($db->quoteColumnName($model->leftAttribute) . '+ 1')])
        //     ->addOrderBy($columns);
        //var_dump(new Expression($model->leftAttribute . '+ 1')); die;
        $this->owner
            ->andWhere(['$where' => "this.{$model->rightAttribute} = this.{$model->leftAttribute} + 1"])
            ->addOrderBy($columns);

        return $this->owner;
    }
}
