<?php

namespace app\packages\blog\controllers\backend;


class CategoryController extends \app\packages\category\controllers\backend\CategoryController
{
    public $keyCategory = 'blog';
    public $controllerId = '/blog/category';
}
