<?php

namespace Sirb;

use Illuminate\Database\Eloquent\Model;


class Comment extends Model
{
   
    protected $table = 'comments';
    protected $fillable = ['creator_name', 'creator_email','parent_id', 'title', 'content',  'local', 'title', 'content',  'local','member_id'];

   

    function scopePublished($query, $scape = 0)
    {
        return $query->whereStatus(true)->where("id", "!=", $scape);
    }


    function parent()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

     function children()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    function member()
    {
        return $this->belongsTo(User::class, 'member_id');
    }


}
