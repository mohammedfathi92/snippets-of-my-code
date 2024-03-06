<?php

namespace Modules\Components\LMS\Models;

use Modules\Foundation\Models\BaseModel;
use Modules\Foundation\Transformers\PresentableTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\Filesystem\Filesystem;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;


class InvoiceItem extends BaseModel implements HasMedia
{
    use PresentableTrait, LogsActivity, HasMediaTrait;

    /**
     *  Model configuration.
     * @var string
     */
    public $config = 'lms.models.invoice_item';
    protected $table = "lms_invoicenables";
    protected static $logAttributes = ['name', 'slug'];
  

    protected $guarded = ['id'];


 
   public function categories()
    {
        return $this->morphedByMany(Category::class, 'lms_invoicenable');
    }

    public function courses()
    {
        return $this->morphedByMany(Course::class, 'lms_invoicenable');
    } 

     public function quizzes()
    {
        return $this->morphedByMany(Quiz::class, 'lms_invoicenable');
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


}
