<?php

namespace Corsata;

use Illuminate\Database\Eloquent\Model;


class HomeSetting extends Model
{
    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['usage_steps', 'footer_col_1', 'footer_col_2', 'footer_col_3'];
    protected $table = 'home_settings';
    protected $fillable = ['slide_type', 'slide_video', 'slide_gallery', 'steps_video_youtube','steps_video','steps_video_thumbnail'];

   


}
