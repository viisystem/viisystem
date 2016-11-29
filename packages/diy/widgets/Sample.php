<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sample
 *
 * @author Minh
 */
namespace app\packages\diy\widgets;

class Sample extends Widget
{
	public function init() {
		parent::init();
		$this->settings['widget']['title'] = 'SAMPLE';
	}
}
