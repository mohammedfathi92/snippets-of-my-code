<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends \TCG\Voyager\Models\User
{
    use Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','is_investor','is_client','is_sponsor','level','details','role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function company_account()
    {
        return $this->hasMany(Company_account::class,'user_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->as('subscription')->withTimestamps()
            ->withPivot('price','quantity','total_price');
    }

    public function financial_transaction()
    {
        return $this->hasMany(Financial_transaction::class);
    }

    public function product_payments()
    {
        return $this->hasMany(ProductPayment::class);
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class,'investor_id');
    }

    public function client_contracts()
    {
        return $this->hasMany(Contract::class,'client_id');
    }

    public function notes(){
        return $this->hasMany(Note::class,'created_by');
    }

      public function logs()
    {
        return $this->hasMany(UserLog::class,'user_id');
    }

    public function collections(){
        return $this->hasMany(Collection::class,'client_id');
    }

}




