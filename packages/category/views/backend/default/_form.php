<?php

use vii\helpers\DataHelper;
use vii\helpers\Html;
use vii\helpers\Url;
use vii\widgets\Select;

use yii\bootstrap\ActiveForm;

\vii\assets\NestsortableAsset::register($this);
\vii\assets\JurakitAsset::register($this);


$gridId = 'category-grid';
$controllerId = Yii::$app->controller->controllerId;

/* @var $this yii\web\View */
/* @var $model app\packages\category\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ibox-content m-b-sm border-bottom">
    <?php $form = ActiveForm::begin(['layout' => 'default']); ?>

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'title') ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'lookup_id') ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'language')->widget(Select::className(), ['data' => DataHelper::getLanguageOptions()]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'is_active')->widget(Select::className()) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('category', 'Create') : Yii::t('category', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<div class="ibox-content m-b-sm border-bottom">
    <?php if (!$model->isNewRecord) : ?>
        <div class="card card-clean m-t-5">
            <div class="card-header">
                <div class="card-ctrl">
                    <a class="card-ctrl-item" data-tooltip="tooltip" data-placement="left" title="<?= Yii::t('category', 'Create Category Item') ?>" href="javascript:" data-class="body-full" data-url="<?= Url::to(["{$controllerId}/item-create", 'id' => $model->getId()]) ?>" data-ajax-container="nestsortable-container" data-func-success="jurakit.nestsortable.init()" onclick="jurakit.form.modal($(this)); return false"><i class="fa fa-plus"></i></a>
                </div>
            </div>
            <div class="p-20 bg4">
                <div id="nestsortable-container" class="bg4 nestsortable-container">
                    <?php echo $this->render('/backend/category/itemList', ['model' => $model, 'modelItem' => $model->items]); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<div class="category-form">

    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>All form elements <small>With custom checbox and radion elements.</small></h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-wrench"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="#">Config option 1</a>
                    </li>
                    <li><a href="#">Config option 2</a>
                    </li>
                </ul>
                <a class="close-link">
                    <i class="fa fa-times"></i>
                </a>
            </div>
        </div>
        <div class="ibox-content">

            <div class="tabs-container">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#tab-1"> This is tab</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-2">This is second tab</a></li>
                </ul>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane active">
                        <div class="panel-body">
                            <strong>Lorem ipsum dolor sit amet, consectetuer adipiscing</strong>

                            <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of
                                existence in this spot, which was created for the bliss of souls like mine.</p>

                            <p>I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at
                                the present moment; and yet I feel that I never was a greater artist than now. When.</p>
                        </div>
                    </div>
                    <div id="tab-2" class="tab-pane">
                        <div class="panel-body">
                            <strong>Donec quam felis</strong>

                            <p>Thousand unknown plants are noticed by me: when I hear the buzz of the little world among the stalks, and grow familiar with the countless indescribable forms of the insects
                                and flies, then I feel the presence of the Almighty, who formed us in his own image, and the breath </p>

                            <p>I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite
                                sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet.</p>
                        </div>
                    </div>
                </div>


            </div>



            <form method="get" class="form-horizontal">
                <div class="form-group"><label class="col-sm-2 control-label">Normal</label>

                    <div class="col-sm-10"><input class="form-control" type="text"></div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group"><label class="col-sm-2 control-label">Help text</label>
                    <div class="col-sm-10"><input class="form-control" type="text"> <span class="help-block m-b-none">A block of help text that breaks onto a new line and may extend beyond one line.</span>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group"><label class="col-sm-2 control-label">Password</label>

                    <div class="col-sm-10"><input class="form-control" name="password" type="password"></div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group"><label class="col-sm-2 control-label">Placeholder</label>

                    <div class="col-sm-10"><input placeholder="placeholder" class="form-control" type="text"></div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group"><label class="col-lg-2 control-label">Disabled</label>

                    <div class="col-lg-10"><input disabled="" placeholder="Disabled input here..." class="form-control" type="text"></div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group"><label class="col-lg-2 control-label">Static control</label>

                    <div class="col-lg-10"><p class="form-control-static">email@example.com</p></div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group"><label class="col-sm-2 control-label">Checkboxes and radios <br>
                        <small class="text-navy">Normal Bootstrap elements</small></label>

                    <div class="col-sm-10">
                        <div><label> <input value="" type="checkbox"> Option one is this and that&mdash;be sure to include why it's great </label></div>
                        <div><label> <input checked="" value="option1" id="optionsRadios1" name="optionsRadios" type="radio"> Option one is this and that&mdash;be sure to
                                include why it's great </label></div>
                        <div><label> <input value="option2" id="optionsRadios2" name="optionsRadios" type="radio"> Option two can be something else and selecting it will
                                deselect option one </label></div>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group"><label class="col-sm-2 control-label">Inline checkboxes</label>

                    <div class="col-sm-10"><label class="checkbox-inline"> <input value="option1" id="inlineCheckbox1" type="checkbox"> a </label> <label class="checkbox-inline">
                            <input value="option2" id="inlineCheckbox2" type="checkbox"> b </label> <label class="checkbox-inline">
                            <input value="option3" id="inlineCheckbox3" type="checkbox"> c </label></div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group"><label class="col-sm-2 control-label">Checkboxes &amp; radios <br><small class="text-navy">Custom elements</small></label>

                    <div class="col-sm-10">
                        <div class="i-checks"><label> <div class="icheckbox_square-green" style="position: relative;"><input value="" style="position: absolute; opacity: 0;" type="checkbox"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div> <i></i> Option one </label></div>
                        <div class="i-checks"><label> <div class="icheckbox_square-green checked" style="position: relative;"><input value="" checked="" style="position: absolute; opacity: 0;" type="checkbox"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div> <i></i> Option two checked </label></div>
                        <div class="i-checks"><label> <div class="icheckbox_square-green checked disabled" style="position: relative;"><input value="" disabled="" checked="" style="position: absolute; opacity: 0;" type="checkbox"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div> <i></i> Option three checked and disabled </label></div>
                        <div class="i-checks"><label> <div class="icheckbox_square-green disabled" style="position: relative;"><input value="" disabled="" style="position: absolute; opacity: 0;" type="checkbox"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div> <i></i> Option four disabled </label></div>
                        <div class="i-checks"><label> <div class="iradio_square-green" style="position: relative;"><input value="option1" name="a" style="position: absolute; opacity: 0;" type="radio"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div> <i></i> Option one </label></div>
                        <div class="i-checks"><label> <div class="iradio_square-green checked" style="position: relative;"><input checked="" value="option2" name="a" style="position: absolute; opacity: 0;" type="radio"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div> <i></i> Option two checked </label></div>
                        <div class="i-checks"><label> <div class="iradio_square-green checked disabled" style="position: relative;"><input disabled="" checked="" value="option2" style="position: absolute; opacity: 0;" type="radio"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div> <i></i> Option three checked and disabled </label></div>
                        <div class="i-checks"><label> <div class="iradio_square-green disabled" style="position: relative;"><input disabled="" name="a" style="position: absolute; opacity: 0;" type="radio"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div> <i></i> Option four disabled </label></div>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group"><label class="col-sm-2 control-label">Inline checkboxes</label>

                    <div class="col-sm-10"><label class="checkbox-inline i-checks"> <div class="icheckbox_square-green" style="position: relative;"><input value="option1" style="position: absolute; opacity: 0;" type="checkbox"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div>a </label>
                        <label class="checkbox-inline i-checks"> <div class="icheckbox_square-green" style="position: relative;"><input value="option2" style="position: absolute; opacity: 0;" type="checkbox"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div> b </label>
                        <label class="checkbox-inline i-checks"> <div class="icheckbox_square-green" style="position: relative;"><input value="option3" style="position: absolute; opacity: 0;" type="checkbox"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div> c </label></div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group"><label class="col-sm-2 control-label">Select</label>

                    <div class="col-sm-10"><select class="form-control m-b" name="account">
                            <option>option 1</option>
                            <option>option 2</option>
                            <option>option 3</option>
                            <option>option 4</option>
                        </select>

                        <div class="col-lg-4 m-l-n"><select class="form-control" multiple="">
                                <option>option 1</option>
                                <option>option 2</option>
                                <option>option 3</option>
                                <option>option 4</option>
                            </select></div>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group has-success"><label class="col-sm-2 control-label">Input with success</label>

                    <div class="col-sm-10"><input class="form-control" type="text"></div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group has-warning"><label class="col-sm-2 control-label">Input with warning</label>

                    <div class="col-sm-10"><input class="form-control" type="text"></div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group has-error"><label class="col-sm-2 control-label">Input with error</label>

                    <div class="col-sm-10"><input class="form-control" type="text"></div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group"><label class="col-sm-2 control-label">Control sizing</label>

                    <div class="col-sm-10"><input placeholder=".input-lg" class="form-control input-lg m-b" type="text">
                        <input placeholder="Default input" class="form-control m-b" type="text"> <input placeholder=".input-sm" class="form-control input-sm" type="text">
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group"><label class="col-sm-2 control-label">Column sizing</label>

                    <div class="col-sm-10">
                        <div class="row">
                            <div class="col-md-2"><input placeholder=".col-md-2" class="form-control" type="text"></div>
                            <div class="col-md-3"><input placeholder=".col-md-3" class="form-control" type="text"></div>
                            <div class="col-md-4"><input placeholder=".col-md-4" class="form-control" type="text"></div>
                        </div>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group"><label class="col-sm-2 control-label">Input groups</label>

                    <div class="col-sm-10">
                        <div class="input-group m-b"><span class="input-group-addon">@</span> <input placeholder="Username" class="form-control" type="text"></div>
                        <div class="input-group m-b"><input class="form-control" type="text"> <span class="input-group-addon">.00</span></div>
                        <div class="input-group m-b"><span class="input-group-addon">$</span> <input class="form-control" type="text"> <span class="input-group-addon">.00</span></div>
                        <div class="input-group m-b"><span class="input-group-addon"> <input type="checkbox"> </span> <input class="form-control" type="text"></div>
                        <div class="input-group"><span class="input-group-addon"> <input type="radio"> </span> <input class="form-control" type="text"></div>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group"><label class="col-sm-2 control-label">Button addons</label>

                    <div class="col-sm-10">
                        <div class="input-group m-b"><span class="input-group-btn">
                                            <button type="button" class="btn btn-primary">Go!</button> </span> <input class="form-control" type="text">
                        </div>
                        <div class="input-group"><input class="form-control" type="text"> <span class="input-group-btn"> <button type="button" class="btn btn-primary">Go!
                                        </button> </span></div>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group"><label class="col-sm-2 control-label">With dropdowns</label>

                    <div class="col-sm-10">
                        <div class="input-group m-b">
                            <div class="input-group-btn">
                                <button data-toggle="dropdown" class="btn btn-white dropdown-toggle" type="button">Action <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Action</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something else here</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">Separated link</a></li>
                                </ul>
                            </div>
                            <input class="form-control" type="text"></div>
                        <div class="input-group"><input class="form-control" type="text">

                            <div class="input-group-btn">
                                <button data-toggle="dropdown" class="btn btn-white dropdown-toggle" type="button">Action <span class="caret"></span></button>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="#">Action</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something else here</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">Separated link</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group"><label class="col-sm-2 control-label">Segmented</label>

                    <div class="col-sm-10">
                        <div class="input-group m-b">
                            <div class="input-group-btn">
                                <button tabindex="-1" class="btn btn-white" type="button">Action</button>
                                <button data-toggle="dropdown" class="btn btn-white dropdown-toggle" type="button"><span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Action</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something else here</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">Separated link</a></li>
                                </ul>
                            </div>
                            <input class="form-control" type="text"></div>
                        <div class="input-group"><input class="form-control" type="text">

                            <div class="input-group-btn">
                                <button tabindex="-1" class="btn btn-white" type="button">Action</button>
                                <button data-toggle="dropdown" class="btn btn-white dropdown-toggle" type="button"><span class="caret"></span></button>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="#">Action</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something else here</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">Separated link</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-2">
                        <button class="btn btn-white" type="submit">Cancel</button>
                        <button class="btn btn-primary" type="submit">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
