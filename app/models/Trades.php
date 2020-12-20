<?php

namespace app\models;

use Yii;

class Trades extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trades';
    }

    public static function getAccountsTotalProfit($logins, $date)
    {
        return self::find()
            ->select('sum(profit)')
            ->where(['in', 'login', $logins])
            ->andWhere(['<', 'close_time', $date])
            ->asArray()
            ->column()[0];
    }

    public static function getAccountsTotalVolume($logins, $date)
    {
        return self::find()
            ->select('sum(volume * coeff_h * coeff_cr) as volume, sum(profit) as profit')
            ->where(['in', 'login', $logins])
            ->andWhere(['<', 'close_time', $date])
            ->asArray()
            ->one();
    }
}
