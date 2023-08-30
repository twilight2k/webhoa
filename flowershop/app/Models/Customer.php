<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = "customer";


    public function bill(){
        return $this->hasMany('App\Bill','id_customer','id');
    }
    public function devvn_tinhthanhpho(){
        return $this->belongsTo('App\Models\Address_Provincial','address_provicial','matp');
    }
    public function devvn_quanhuyen(){
        return $this->belongsTo('App\Models\Address_District','address_district','maqh');
    }
    public function devvn_xaphuong(){
        return $this->belongsTo('App\Models\Address_Wards','address_wards','xaid');
    }
}
