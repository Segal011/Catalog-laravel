<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = ['name', 'sku', 'base_price', 'discount', 'status', 'description', 'image'];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }


    // public  function all($id)
    // {
    //     $records = new Product();
    //     return $records::all();
    // }
}
