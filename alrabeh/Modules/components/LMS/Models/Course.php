<?php

namespace Modules\Components\LMS\Models;

use Modules\Foundation\Models\BaseModel;
use Modules\Foundation\Transformers\PresentableTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\Filesystem\Filesystem;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

class Course extends BaseModel implements HasMedia
{
    use PresentableTrait, LogsActivity, HasMediaTrait;

    /**
     *  Model configuration.
     * @var string 
     */

    public $mediaCollectionName = 'lms-course-thumbnail';

    public $config = 'lms.models.course';
    protected $table = "lms_courses";

    protected static $logAttributes = [];

    protected $guarded = ['id'];


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

        
    public function studentLogs()
    {
        return $this->morphMany(\Modules\Components\LMS\Models\Logs::class, 'lms_loggable');
    }



        /**
     * @return null|string
     * @throws \Spatie\MediaLibrary\Exceptions\InvalidConversion
     */
    public function getEmbededVideoAttribute()
    {
        $video = $this->video;

    }


     public function plans()
    {
        return $this->morphToMany(Plan::class, 'lms_plannable');
    }


    public function categories()
    {
        return $this->morphToMany(Category::class, 'lms_categoriable');
    }

     public function tags()
    {
        return $this->morphToMany(Tag::class, 'lms_taggable');
    }

      public function quizzes()
    {
        return $this->morphedByMany(Quiz::class, 'lms_courseable')->withPivot('order');
    }

       public function lessons()
    {
        return $this->morphedByMany(Lesson::class, 'lms_courseable')->withPivot('order');
    }

       public function sections()
    {
        return $this->hasMany(Section::class, 'course_id');
    }


      public function subscriptions()
    {
        return $this->morphMany(Subscription::class, 'subscriptionnable');
    }


    public function files()
    {
        return $this->morphMany(Media::class, 'mediable');
    }






}
