<?php

namespace Corsata;

use Illuminate\Database\Eloquent\Model;

class DataType extends Model
{
    protected $table = 'data_types';

    public function rows(){
    	return $this->hasMany(DataRow::class);
    }

    public function browseRows(){
    	return $this->hasMany(DataRow::class)->where('browse', '=', 1);
    }

    public function readRows(){
    	return $this->hasMany(DataRow::class)->where('read', '=', 1);
    }

    public function editRows(){
    	return $this->hasMany(DataRow::class)->where('edit', '=', 1);
    }

    public function addRows(){
    	return $this->hasMany(DataRow::class)->where('add', '=', 1);
    }

    public function deleteRows(){
    	return $this->hasMany(DataRow::class)->where('delete', '=', 1);
    }
}
