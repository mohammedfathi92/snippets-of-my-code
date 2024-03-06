<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MesurReport extends Model
{

    protected $table = 'mesur_reports';
    protected $guarded = ['id'];

    public function leader()
    {
        return $this->belongsTo(Employee::class, 'leader_id', 'id');
    }

    public function co_leader()
    {
        return $this->belongsTo(Employee::class, 'co_leader_id','id');
    }

    public function copy_to()
    {
        return $this->belongsTo(Employee::class, 'copy_to_id','id');
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'visited_area_id');
    }

    public function observations()
    {
        return $this->observations ? json_decode($this->observations) : "";
    }

    public function actions()
    {
        return $this->actions ? json_decode($this->actions) : "";
    }


}
