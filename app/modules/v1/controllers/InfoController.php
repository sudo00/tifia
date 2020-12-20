<?php

namespace app\modules\v1\controllers;

use app\controllers\BaseApiController;
use yii\filters\VerbFilter;
use app\modules\v1\models\ClientInfo;
use yii\web\BadRequestHttpException;

class InfoController extends BaseApiController
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        return array_merge($behaviors, [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'total-volume' => ['get'],
                ],
            ],
        ]);
    }

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
