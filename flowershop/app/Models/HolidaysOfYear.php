<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HolidaysOfYear extends Model
{
    protected $table = "holidays_of_year";

    public function fk_product_holiday(){
        return $this->hasMany('App\Models\ProductAndHoliday','id_product','id');
    }
    public function product(){
        return $this->hasMany('App\Models\Product','id_product','id');
    }
}
