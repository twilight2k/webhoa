<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAndHoliday extends Model
{
    protected $table = "fk_holiday_product";

    public function product(){
        return $this->belongsTo('App\Models\Product','id_product','id');
    }
    public function holiday(){
        return $this->belongsTo('App\Models\HolidaysOfYear','id_holiday','id');
    }
}
