<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    protected $table = "type_product";

    public function product(){
        return $this->hasMany('App\Models\Product','id_type','id');
    }
}
