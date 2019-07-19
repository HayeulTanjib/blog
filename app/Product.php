<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class product extends Model
{
    
    protected $fillable = ['product_name','product_description','product_price','product_quantity','product_alert','product_image'];


    use SoftDeletes;


function relationToCategory(){

	return $this->hasOne('App\Category','id','category_id');
}

    
}

