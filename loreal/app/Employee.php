<?php
/**
 * Class Employee
 * created by: Ahmed Zidan
 * email : php.ahmedzidan@gmail.com
 * @package App
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Employee
 * @method static findByEmpNo($number)
 */
class Employee extends Model
{
    protected $connection = "qps";
    protected $table = "vw_emp";

    /**
     * @param $query
     * @param $number Employee Number
     * @return mixed
     */
    public function scopeFindByEmpNo($query, $number)
    {
        return $query->where('empno', $number)->first();
    }

    public function getNameAttribute()
    {
        return $this->empname;
    }
}
