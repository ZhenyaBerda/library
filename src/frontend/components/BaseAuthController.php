<?php

namespace frontend\components;

use yii\web\Controller;

class BaseAuthController extends Controller
{
    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            if (\Yii::$app->user->isGuest && $action->id != 'author') {
                $this->redirect('/');
                return false;
            }
        }
        return true;
    }
}