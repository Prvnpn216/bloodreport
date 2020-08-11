<?php

namespace common\helpers;

class PriceHelper {
	
public static function getPriceRange()
{
    return [
        '0-25000000'        => 'Below 25 million',
        '25000000-50000000'   => '25 - 50 million',
        '50000000-100000000'   => '50 - 100 million',
        '100000000-200000000'   => '100 - 200 million',
        '200000000-250000000'   => '200 - 250 million',
        '250000000-350000000'   => '250 - 350 million',
        '350000000-500000000'  => '350 - 500 million',
        '500000000-'        => '500 million And Above',
    ];
}

public static function getPriceRangeApi()
{
    return [
        ['key' => '0-25000000','value' => 'Below 25 million'],
        ['key' => '25000000-50000000','value' => '25 - 50 million'],
        ['key' => '50000000-100000000','value' => '50 - 100 million'],
        ['key' => '100000000-200000000','value' => '100 - 200 million'],
        ['key' => '200000000-250000000','value' => '200 - 250 million'],
        ['key' => '250000000-350000000','value' => '250 - 350 million'],
        ['key' => '350000000-500000000','value' => '350 - 500 million'],
        ['key' => '500000000-1100000000','value' => '500 million And Above'],
    ];
}
public static function getBudgetListApi()
{
    return [
        ['key' => '0','value' => '0'],
        ['key' => '25000000','value' => '25 million'],
        ['key' => '50000000','value' => '50 million'],
        ['key' => '100000000','value' => '100 million'],
        ['key' => '200000000','value' => '200 million'],
        ['key' => '250000000','value' => '250 million'],
        ['key' => '350000000','value' => '350 million'],
        ['key' => '500000000','value' => '500 million'],
        ['key' => '1000000000','value' => '1000 million'],
    ];
}
public static function getPrice()
{
    return [
    	''		   =>	'Select',
        '25000000'   => 'Below 25 million',
        '50000000'   => '50 million',
        '100000000'   => '100 million',
        '200000000'   => '200 million',
        '250000000'   => '250 million',
        '350000000'   => '350 million',
        '500000000'  => '500 million',
        '600000000'  => '500 million And Above',
    ];
}

public static function getMinPriceRange()
{
    return [
    	''		   =>	'Min',
    	'25000000'   => 'Below 25 million',
        '50000000'   => '50 million',
        '100000000'   => '100 million',
        '200000000'   => '200 million',
        '250000000'   => '250 million',
        '350000000'   => '350 million',
        '500000000'  => '500 million',
        '600000000'  => '500 million And Above',
    ];
}

public static function getMaxPriceRange($minPrice)
{
    $range = [
    	'25000000'   => 'Below 25 million',
        '50000000'   => '50 million',
        '100000000'   => '100 million',
        '200000000'   => '200 million',
        '250000000'   => '250 million',
        '350000000'   => '350 million',
        '500000000'  => '500 million',
        '600000000'  => '500 million And Above',
    ];

    $result =  [];
    $flag = 0;
    foreach ($range as $key => $value) {
        if($key == $minPrice)
        {
            $flag = 1;
        }
        if($flag == 1)
        {
          $result[$key] = $value;
        }
    }
    return $result;
}



}