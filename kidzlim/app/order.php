<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\customerdetail;
use App\orderdetail;
class order extends Model
{
    protected $primaryKey = 'OrderID';
    protected $fillable = ['cartid','CustomerID'];
    public function customer(){
        return $this->hasOne(customerdetail::class, 'CustomerID','CustomerID');
    } 

    public function detail(){
        return $this->hasMany(orderdetail::class,'OrderID','OrderID');
    }
}
