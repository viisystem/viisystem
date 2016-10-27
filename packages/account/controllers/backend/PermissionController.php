<?php

namespace app\packages\account\controllers\backend;

use yii\web\Controller;
use Yii;

class PermissionController extends Controller
{
    public function actionIndex()
    {
		$auth = Yii::$app->authManager;
		
		$roles = $auth->getRoles();
		$permissions = $auth->getPermissions();
		
        return $this->render('index', [
			'roles' => $roles,
			'permissions' => $permissions,
		]);
    }
	
	public function actionGetPermissions($roleName)
	{
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$auth = Yii::$app->authManager;
		$permissions = $auth->getPermissionsByRole($roleName);
		return $permissions;
	}
	
	public function actionSetPermission($roleName, $permissionName, $checked)
	{
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$auth = Yii::$app->authManager;
		$role = $auth->getRole($roleName);
		$permission = $auth->getPermission($permissionName);
		if($role != null && $permission != null)
		{
			if($checked == 'true')
			{
				if(!$auth->hasChild($role, $permission))
				{
					$auth->addChild($role, $permission);
					return true;
				}
			}
			else
			{
				if($auth->hasChild($role, $permission))
				{
					$auth->removeChild($role, $permission);
					return true;
				}
			}
		}
		return false;
	}
	
	public function actionAddRole($roleName, $roleDesc)
	{
		$return = [];
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$auth = Yii::$app->authManager;
		$role = $auth->getRole($roleName);
		if($role == null && strlen(trim($roleName)) > 0)
		{
			$role = $auth->createRole($roleName);
			$role->description = $roleDesc;
			$auth->add($role);
			$return['success'] = true;
			$return['result'] = $role;
		}
		else
		{
			$return['success'] = false;
		}
		return $return;
	}
	
	public function actionDeleteRole($roleName)
	{
		$return = ['success'=>false];
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$auth = Yii::$app->authManager;
		$role = $auth->getRole($roleName);
		if($role != null)
		{
			$auth->removeChildren($role);
			$auth->remove($role); // Lenh remove nay khong complete delete cai object role (object do se con 1 field _id duy nhat)
			$return['success'] = true;
		}
		return $return;
	}
	
	public function actionAddPermission($permissionName, $permissionDesc)
	{
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		return $this->AddPermission($permissionName, $permissionDesc);
	}
	
	private function AddPermission($permissionName, $permissionDesc)
	{
		$return = [];
		$auth = Yii::$app->authManager;
		$permission = $auth->getPermission($permissionName);
		if($permission == null && strlen(trim($permissionName)) > 0)
		{
			$permission = $auth->createPermission($permissionName);
			$permission->description = $permissionDesc;
			$auth->add($permission);
			$return['success'] = true;
			$return['result'] = $permission;
		}
		else
		{
			$return['success'] = false;
		}
		return $return;
	}
	
	public function actionDeletePermission($permissionName)
	{
		$return = ['success'=>false];
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$auth = Yii::$app->authManager;
		$permission = $auth->getPermission($permissionName);
		if($permission != null)
		{
			// Revoke deleted permission from all roles
			$roles = $auth->getRoles();
			foreach($roles as $role)
			{
				if($auth->hasChild($role, $permission))
				{
					$auth->removeChild($role, $permission);
				}
			}
			// Remove the permission
			$auth->remove($permission); // Lenh remove nay khong complete delete cai object _id
			$return['success'] = true;
		}
		return $return;
	}
	
	public function actionGeneratePermissions()
	{
		foreach(Yii::$app->modules as $key=>$value)
		{
			$module = Yii::$app->getModule($key);
			if($module !== null)
			{
				try
				{
					$permissions = $module->getModulePermissions();
					foreach ($permissions as $permission=>$description)
					{
						$this->AddPermission($permission, $description);
					}
				}
				catch (yii\base\UnknownMethodException $e)
				{

				}
				catch(Exception $e)
				{
					
				}
			}
		}
		return $this->redirect(['/account/backend/permission']);
	}
}
