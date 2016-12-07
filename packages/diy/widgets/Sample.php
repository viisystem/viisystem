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
	public function init()
	{
		parent::init();
		$this->settings['widget']['title'] = 'SAMPLE';
		$this->settings['params'] = [
			[
				'name' => 'number_of_article',
				'value' => 3,
				'label' => 'Number of article',
				'type' => 'text',
				'cols' => 12,
			],
			[
				'name' => 'category_id',
				'value' => 1,
				'label' => 'Category',
				'type' => 'select',
				'items' => [
					'1' => 'News',
					'2' => 'Article',
				],
				'cols' => 12,
			]
		];
	}
	
	// Hàm này sẽ trả về nội dung hiển thị
	public function getContent()
	{
		return '<div><h3>Widget mẫu</h3>Đây là một widget mẫu</div>';
	}
	
	public function getSettingForm()
	{
		
	}

	// Hàm này là để display widget sau khi kéo thả. Khi thả widget vào layout thì hàm này sẽ render 1 cái box, phần nội dung bên trong thì do hàm widget() trả về, nghĩa là sẽ hiển thị như frontend. Và title cái box sẽ hiển thị icon setting, icon setting này sẽ có cái link, click vào thì lên dialog cho hiện lên cái getSettingForm
	public function getSettingBar()
	{
		
	}
}
