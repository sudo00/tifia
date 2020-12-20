<?php

namespace app\modules\v1\controllers;

use app\controllers\BaseApiController;
use app\modules\v1\models\ClientInfo;
use yii\web\BadRequestHttpException;

class InfoController extends BaseApiController
{
    public function actionClientInfo()
    {
        $model = new ClientInfo();
        $model->load(['ClientInfo' => \Yii::$app->request->get()]);
        if ($model->validate()) {
            return $model->execute();
        } else {
            throw new BadRequestHttpException(current($model->getErrors())[0]);
        }
    }
}
