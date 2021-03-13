<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'total',
        'invoice',
        'status',
        'max_payment'
    ];
    public function transactionDetail(){
        return $this->hasMany('App\Models\TransactionDetail');
    }
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
