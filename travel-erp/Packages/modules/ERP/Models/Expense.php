<?php

namespace Packages\Modules\ERP\Models;

use Packages\Foundation\Models\BaseModel;
use Packages\Foundation\Transformers\PresentableTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;


class Expense extends BaseModel implements HasMedia
{
    use PresentableTrait, LogsActivity, HasTranslations, HasMediaTrait;

    /**
     *  Model configuration.
     * @var string
     */
    public $config = 'erp.models.expenses';
    protected $table = "erp_expenses";


    protected static $logAttributes = [];

    protected $guarded = ['id'];
        public $mediaCollectionName = 'erp-receipt-image';


    public $translatable = ['name','description', 'notes'];

        public function modulable()
    {

        return $this->morphTo();
    }

   
public function parent(){
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children(){
        return $this->hasMany(self::class, 'parent_id');
    }

       public function data_created_by(){
        return $this->belongsTo(UserErp::class, 'created_by');
    }

           public function data_updated_by(){
        return $this->belongsTo(UserErp::class, 'updated_by');
    }

        public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }


           public function paid_by(){
        return $this->belongsTo(UserErp::class, 'paid_by_id');
    }

    



       public function pay_method(){
        return $this->belongsTo(\Packages\Modules\ERP\Models\Category::class, 'pay_method_id');
    }

    public function currency(){
        return $this->belongsTo(\Packages\Modules\ERP\Models\Currency::class, 'value_currency_id');
    }


        /**
     * @return null|string
     * @throws \Spatie\MediaLibrary\Exceptions\InvalidConversion
     */
    public function getReceiptImageAttribute()
    {
        $media = $this->getFirstMedia($this->mediaCollectionName);

        if ($media) {
            return $media->getUrl();
        } else {
            return asset(config($this->config . '.default_image'));
        }
    }

}
