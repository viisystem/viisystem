<?php
use vii\helpers\Html;
use vii\helpers\Url;

use app\packages\category\models\Category;

/** @var \app\packages\category\models\Category $modelItem */

$gridId = 'category-grid';
$controllerId = Yii::$app->controller->controllerId;

$html = '';
$depth = 0;
foreach ($modelItem as $n => $item) {
    if ($item->depth == $depth)
        $html .= Html::endTag('li');
    else if ($item->depth > $depth)
        $html .= Html::beginTag('ol', ['class' => ($depth == 0) ? 'ui-sortable mjs-nestedSortable-branch mjs-nestedSortable-expanded' : '']);
    else {
        $html .= Html::endTag('li');

        //you write for($i=$depth-$model->depth;$i;$i--) but we don't have $model, we have $item
        for ($i = $depth - $item->depth; $i; $i--) {
            $html .= Html::endTag('ol');
            $html .= Html::endTag('li');
        }
    }

    $html .= Html::beginTag('li', array('id' => "nestsortable-item-{$item->getId()}", 'class' => 'nestsortable-wrap mjs-nestedSortable-branch mjs-nestedSortable-expanded', 'data-url' => Url::to(["{$controllerId}/item-move", 'id' => $model->getId(), 'item' => $item->getId()])));
    $html .= '
            <div class="nestsortable-item clearfix">
                <div class="pull-left">
                    <span title="Click to show/hide children" class="nestsortable-item-close ui-icon ui-icon-minusthick"></span>
                    <span>'.Html::encode($item->title).'</span>
                </div>
                <div class="pull-right">
                    <a href="javascript:" class="grid-action" data-class="body-full" data-url="'.Url::to(["{$controllerId}/item-insert", 'id' => $model->getId(), 'item' => $item->getId(), 'operation' => Category::OPERATION_APPEND_TO]).'" data-id="' . $gridId . '" data-ajax-container="nestsortable-container" data-func-success="jurakit.nestsortable.init()" onclick="jurakit.form.modal($(this)); return false"><i class="fa fa-plus-square-o"></i></a>
                    <a href="javascript:" class="grid-action" data-class="body-full" data-url="'.Url::to(["{$controllerId}/item-update", 'id' => $model->getId(), 'item' => $item->getId()]).'" data-id="' . $gridId . '" data-ajax-container="nestsortable-container" data-func-success="jurakit.nestsortable.init()" onclick="jurakit.form.modal($(this)); return false"><i class="fa fa-pencil-square-o"></i></a>
                    <a href="javascript:" class="grid-action" data-class="body-full" data-url="'.Url::to(["{$controllerId}/item-delete", 'id' => $model->getId(), 'item' => $item->getId()]).'" data-id="' . $gridId . '" data-ajax-container="nestsortable-container" data-func-success="jurakit.nestsortable.init()" onclick="jurakit.grid.delete($(this)); return false"><i class="fa fa-trash-o"></i></a>

                    <div class="btn-group">
                        <div class="dropdown dropdown-auto">
                            <a href="javascript:" class="grid-action dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bars"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="javascript:" class="dropdown-item" data-class="body-full" data-url="'.Url::to(["{$controllerId}/item-insert", 'id' => $model->getId(), 'item' => $item->getId(), 'operation' => Category::OPERATION_INSERT_BEFORE]).'" data-id="' . $gridId . '" data-ajax-container="nestsortable-container" data-func-success="jurakit.nestsortable.init()" onclick="jurakit.form.modal($(this)); return false">'.Yii::t('category', 'Add before').'</a>
                                <a href="javascript:" class="dropdown-item" data-class="body-full" data-url="'.Url::to(["{$controllerId}/item-insert", 'id' => $model->getId(), 'item' => $item->getId(), 'operation' => Category::OPERATION_INSERT_AFTER]).'" data-id="' . $gridId . '" data-ajax-container="nestsortable-container" data-func-success="jurakit.nestsortable.init()" onclick="jurakit.form.modal($(this)); return false">'.Yii::t('category', 'Add after').'</a>
                                <a href="javascript:" class="dropdown-item" data-class="body-full" data-url="'.Url::to(["{$controllerId}/item-insert", 'id' => $model->getId(), 'item' => $item->getId(), 'operation' => Category::OPERATION_PREPEND_TO]).'" data-id="' . $gridId . '" data-ajax-container="nestsortable-container" data-func-success="jurakit.nestsortable.init()" onclick="jurakit.form.modal($(this)); return false">'.Yii::t('category', 'Add first child').'</a>
                                <a href="javascript:" class="dropdown-item" data-class="body-full" data-url="'.Url::to(["{$controllerId}/item-insert", 'id' => $model->getId(), 'item' => $item->getId(), 'operation' => Category::OPERATION_APPEND_TO]).'" data-id="' . $gridId . '" data-ajax-container="nestsortable-container" data-func-success="jurakit.nestsortable.init()" onclick="jurakit.form.modal($(this)); return false">'.Yii::t('category', 'Add last child').'</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        ';
    $depth = $item->depth;
}

for ($i = $depth; $i; $i--) {
    $html .= Html::endTag('li') . "\n";
    $html .= Html::endTag('ol') . "\n";
}

echo $html;

// Table
// ArrayHelper::toArray() not support MongoDB
//$modelItemArray = [
//    [
//        'id' => $model->getId(),
//        'title' => $model->title,
//        'lft' => $model->lft,
//        'rgt' => $model->rgt,
//        'depth' => $model->depth,
//        'root' => (string) $model->root
//    ]
//];
//foreach ($modelItem as $item) {
//    $modelItemArray[] = [
//        'id' => (string) $item->_id,
//        'title' => $item->title,
//        'lft' => $item->lft,
//        'rgt' => $item->rgt,
//        'depth' => $item->depth,
//        'root' => (string) $item->root
//    ];
//}
//$dataProvider = new ArrayDataProvider([
//    'allModels' => $modelItemArray,
//    'pagination' => [
//        'pageSize' => 50,
//    ],
//]);
//echo GridView::widget([
//    'dataProvider' => $dataProvider,
//    'options' => [
//        'style' => 'margin-top:50px'
//    ]
//]);
