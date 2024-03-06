<?php

namespace Modules\Components\Payments\Models;

use Modules\Foundation\Models\BaseModel;
use Modules\Foundation\Transformers\PresentableTrait;
use Spatie\Activitylog\Traits\LogsActivity;

class Bar extends BaseModel
{
    use PresentableTrait, LogsActivity;

    /**
     *  Model configuration.
     * @var string
     */
    public $config = 'payments.models.bar';

    protected static $logAttributes = [];

    protected $guarded = ['id'];
}
