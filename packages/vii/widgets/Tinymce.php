<?php

namespace vii\widgets;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\InputWidget;
use yii\web\JsExpression;


/**
 * This is just an example.
 */
class Tinymce extends InputWidget
{

    /**
     * @var array the options for the TinyMCE JS plugin.
     * Please refer to the TinyMCE JS plugin Web page for possible options.
     * @see http://www.tinymce.com/wiki.php/Configuration
     */
    public $clientOptions = [];

    /**
     * Default TinyMCE plugin config
     * @var array
     */
    public $defaultClientOptions = [
        'selector' => 'textarea',
        'language' => 'en',
        'theme' => 'modern',
        'height' => 400,
        'fontsize_formats' => '8pt 9pt 10pt 11pt 12pt 14pt 16px 18px 20px 26pt 36pt 40pt',
        'plugins' => [
            //'moxiemanager bootstrap',
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern'
        ],
        'external_plugins' => [
//            'moxiemanager' => '/plugins/moxiemanager/plugin.min.js',
//            'bootstrap' => '/plugins/tinymce/bootstrap/plugin.min.js',
        ],
        'toolbar1' => 'insertfile undo redo | styleselect | fontselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        'toolbar2' => 'print preview media | forecolor backcolor emoticons | bootstrap',
        'toolbar3' => '',
        'entity_encoding' => 'raw',
        'force_p_newlines' => true,
        'force_br_newlines' => false,
        'auto_cleanup_word' => false,
        'relative_urls' => true,
        'convert_urls' => false,
        'remove_script_host' => true,
        'verify_html' => false,
        'forced_root_block' => false,
        'content_css' => [
            'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css',
        ],
        'moxiemanager_image_settings' => [
            'moxiemanager_title' => 'Images',
            'moxiemanager_extensions' => 'jpg,png,gif',
            'moxiemanager_rootpath' => '/uploads/editor',
            'moxiemanager_view' => 'thumbs',
        ],
        'bootstrapConfig' => [
            'bootstrapElements' => [
                'btn' => true,
                'icon' => true,
                'image' => false,
                'table' => true,
                'template' => true,
                'breadcrumb' => true,
                'pagination' => true,
                'pager' => true,
                'label' => true,
                'badge' => true,
                'alert' => true,
                'panel' => true,
                'snippet' => false
            ]
        ],
    ];

    /**
     * @inheritdoc
     */
    public function init() {
        if (empty($this->options['class'])) {
            $this->options['class'] = 'form-control form-tinymce';
        }

        if (isset(Yii::$app->params['tinymce']['content_css'])) {
            $this->defaultClientOptions['content_css'] = Yii::$app->params['tinymce']['content_css'];
        }

        $this->clientOptions = array_replace($this->defaultClientOptions, $this->clientOptions);
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        if ($this->hasModel()) {
            echo Html::activeTextarea($this->model, $this->attribute, $this->options);
        } else {
            echo Html::textarea($this->name, $this->value, $this->options);
        }
        $this->registerClientScript();
    }

    protected function registerClientScript() {
        $js = [];
        $view = $this->getView();

        TinymceAsset::register($view);

        $id = $this->options['id'];

        $this->clientOptions['selector'] = "#{$id}";
        $this->clientOptions['setup'] = $this->_optionSetup();

        $options = Json::encode($this->clientOptions);
        $js[] = "tinymce.init({$options});";

        $view->registerJs(implode("\n", $js));
    }

    private function _optionSetup() {
        $script = 'function(editor) { editor.on("change", function() { tinymce.triggerSave(); }); }';
        return new JsExpression($script);
    }

}
