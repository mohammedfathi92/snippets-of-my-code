<?php

namespace Corsata;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Schema;

class Setting extends Model
{
    public $timestamps = false;
    protected $table = 'settings';
    protected $fillable = ['key', 'display_name', 'value', 'options', 'type', 'order', 'details'];

    public static function image($file, $default = '')
    {

        if (!empty($file) && Storage::exists(config('settings.upload_path') . $file)) {
            return Storage::url(config('settings.upload_path') . $file);
        }

        return $default;
    }

    public static function get($key, $default = null)
    {
        $ins = new static();
        if (Schema::hasTable('settings')){
            $setting = $ins->where('key', '=', $key)->first();
            if (isset($setting->id)) {
                return $setting->value;
            }
        }

        return $default;
    }
}
