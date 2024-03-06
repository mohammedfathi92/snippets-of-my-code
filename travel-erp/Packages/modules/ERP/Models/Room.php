<?php

namespace Packages\Modules\ERP\Models;

use Packages\Foundation\Models\BaseModel;
use Packages\Foundation\Transformers\PresentableTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;


class Room extends BaseModel
{
    use PresentableTrait, LogsActivity , HasTranslations;

    /**
     *  Model configuration.
     * @var string
     */
    public $config = 'erp.models.room';
    protected $table = "erp_rooms";

    public $translatable = ['name','description','notes'];
    

    protected static $logAttributes = [];

    protected $guarded = ['id'];

    public function hotel(){
    	return $this->belongsTo(Hotel::class, 'hotel_id');
    }


}
