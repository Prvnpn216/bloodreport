<?php 

namespace common\helpers;

class StockqcHelper
{
    public static function getQcStatus()
    {
        return [
            'pending' => 'Pending',
            'approved' => 'Approved',
            'rejected' => 'Rejected',
        ];
    }
}