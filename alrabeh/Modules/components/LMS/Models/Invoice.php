<?php

namespace Modules\Components\LMS\Models;

use Modules\Foundation\Models\BaseModel;
use Modules\Foundation\Transformers\PresentableTrait;
use Spatie\Activitylog\Traits\LogsActivity;



class Invoice extends BaseModel
{
    use PresentableTrait, LogsActivity;

    /**
     *  Model configuration.
     * @var string
     */
    protected $table = "lms_invoices";
    protected static $logAttributes = ['code', 'total_price'];
  

    protected $guarded = ['id'];


 
   public function categories()
    {
        return $this->morphedByMany(Category::class, 'lms_invoicenable');
    }

  public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'invoice_id');
    }

    public function courses()
    {
        return $this->morphedByMany(Course::class, 'lms_invoicenable');
    } 

     public function quizzes()
    {
        return $this->morphedByMany(Quiz::class, 'lms_invoicenable');
    } 

      public function invoicables()
    {
        return $this->hasMany(Invoicable::class, 'invoice_id');
    } 

     public function user()
    {
        return $this->belongsTo(UserLMS::class, 'user_id');
    } 

    

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }






}
