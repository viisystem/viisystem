<?php
use vii\widgets\ActiveForm;

$modelEntity = \Yii::createObject($paramsConfig['entityClass']);
$modelEntity->category_ids = array_merge($paramsConfig['selection'], [$modelItem->getId()]);

/* @var $this yii\web\View */
/* @var $modelItem app\packages\category\models\Category */
/* @var $modelEntity vii\post\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<!--
<?php $form = ActiveForm::begin() ?>
-->

<?= $form->field($modelEntity, 'category_ids')->checkboxList($modelEntity->getCategory()->getOptions()) ?>

<!--
<?php ActiveForm::end() ?>
-->
