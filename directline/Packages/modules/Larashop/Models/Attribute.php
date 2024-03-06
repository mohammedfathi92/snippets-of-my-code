<?php

namespace Packages\Modules\Larashop\Models;

use Packages\Foundation\Models\BaseModel;
use Packages\Foundation\Transformers\PresentableTrait;
use Packages\Traits\Node\SimpleNode;
use Spatie\Activitylog\Traits\LogsActivity;

use Spatie\Translatable\HasTranslations;

class Attribute extends BaseModel
{
    use HasTranslations, PresentableTrait, LogsActivity, SimpleNode;

    public $translatable = ['label'];

    protected $table = 'ecommerce_attributes';

    /**
     *  Model configuration.
     * @var string
     */
    public $config = 'ecommerce.models.attribute';

    protected $casts = ['use_as_filter' => 'boolean'];

    protected $guarded = ['id'];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function options()
    {
        return $this->hasMany(AttributeOption::class);
    }
}
