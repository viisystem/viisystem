<?php
/**
 * Description of PermissionAsset
 *
 * @author Minh Nguyen
 */
namespace app\packages\account\bundles;

use yii\web\AssetBundle;

class UserAsset extends AssetBundle
{
	public $sourcePath = '@app/packages/account/bundles/publish';

	public function init()
	{
		$minext = ''; //'.min'
		$this->js = [
			'user/js/User'.(YII_DEBUG ? '' : $minext).'.js',
		];
		$this->jsOptions['position'] = \yii\web\View::POS_BEGIN;
		parent::init();
	}
	
    public $depends = [
		'yii\web\JqueryAsset',
		'yii\web\YiiAsset',
    ];
}
