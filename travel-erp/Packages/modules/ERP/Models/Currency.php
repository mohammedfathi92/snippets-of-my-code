<?php


namespace Packages\Modules\ERP\Models;

use Packages\Foundation\Models\BaseModel;
use Packages\Foundation\Transformers\PresentableTrait;
use Spatie\Activitylog\Traits\LogsActivity;

class Currency extends BaseModel
{
    use PresentableTrait, LogsActivity;


	public $config = 'erp.models.currency';
    protected $table = "erp_currencies";
    protected $casts = [
        'active' => 'boolean'
    ];


    protected static $logAttributes = [];

    protected $guarded = ['id'];

}