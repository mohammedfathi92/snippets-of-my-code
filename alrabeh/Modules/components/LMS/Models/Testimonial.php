<?php

namespace Modules\Components\LMS\Models;

use Modules\Foundation\Models\BaseModel;
use Modules\Foundation\Transformers\PresentableTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\Filesystem\Filesystem;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;


class Testimonial extends BaseModel implements HasMedia
{
    use PresentableTrait, LogsActivity, HasMediaTrait;

    /**
     *  Model configuration.
     * @var string
     */
    public $config = 'lms.models.testimonial';
    protected $table = "lms_testimonials";
    public $mediaCollectionName = 'lms-testimonial-thumbnail';

    protected static $logAttributes = ['title'];
  

    protected $guarded = ['id'];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
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
