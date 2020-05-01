<?php

namespace Youngyezi\Captcha\Facades;


use Illuminate\Support\Facades\Facade;
/**
 * @see \Youngyezi\Captcha
 */
class Captcha extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'captcha';
    }
}