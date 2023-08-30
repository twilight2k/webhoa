<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = "blogs";
    public function blog_type(){
        return $this->belongsTo('App\Models\BlogType','id_type','id');
    }
}
