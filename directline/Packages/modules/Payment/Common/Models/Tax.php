<?php

namespace Packages\Modules\Payment\Models;

use Packages\Foundation\Models\BaseModel;
use Packages\Foundation\Transformers\PresentableTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Tax extends BaseModel
{
    use PresentableTrait, LogsActivity;

    /**
     *  Model configuration.
     * @var string
     */
    public $config = 'payment_common.models.tax';

    protected static $logAttributes = ['name'];

    protected $guarded = ['id'];

    public function tax_class()
    {
        return $this->belongsTo(TaxClass::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
