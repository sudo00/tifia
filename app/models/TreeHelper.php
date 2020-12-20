<?php

namespace app\models;

use Yii;

class TreeHelper
{
    public static function formTree($data)
    {
        if (!is_array($data)) {
            return false;
        }
        $tree = [];
        foreach ($data as $value) {
            $tree[$value['partner_id']][] = $value;
        }
        return $tree;
    }

    public static function buildTree($cats, $parent_id)
    {
        if (is_array($cats) && isset($cats[$parent_id])) {
            $tree = '<ul>';
            foreach ($cats[$parent_id] as $cat) {
                $tree .= '<li>'. $cat['fullname'] . ' ' . $cat['client_uid'] . self::buildTree($cats, $cat['client_uid']) . '</li>';
            }
            $tree .= '</ul>';
        } else {
            return false;
        }
        return $tree;
    }
}