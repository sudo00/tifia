<?php

namespace app\modules\v1\models;

use app\models\Trades;

class ClientInfo extends BaseInfo
{
    public $total_volume;
    public $total_profit;
    public $direct_partners;
    public $total_partners;
    public $partner_level;
    public $close_time;

    public function rules()
    {
        return array_merge(parent::rules(),  [
            [['close_time'], 'required'],
            ['close_time', 'date', 'format' => 'yyyy-MM-dd'],
        ]);
    }

    public function execute()
    {
        $logins = $this->getClientsTreeLogins();
        $info = Trades::getAccountsTotalVolume($logins, $this->close_time);
        $this->partner_level = $this->getTreeLevel();
        $this->total_volume = $info['volume'];
        $this->total_profit = $info['profit'];        
        $this->direct_partners = count($this->getClientPartners($this->client_uid, false));
        $this->total_partners = count($this->getClientPartners($this->client_uid));
        return $this;
    }
}