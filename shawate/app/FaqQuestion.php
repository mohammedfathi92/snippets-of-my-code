<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class FaqQuestion extends Model
{
    use Translatable;
    use SoftDeletes;
    public $translatedAttributes = ['question', 'answer'];
    public $primaryKey = "id";
    public $incrementing = "id";
    public $translationModel = FaqQuestionTranslation::class;
    public $translationForeignKey = "question_id";
    protected $table = 'faq_questions';
    protected $fillable = ['category_id', 'sort', 'status'];

    function category()
    {
        return $this->belongsTo(FAQ::class, 'category_id', 'id');
    }

    function scopePublished()
    {
        return $this->where("status", true);
    }


}
