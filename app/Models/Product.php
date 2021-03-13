<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'img',
        'name',
        'detail',
        'price',
        'stock'
    ];
    public function cart(){
        return $this->hasOne('App\Models\Cart');
    }
}
