<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable=['name','model','price','quantity'];
    protected $filter=['id','name','model','price','quantity'];
    public function categories(){
        return $this->belongsToMany(Category::class,'category_product');
    }
}
