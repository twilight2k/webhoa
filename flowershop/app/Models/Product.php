<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "product";

    public function product_type(){
        return $this->belongsTo('App\Models\ProductType','id_type','id');
    }
    public function product_shop(){
        return $this->belongsTo('App\Models\Shop','id_shop','id');
    }
    public function product_color(){
        return $this->belongsTo('App\Models\Color','feature','id');
    }
    public function product_favourite(){
        return $this->hasMany('App\Models\ProductFavourite','id_product','id');
    }

    public function comment(){
        return $this->hasMany('App\Models\Comment','id_product','id');
    }

    public function bill_detail(){
        return $this->hasMany('App\BillDetail','id_product','id');
    }
    public function fk_product_holiday(){
        return $this->hasMany('App\Models\ProductAndHoliday','id_product','id');
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code_product',
        'name',
        'id_type',
        'id_shop',
        'description',
        'feature',
        'unit_price',
        'promotion_price',
        'image',
        'unit'
    ];
}
