<?php

namespace common\helpers;

class SortHelper
{

	public static function getSortDropDown()
	{
		return [
				'' => 'Select',
				'pricefrom-DESC' => 'Price:Highest',
				'pricefrom-ASC' => 'Price: Lowest',
				'myear-DESC' => 'Year: Newest',
				'myear-ASC' => 'Year: Oldest',
				'km-DESC' => 'Km:Highest',
				'km-ASC' => 'Km:Lowest',
				'make-ASC' => 'Vehicles: A to Z',
				'make-DESC' => 'Vehicles: Z to A'
				];
	}
}