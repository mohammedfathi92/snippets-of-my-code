<?php

namespace Sirb;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;


class Guest extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone'
    ];

}
