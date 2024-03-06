<?php

namespace Sirb;

use Illuminate\Database\Eloquent\Model;


class ContactSettingTranslation extends Model
{

    public $timestamps = false;
    public $primaryKey = "id";
    protected $fillable = ['info','sent_success_message'];
    protected $table = "contact_us_setting_translations";
}
