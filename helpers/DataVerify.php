<?php

namespace common\helpers;

class DataVerify
{
    public static function isValidMd5($md5 ='') 
    {
        return strlen($md5) == 32 && ctype_xdigit($md5);
    }
}

