<?php

namespace app\modules\v1\controllers;

use Yii;
use yii\web\Controller;
use app\models\Users;
use app\models\TreeHelper;

class TreeController extends Controller
{
    /**
     *  Значение клиента вне чужой реферальной сетки
     */
    const ROOT = 0;

    public function actionView()
    {
        $users = Users::find()->select('client_uid, fullname, partner_id')->asArray()->all();
        $preparedTree = TreeHelper::formTree($users);
        Yii::$app->response->data = TreeHelper::buildTree($preparedTree, self::ROOT);
    }
}