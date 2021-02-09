<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\product;
class inventory extends Model
{
   
   protected $table='inventories';
   protected $primaryKey='InventoryID';

   public function product(){
      return $this->hasOne(product::class, 'ProductID', 'ProductID');

  }
}
