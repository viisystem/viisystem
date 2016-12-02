<?php

namespace vii\widgets;

use Yii;

class Pjax extends \yii\widgets\Pjax
{

    public $modal = false;

    public $options = ['class' => 'pjax-container'];

    /**
     * @var integer pjax timeout setting (in milliseconds). This timeout is used when making AJAX requests.
     * Use a bigger number if your server is slow. If the server does not respond within the timeout,
     * a full page load will be triggered.
     */
    public $timeout = false; //10000

    /**
     * @var boolean whether to enable push state.
     */
    public $enablePushState = true; //false

    /**
     * @var array additional options to be passed to the pjax JS plugin. Please refer to the
     * [pjax project page](https://github.com/yiisoft/jquery-pjax) for available options.
     */
    public $clientOptions = ['container' => '.pjax-container'];

    public function init()
    {
        if ($this->modal && !isset($this->options['data-pjax-params'])) {
            $this->options['data-pjax-params'] = json_encode([
                'url' => Yii::$app->request->url,
                'push' => false,
                'replace' => false
            ]);

            $this->enablePushState = false;
            $this->enableReplaceState = false;
        }

        parent::init();
    }

}
