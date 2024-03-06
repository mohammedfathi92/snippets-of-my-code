<?php

namespace Modules\Components\LMS\Models;

use Modules\Foundation\Models\BaseModel;
use Modules\Foundation\Transformers\PresentableTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\Filesystem\Filesystem;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;


class Lesson extends BaseModel implements HasMedia
{
    use PresentableTrait, LogsActivity, HasMediaTrait;

    /**
     *  Model configuration.
     * @var string
     */
    public $config = 'lms.models.lesson';
    protected $table = "lms_lessons";
    public $mediaCollectionName = 'lms-lesson-thumbnail';

    protected static $logAttributes = ['title', 'slug'];
  

    protected $guarded = ['id'];


  public function categories()
    {
        return $this->morphToMany(Category::class, 'lms_categoriable');
    }

     public function tags()
    {
        return $this->morphToMany(Tag::class, 'lms_taggable');
    }

        
    public function studentLogs()
    {
        return $this->morphMany(\Modules\Components\LMS\Models\Logs::class, 'lms_loggable');
    }


     public function courses()
    {
        return $this->morphToMany(Course::class, 'lms_courseable');
    }

      public function sections()
    {
        return $this->morphToMany(Section::class, 'lms_sectionable');
    }


    public function scopeActive($query)
    {
        return $query->where('status', 1);
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


        public function files()
    {
        return $this->morphMany(Media::class, 'mediable');
    }


}
