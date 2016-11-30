<?php

namespace app\packages\article\controllers\backend;


class CategoryController extends \app\packages\category\controllers\backend\CategoryController
{
    public $keyCategory = 'article';
    public $controllerId = '/article/category';
}
