<?php

namespace Modules\Components\LMS\Models;

use Modules\Foundation\Models\BaseModel;
use Modules\Foundation\Transformers\PresentableTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

class Category extends BaseModel implements HasMedia
{
    use PresentableTrait, LogsActivity, HasMediaTrait;

    /**
     *  Model configuration.
     * @var string
     */
    public $config = 'lms.models.category';
    protected $table = "lms_categories";

    public $mediaCollectionName = 'lms-category-thumbnail';


    protected static $logAttributes = ['name', 'slug'];

    protected $guarded = ['id'];

        public function courses()
    {
        return $this->morphedByMany(Course::class, 'lms_categoriable');
    }

    public function quizzes()
    {
        return $this->morphedByMany(Quiz::class, 'lms_categoriable');
    }
    public function books()
    {
        return $this->morphedByMany(\Modules\Components\LMS\Models\Book::class, 'lms_categoriable');
    }



        public function child_plans()
    {
        return $this->morphedByMany(Plan::class, 'lms_categoriable');
    }

    public function plans()
    {
        return $this->morphToMany(Plan::class, 'lms_plannable');
    }

    // public function books()
    // {
    //     return $this->belongsToMany(Book::class,
    //         'lms_categoriables',
    //         "category_id",
    //         "lms_categoriable_id")
    //         ->where("lms_categoriable_type", "book");
    // }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = make_slug($value);
    }

    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function categories()
    {
        return $this->hasMany(self::class, "parent_id");
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

}
