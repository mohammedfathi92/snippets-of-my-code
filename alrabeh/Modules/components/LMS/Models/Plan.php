<?php

namespace Modules\Components\LMS\Models;

use Modules\Foundation\Models\BaseModel;
use Modules\Foundation\Transformers\PresentableTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;


class Plan extends BaseModel implements HasMedia
{
    use PresentableTrait, LogsActivity, HasMediaTrait;

    /**
     *  Model configuration.
     * @var string
     */
    public $translatable = ['name', 'description'];
    public $config = 'lms.models.plan';
    protected $table = "lms_plans";
    public $mediaCollectionName = 'lms-plan-thumbnail';
    protected static $logAttributes = ['name', 'slug'];


    protected $guarded = ['id'];


    private $basePlan;


    public function categories()
    {
        return $this->morphedByMany(Category::class, 'lms_plannable');
    }

        public function parent_categories()
    {
        return $this->morphToMany(Category::class, 'lms_categoriable');
    }

        public function courses()
    {
        return $this->morphedByMany(Course::class, 'lms_plannable');
    }

    public function quizzes()
    {
        return $this->morphedByMany(Quiz::class, 'lms_plannable');
    }

    public function questions()
    {
        return $this->belongsto(Question::class, Quiz::class);
    }

    public function books()
    {
        return $this->morphedByMany(Book::class, 'lms_plannable');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = str_slug($value);
    }

    public function getThumbnailAttribute()
    {
        $media = $this->getFirstMedia($this->mediaCollectionName);

        if ($media) {
            return $media->getUrl();
        } else {
            return asset(config($this->config . '.default_image'));
        }
    }


    public function tags()
    {
        return $this->morphToMany(Tag::class, 'lms_taggable');
    }


}
