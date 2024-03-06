<?php

namespace Sirb;

use Illuminate\Database\Eloquent\Model;
use \Dimsav\Translatable\Translatable;

class ContactSetting extends Model
{
    use Translatable;
    public $timestamps = false;
    public $primaryKey = "id";
    public $translationForeignKey = "setting_id";
    public $translationModel = ContactSettingTranslation::class;
    public $translatedAttributes = ['info','sent_success_message'];
    protected $table = "contact_us_settings";
    protected $fillable = ['geo_location', 'map_background', 'show_mobile', 'mobile_required', 'country_required', 'show_country'];

}
