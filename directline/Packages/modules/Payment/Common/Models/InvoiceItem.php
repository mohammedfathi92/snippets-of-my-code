<?php

namespace Packages\Modules\Payment\Models;

use Packages\Foundation\Models\BaseModel;
use Packages\Foundation\Transformers\PresentableTrait;
use Spatie\Activitylog\Traits\LogsActivity;

class InvoiceItem extends BaseModel
{
    use LogsActivity;

    /**
     *  Model configuration.
     * @var string
     */
    public $config = 'payment_common.models.invoice_item';

    protected static $logAttributes = [];

    protected $guarded = ['id'];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    /**
     * Get all of the owning itemable models.
     */
    public function itemable()
    {
        return $this->morphTo();
    }
}
