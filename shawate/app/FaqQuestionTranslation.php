<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FaqQuestionTranslation extends Model {
	public $timestamps = false;
    public $primaryKey = "id";
	protected $fillable = ['question','answer'];
	protected $table = "faq_question_translations";
}
