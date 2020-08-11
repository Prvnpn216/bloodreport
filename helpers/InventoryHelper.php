<?php

namespace common\helpers;

class InventoryHelper{

	CONST MIN_KM = 10000;
	CONST MAX_KM = 100000;

	public static function getFuelTypes()
	{
            return [
                'Petrol'   => 'Petrol',
                'Diesel'   => 'Diesel',
                'Hybrid'   => 'Hybrid',
            ];
	}
        
        public static function getFuelTypesApi()
	{
            return [
                'Petrol',
                'Diesel',
                'Hybrid',
            ];
	}
        
        public function getKmRangeApi() 
        {
            $result = [
                ['key' => '0-20000','value' => 'below 20 thousand'],
                ['key' => '20000-40000','value' => '20,000 Kms - 40,000 Kms'],
                ['key' => '40000-60000','value' => '40,000 Kms - 60,000 Kms'],
                ['key' => '60000-80000','value' => '60,000 Kms - 80,000 Kms'],
                ['key' => '80000-100000','value' => '80,000 Kms - 100,000 Kms'],
                ['key' => '100000-200000','value' => '100,000 Kms - 200,000 Kms'],
                ['key' => '200000-1000000','value' => '200,000 Kms Above']];
            return $result;
        }

	public static function getMinKilometer()
	{
		$result = ['' => 'From'];
		$min = self::MIN_KM;
		$max = self::MAX_KM;
		$interval = self::MIN_KM;
		for($i = $min; $i <= $max; $i += $interval)
		{
			$result[$i] = $i;
		}
		return $result;
	}

	public function getMaxKilometer($km)
	{
		$allKm = self::getMinKilometer();
		$result = [];
		$flag = 0;
		if($km)
		{
                    foreach ($allKm as $key => $value) 
		    {
		        if($key == $km)
		        {
		            $flag = 1;
		        }
		        if($flag == 1)
		        {
		          $result[$key] = $value;
		        }
		    }
		}
    return $result;
	}

	public static function getInventoryAgeList()
	{
		return $ageList = 
		['lastweek' => 'Within 1 Week',
		'lastmonth' => 'Within 1 Month',
		'last3months' => 'Within 3 Months',
		'last6months' => 'More than 3 Months'];
	}

	public static function getCarOwners()
	{
		return $carOwners = 
		['1' => '1',
		'2' => '2',
		'3' => '3',
		'4' => '4',
		'5' => 'More than 4'
		];
	}

}  