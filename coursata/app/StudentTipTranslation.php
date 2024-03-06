<?php

namespace Corsata;

use Illuminate\Database\Eloquent\Model;

class StudentTipTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'description', 'meta_keywords', 'meta_description'];
    protected $table = "student_tip_translations";
}