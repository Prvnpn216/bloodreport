<?php

namespace common\helpers;

class ShowroomHelper 
{
	public static function getOrders()
	{
		return [
			null => 'UnOdered',
			'1' => 'First',
			'2' => 'Second',
			'3' => 'Third',
			'4' => 'Fourth',
			'5' => 'Fifth',
			'6' => 'Sixth',
			'7' => 'Seventh',
			'8' => 'Eighth',
			'9' => 'Nineth',
			'10' => 'Tenth'
		];
	}
}