<?php

namespace Modules\Components\LMS\Models;

use Modules\Foundation\Models\BaseModel;
use Modules\Foundation\Transformers\PresentableTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\Filesystem\Filesystem;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;


class Certificate extends BaseModel implements HasMedia
{
    use PresentableTrait, LogsActivity, HasMediaTrait;

    /**
     *  Model configuration.
     * @var string
     */
    public $config = 'lms.models.certificate';
    protected $table = "lms_certificate_templates";

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
    public function getSiteLogoAttribute()
    {
        $media = $this->getFirstMedia('lms-certificate-site_logo');

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
    public function getImageAttribute()
    {
        $media = $this->getFirstMedia('lms-certificate-image');

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
    public function getSealAttribute()
    {
        $media = $this->getFirstMedia('lms-certificate-seal');

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
    public function getSignatureAttribute()
    {
        $media = $this->getFirstMedia('lms-certificate-signature');

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



public function users_certificates()
    {
        return $this->hasMany(Certificate::class, 'temp_id');
    }


}
