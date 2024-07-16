<?php

namespace Dotunj\TwilioTrial\Facades;

use Illuminate\Support\Facades\Facade;

class TwilioTrial extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'twiliotrial';
    }
}