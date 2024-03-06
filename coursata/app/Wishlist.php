<?php

namespace Corsata;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wishlist extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'id', 'course_id', 'user_id',
    ];

}
