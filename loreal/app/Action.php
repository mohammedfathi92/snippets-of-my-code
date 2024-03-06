<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    protected $connection = "qps";
    protected $table = "action";
    public $timestamps = false;
    protected $fillable = ['id', 'typeid', 'sourceid', 'sourcedoc', 'issuerid', 'AccountableID',
                           'PillarID', 'IssueDate', 'PlannedDate', 'ClosureDate',
                           'LossDetails', 'ActionDetails', 'StatusID'];

    public function type()
    {
        return $this->belongsTo(ActionType::class, 'typeid');
    }

    public function source()
    {
        return $this->belongsTo(ActionSource::class, 'sourceid');
    }

    public function issuer()
    {
        return $this->belongsTo(Employee::class, 'issuerid');
    }

    public function account()
    {
        return $this->belongsTo(Employee::class, 'AccountableID');
    }

    public function status()
    {
        return $this->belongsTo(ActionStatus::class, 'StatusID');
    }
}
