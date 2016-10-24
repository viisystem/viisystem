<?php
/**
 * Description of PermissionAsset
 *
 * @author Minh Nguyen
 */
namespace app\packages\account\bundles;

use yii\web\AssetBundle;

class PermissionAsset extends AssetBundle
{
	public $sourcePath = '@app/packages/account/bundles/publish';

	public function init()
	{
		$minext = ''; //'.min'
		$this->js = [
			'permission/js/Role'.(YII_DEBUG ? '' : $minext).'.js',
			'permission/js/Permission'.(YII_DEBUG ? '' : $minext).'.js',
		];
		$this->css = [
			'permission/css/main'.(YII_DEBUG ? '' : $minext).'.css',
		];
		$this->jsOptions['position'] = \yii\web\View::POS_BEGIN;
		parent::init();
	}
	
    public $depends = [
		'yii\web\JqueryAsset',
    ];
}
