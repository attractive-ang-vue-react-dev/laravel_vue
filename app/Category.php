<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable=['parent_id','name'];
    public function product(){
    	return $this->belongsToMany(Product::class,'category_product');
    }

    public function children(){
    	 return $this->hasMany(Category::class,'parent_id','id') ;
    }

    public function parent(){
		return $this->belongsTo(Category::class,'parent_id','id') ;
    }

}
