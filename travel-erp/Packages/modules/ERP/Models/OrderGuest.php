<?php

namespace Packages\Modules\ERP\Models;

use Packages\Foundation\Models\BaseModel;
use Packages\Foundation\Transformers\PresentableTrait;
use Spatie\Activitylog\Traits\LogsActivity;


class OrderGuest extends BaseModel
{
    use PresentableTrait, LogsActivity;

    /**
     *  Model configuration.
     * @var string
     */
    public $config = 'erp.models.guest';
    protected $table = "erp_order_guests";


    protected static $logAttributes = ['name', 'age_level', 'passport_num'];

    protected $guarded = ['id'];

}
