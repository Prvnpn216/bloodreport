<?php 

namespace common\helpers;


class TimeHelper{

	CONST SECOND = 60;
	CONST MINUTE = self::SECOND*60;
	CONST HOUR = self::MINUTE*60;
	CONST DAY = self::HOUR*24;
	CONST MONTH = self::DAY*30;
	CONST YEAR = self::MONTH*12;
}