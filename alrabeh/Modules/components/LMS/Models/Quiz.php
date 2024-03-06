<?php

namespace Modules\Components\LMS\Models;

use Modules\Foundation\Models\BaseModel;
use Modules\Foundation\Transformers\PresentableTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\Filesystem\Filesystem;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;


class Quiz extends BaseModel implements HasMedia
{
    use PresentableTrait, LogsActivity, HasMediaTrait;


    /**
     *  Model configuration.
     * @var string
     */

    public $mediaCollectionName = 'lms-quiz-thumbnail';
    public $config = 'lms.models.quiz';
    protected $table = "lms_quizzes";

    protected static $logAttributes = ['title', 'slug'];

    protected $guarded = ['id'];


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

     public function courses()
    {
        return $this->morphToMany(Course::class, 'lms_courseable');
    }

    public function sections()
    {
        return $this->morphToMany(Section::class, 'lms_sectionable');
    }

     public function questions()
    {
        return $this->belongsToMany(Question::class, 'lms_quiz_questions', 'quiz_id', 'question_id')->withPivot('order');
    }

    
    public function studentLogs()
    {
        return $this->morphMany(\Modules\Components\LMS\Models\Logs::class, 'lms_loggable');
    }


    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = str_slug($value);
    }


            public function subscriptions()
    {
        return $this->morphMany(Subscription::class, 'subscriptionnable');
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
