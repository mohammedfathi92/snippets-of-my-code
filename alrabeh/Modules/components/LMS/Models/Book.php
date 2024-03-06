<?php

namespace Modules\Components\LMS\Models;

use Modules\Foundation\Models\BaseModel;
use Modules\Foundation\Transformers\PresentableTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\Filesystem\Filesystem;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;


class Book extends BaseModel implements HasMedia
{
    use PresentableTrait, LogsActivity, HasMediaTrait;

    /**
     *  Model configuration.
     * @var string
     */
    public $config = 'lms.models.book';
    protected $table = "lms_books";
    public $mediaCollectionName = 'lms-book-thumbnail';
    public $fileCollectionName = 'lms-book-file';

    protected static $logAttributes = ['title', 'slug'];
  

    protected $guarded = ['id'];


  public function categories()
    {
        return $this->morphToMany(Category::class, 'lms_categoriable');
    }
        
    public function studentLogs()
    {
        return $this->morphMany(\Modules\Components\LMS\Models\Logs::class, 'lms_loggable');
    }


     public function tags()
    {
        return $this->morphToMany(Tag::class, 'lms_taggable');
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

    /**
     * @return null|string
     * @throws \Spatie\MediaLibrary\Exceptions\InvalidConversion
     */
    public function getFileAttribute()
    {
        $media = $this->getFirstMedia($this->fileCollectionName);

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

  public function author()
    {
        return $this->belongsTo(UserLMS::class, 'author_id');

    }

     public function subscriptions()
    {
        return $this->morphMany(Subscription::class, 'subscriptionnable');
    }





}
