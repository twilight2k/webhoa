<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $table = "type_shop";

    public function product(){
        return $this->hasMany('App\Models\Product','id_shop','id');
    }
}
