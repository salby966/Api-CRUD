<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    protected $fillable = [
    	'FirstName',
    	'LastName',
    	'City',
    	'Country',
    	'Phone'
    ];

    public function customerOrder()
    {
    	return $this->hasOne('App\Orders');
    }

    public function customers()
    {
    	return $this->hasMany(Customers::class);
    }

    public function addCustomers()
    {
    	$this->customers()->save($customers);
    }

    public function deleteCustomer($id)
    {
    	$this->customers()->find($id)->delete();
    	return ["message"=>"The customer has been deleted"];
    }

    public function countCustomers(){
    	return $this->customers()->count();
    }
}
