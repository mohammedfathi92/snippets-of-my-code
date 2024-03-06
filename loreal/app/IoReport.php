<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IoReport extends Model
{
    protected $table = 'io_reports';
    protected $connection = "mysql";
    protected $fillable = ['io_type', 'issue_id', 'user_type', 'reporter_id', 'reporter_name', 'area_id', 'location_id', 'manager_id', 'description', 'suggestion', 'risks_list'];

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function manager()
    {
        return $this->belongsTo(Employee::class, 'manager_id');
    }

    public function reporter()
    {
        return $this->belongsTo(Employee::class, 'reporter_id');
    }

    public function risks()
    {

    }


}
