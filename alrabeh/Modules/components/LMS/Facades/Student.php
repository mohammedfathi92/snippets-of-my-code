<?php

namespace Modules\Components\LMS\Facades;

use Illuminate\Support\Facades\Facade;

class Student extends Facade
{
    /**
     * @return mixed
     */
    protected static function getFacadeAccessor()
    {
        return \Modules\Components\LMS\Classes\Student::class;
    }
}