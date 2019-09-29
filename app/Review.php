<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';

    protected $fillable = ['email', 'product_id', 'body', 'name'];

    public function post()
    {
        return $this->belongsTo(Product::class);
    }
}
