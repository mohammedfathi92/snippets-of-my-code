<?php

namespace Packages\Modules\ERP\Models;

use Packages\Foundation\Models\BaseModel;
use Packages\Foundation\Transformers\PresentableTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;
use Packages\Modules\ERP\Models\Country;


class City extends BaseModel
{
    use PresentableTrait, LogsActivity ,HasTranslations;

    /**
     *  Model configuration.
     * @var string
     */
    
public function toArray()
{

    $attributes = parent::toArray();

    foreach ($this->getTranslatableAttributes() as $name) {
        in_array($name, array_keys($attributes), true) ?
        $attributes[$name] = $this->getTranslation($name, app()->getLocale()) :
        '';
    }

    return $attributes;
}

    public $config = 'erp.models.city';
    protected $table = "erp_cities";

    protected static $logAttributes = [];

    protected $guarded = ['id'];

    public $translatable = ['name','description'];

    public function country(){
        return $this->belongsTo(Country::class, 'country_id');
    }

    

    public function hotels(){
        return $this->hasMany(Hotel::class, 'city_id');
    }

   public function airports(){
        return $this->hasMany(Airport::class, 'city_id');
    }

    public function activities(){
        return $this->hasMany(\Packages\Modules\ERP\Models\Activity::class, 'city_id');
    }

    public function services(){
        return $this->hasMany(\Packages\Modules\ERP\Models\Service::class, 'city_id');
    }

    //  public function providers(){
    //     return $this->hasMany(Provider::class, 'city_id');
    // }

}
