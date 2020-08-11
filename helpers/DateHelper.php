<?php

namespace common\helpers;

class DateHelper
{

    public static function getYearsList($start = 1985)
    {
        $years = [];
        $min = $start;
        $currentYear = intval(date("Y"));
        if($start)
        {
            $years = ['' => 'Year'];
            for ($i = $min; $i <= $currentYear; $i++) 
            {
                $years[$i] = $i;
            }
        }
        return $years;
    }
    
    public static function getYearsListApi($start = 1985)
    {
        $years = [];
        $min = $start;
        $currentYear = intval(date("Y"));
        if($start)
        {
            for ($i = $min; $i <= $currentYear; $i++) 
            {
                $years[] = $i;
            }
        }
        return $years;
    }

    public static function getMonthsList($year)
    {
        $currentMonth = date("m");
        $currentYear = intval(date("Y"));
        $months = [
            0 => 'Month',
            1 => 'Jan',
            2 => 'Feb',
            3 => 'Mar',
            4 => 'Apr',
            5 => 'May',
            6 => 'Jun',
            7 => 'Jul',
            8 => 'Aug',
            9 => 'Sep',
            10 => 'Oct',
            11 => 'Nov',
            12 => 'Dec'
        ];

        if($year == $currentYear)
        {
           $validMonths = [];
            foreach ($months as $key => $month) 
            {
                $validMonths[$key] = $month;
                if($key == $currentMonth)
                {
                    break;
                }
            }
            return $validMonths;
        }
        
        return $months;
    }

    public static function getMonthName($month,$year=null)
    {
        if($year==null)
        {
            $year = '1990';
        }
        if($month<13)
        {
            $months = static::getMonthsList($year);
            return $months[$month];
        }
        return false;
    }

    public static function validateDate($date)
    {
        $date = date('Y-m-d h:m:s',strtotime($date));
        $d = \DateTime::createFromFormat('Y-m-d h:m:s', $date);
        return $d && $d->format('Y-m-d h:m:s') === $date;
    }
}