<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'name',
        'price',
        'quantity'
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
        'id',
    ];
}
