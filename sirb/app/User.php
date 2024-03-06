<?php

namespace Sirb;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    function scopeIsSuperAdmin()
    {
        return $this->level === 0 ? true : false;
    }


    function comments()
    {
        return $this->hasMany(Comment::class);
    }



    public function getGravatarAttribute()
{
    $hash = md5(strtolower(trim($this->attributes['email'])));
    return "https://www.gravatar.com/avatar/$hash";
}



}
