<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DIYAsset
 *
 * @author Minh
 */
namespace app\packages\diy\bundles;

use yii\web\AssetBundle;

class DIYAsset extends AssetBundle
{
	public $sourcePath = '@app/packages/diy/bundles/publish';

	public function init()
	{
		$minext = ''; //'.min'
		$this->js = [
			'js/diy'.(YII_DEBUG ? '' : $minext).'.js',
		];
		$this->css = [
			'css/font-awesome.min.css',
			'css/diy'.(YII_DEBUG ? '' : $minext).'.css',
		];
		parent::init();
	}
	
    public $depends = [
		'yii\web\JqueryAsset',
		'yii\jui\JuiAsset',
		'yii\web\YiiAsset',
    ];
}