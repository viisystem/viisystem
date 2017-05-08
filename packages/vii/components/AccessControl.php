<?php

namespace vii\components;

use yii\web\ForbiddenHttpException;
use yii\base\Module;
use Yii;
use yii\web\User;
use yii\di\Instance;

class AccessControl extends \yii\filters\AccessControl
{
    /**
     * @var User User for check access.
     */
    private $_user = 'user';

    /**
     * @var array List of action that not need to check access.
     */
    public $allowActions = [];

    /**
     * Get user
     * @return User
     */
    public function getUser()
    {
        if (!$this->_user instanceof User) {
            $this->_user = Instance::ensure($this->_user, User::className());
        }
        return $this->_user;
    }

    /**
     * Set user
     * @param User|string $user
     */
    public function setUser($user)
    {
        $this->_user = $user;
    }

    /**
     * @inheritdoc
     */
    public function beforeAction($action)
    {
        $actionId = $action->getUniqueId();

        if(strpos($action->controller->id, 'frontend/') !== false)
            return true;

        if(strpos($action->controller->action->id, 'login') !== false OR strpos($action->controller->action->id, 'logout') !== false)
            return true;
        
        $user = $this->getUser();
        if ($user->can($actionId)) {
            return true;
        }
        $obj = $action->controller;
        do {
            if ($user->can(ltrim($obj->getUniqueId() . '/*', '/'))) {
                return true;
            }
            $obj = $obj->module;
        } while ($obj !== null);
        $this->denyAccess($user);
    }
}