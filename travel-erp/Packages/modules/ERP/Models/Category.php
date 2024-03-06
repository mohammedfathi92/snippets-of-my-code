<?php

namespace Packages\Modules\ERP\Models;

use Packages\Foundation\Models\BaseModel;
use Packages\Foundation\Transformers\PresentableTrait;
use Packages\Traits\Node\SimpleNode;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;
use Spatie\Translatable\HasTranslations;


class Category extends BaseModel implements HasMedia
{
    use PresentableTrait, LogsActivity, HasTranslations, HasMediaTrait, SimpleNode;

    protected $table = 'erp_categories';

    protected $casts = [
        'is_featured' => 'boolean'
    ];

    public $translatable = ['name','description','notes'];


    public $mediaCollectionName = 'erp-category-thumbnail';
    /**
     *  Model configuration.
     * @var string
     */
    public $config = 'erp.models.category';

    protected static $logAttributes = ['name', 'slug'];

    protected $guarded = ['id'];



    public function scopeActive($query)
    {
        return $query->where('erp_categories.status', 'active');
    }

  

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = str_slug($value);
    }

    /**
     * @return null|string
     * @throws \Spatie\MediaLibrary\Exceptions\InvalidConversion
     */
    public function getThumbnailAttribute()
    {
        $media = $this->getFirstMedia($this->mediaCollectionName);

        if ($media) {
            return $media->getUrl();
        } else {
            return asset(config($this->config . '.default_image'));
        }
    }


     public function mainCategory(){
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function subCategories(){
        return $this->hasMany(self::class, 'parent_id');
    }


           public function city(){
        return $this->belongsTo(City::class, 'city_id');
    }
    public function country(){
        return $this->belongsTo(Country::class, 'country_id');
    }
}
