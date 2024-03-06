<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IncidentReport extends Model
{

    protected $table = 'incident_reports';
    protected $fillable = ['id', 'type_loreal_site', 'reporter_id', 'injured_person_name',
                           'incident_date', 'time_between', 'incident_nature', 'incident_place', 'incident_type',
                           'injured_person_type', 'injured_person_position', 'lost_days', 'duty_days', 'circumstances',
                           'consequences', 'lesions_nature', 'lesions_location', 'causes_analysis', 'description_causes',
                           'actions_plans'];

    public function reporter()
    {
        return $this->belongsTo(Employee::class, 'reporter_id');
    }

}
