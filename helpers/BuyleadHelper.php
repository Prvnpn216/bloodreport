<?php 

namespace common\helpers;

class BuyleadHelper
{
    public static function getBuyleadSource()
    {
        return [
            ''  => 'Source(All)',
            'Oto'   => 'Oto',
            'Website' => 'Website',
            'Walk-In' => 'Walk-In',
        ];
    }
    public static function getBuyleadStatus()
    {
        return [
            '' => 'Status',
            'Hot' => 'Hot',
            'Warm' => 'Warm',
            'Cold' => 'Cold',
            'Walk In Scheduled' => 'Walk In Scheduled',
            'Walked-In' => 'Walked-In',
            'Booked' => 'Booked',
            'Converted' => 'Converted',
            'Closed' => 'Closed',
        ];
    }
}