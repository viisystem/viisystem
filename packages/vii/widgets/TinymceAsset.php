<?php

namespace vii\widgets;

class TinymceAsset extends \yii\web\AssetBundle
{
//	public $sourcePath = '@vendor/tinymce/tinymce';
	public $sourcePath = null;
	public $js = [
		//'tinymce.min.js',
		'http://cdn.tinymce.com/4/tinymce.min.js',
	];
	public $depends = [
		'yii\web\JqueryAsset',
	];
}
