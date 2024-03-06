<?php

namespace Corsata;

use Illuminate\Database\Eloquent\Model;

class BookedHousingTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'description'];
    protected $table = "booked_housing_translations";
}
