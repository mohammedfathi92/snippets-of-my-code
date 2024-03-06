<?php

namespace Sirb;

use Illuminate\Database\Eloquent\Model;
use \Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class FAQ extends Model
{
    use Translatable;
    use SoftDeletes;
    public $translatedAttributes = ['name', 'description', 'meta_keywords', 'meta_description'];
    public $primaryKey = "id";
    public $translationForeignKey = "category_id";
    public $translationModel = FAQTranslation::class;
    protected $table = 'faq_categories';
    protected $fillable = ['slug', 'icon_class', 'type', 'sort', 'status'];

    function questions()
    {
        return $this->hasMany(FaqQuestion::class, 'category_id', 'id');
    }

    function scopePublished()
    {
        return $this->where("status", true)->orderBy('sort', "ASC");
    }


}
