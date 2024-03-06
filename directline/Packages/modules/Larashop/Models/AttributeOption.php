<?php

namespace Packages\Modules\Larashop\Models;

use Packages\Foundation\Models\BaseModel;
use Packages\Foundation\Transformers\PresentableTrait;
use Packages\Traits\Node\SimpleNode;
use Spatie\Activitylog\Traits\LogsActivity;

use Spatie\Translatable\HasTranslations;

class AttributeOption extends BaseModel
{
    use HasTranslations, PresentableTrait, LogsActivity, SimpleNode;

    public $translatable = ['option_display'];

    public $timestamps = false;

    protected $table = 'ecommerce_attribute_options';


    /**
     *  Model configuration.
     * @var string
     */
    public $config = 'ecommerce.models.attribute_option';


    protected $guarded = [];

    public function attribute()
    {
        return $this->belongsToMany(Attribute::class);
    }

}
