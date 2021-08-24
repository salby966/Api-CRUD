<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $fillable = [
   		'OrderDate',
   		'CustomerId',
   		'TotalAmount'
   ];

   public function order()
    {
        return $this->belongsTo('App\Customers');
    }
}
