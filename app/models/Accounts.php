<?php

namespace app\models;

use Yii;

class Accounts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'accounts';
    }

    public static function getClientsLogins($clients)
    {
        return self::find()
            ->select('accounts.login')
            ->leftJoin('users', 'users.client_uid = accounts.client_uid')
            ->where(['in', 'accounts.client_uid', $clients])
            ->asArray()
            ->column();
    }
}
