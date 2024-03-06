<?php

namespace Sirb;

use Illuminate\Database\Eloquent\Model;

class TransportTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'company_name', 'description', 'meta_keywords', 'meta_description'];
    protected $table = "transport_translations";
}
