<?php

namespace App;
use App\order;
use App\color;
use App\size;
use App\product;

use Illuminate\Database\Eloquent\Model;

class orderdetail extends Model
{
    protected $primaryKey = "OrderDetailID";
    protected $fillable = ['OrderID','color','yard','size','amount','quantity'];

    public  function order()
    {
        return $this->belongsTo(order::class,'OrderID','OrderID');
    }
    public  function product()
    {
        return $this->hasOne(product::class,'ProductID','ProductID');
    }
     public function getcolor(){
        return $this->hasOne(color::class,'ColorID','color');
        
    }
    public function getsize(){
        return $this->hasOne(size::class,'SizeID','size');}

}
