<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleOfProduct extends Model
{
    protected $table = "sale_of_product";

    public function product(){
        return $this->belongsTo('App\Models\Product','id_product','id');
    }
}
