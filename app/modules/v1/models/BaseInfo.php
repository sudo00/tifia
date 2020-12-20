<?php

namespace app\modules\v1\models;

use app\models\TreeHelper;
use app\models\Users;
use app\models\Accounts;
use yii\base\Model;

class BaseInfo extends Model
{
    public $client_uid;
    private $tree_level;
    private $preparedTree;

    public function rules()
    {
        return [
            [['client_uid', 'close_time'], 'required'],
            ['client_uid', 'issetClient'],
            ['close_time', 'date', 'format' => 'yyyy-MM-dd'],
        ];
    }

    public function getTreeLevel()
    {
        return $this->tree_level;
    }

    public function getClientsTreeLogins()
    {
        $this->preparedTree = self::prepareList();
        $clients = $this->getClientPartners($this->client_uid);
        return Accounts::getClientsLogins($clients);
    }

    
    public static function prepareList()
    {
        $users = Users::find()->select('client_uid, partner_id')->asArray()->all();
        return TreeHelper::formTree($users);
    }

    public function getClientPartners($parent_id, $recursion = true, $level = 0)
    {
        $level++;
        $this->tree_level = $level;
        $cats = $this->preparedTree;
        $partners = [];
        if (is_array($cats) && isset($cats[$parent_id])) {
            $this->tree_level++;
            foreach ($cats[$parent_id] as $cat) {
                $partners[] = $cat['client_uid'];
                if ($recursion) {
                    $partners = array_merge($partners, $this->getClientPartners($cat['client_uid'], true, $level));
                }
            }
        } else {
            return [];
        }
        return $partners;
    }

    public function issetClient($attribute, $params)
    {
        $isIssetClient = (bool) Users::find()->select('id')->where(['client_uid' => $this->client_uid])->asArray()->one();
        if (!$isIssetClient) {
            $this->addError($attribute, 'Такой клиент не существует.');
        }
    }
}