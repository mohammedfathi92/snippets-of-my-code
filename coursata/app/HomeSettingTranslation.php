<?php

namespace Corsata;

use Illuminate\Database\Eloquent\Model;

class HomeSettingTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['usage_steps', 'footer_col_1', 'footer_col_2', 'footer_col_3'];
    protected $table = "home_setting_translations";
}
