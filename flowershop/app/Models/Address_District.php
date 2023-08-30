<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address_District extends Model
{
    protected $table = "devvn_quanhuyen";

    public function customer(){
        return $this->hasMany('App\Models\Customer','address_district','id');
    }
}
