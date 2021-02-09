<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\inventory;
use App\product;

class InventoryController extends Controller
{
  public function searchsubcat(Request $request){
    $data = product::pluck('ProductName');
    $find = $request->name;
    if(!$find == null){
        foreach($data as $type){
      if(strpos($type, $find) !== false)
      {
        echo "<option value='".$type."' >".$type."</option><br>";
       
     }
    }
     }
     else{
        foreach($data as $type){ 
            echo "<option value='".$type."' >".$type."</option><br>";
        }
      }
}
 
    function display(){
        $data=product::all();
  
       return view('admin.inventory',compact('data'));
        
    }

    function view(){
      $array=array();
      $data=inventory::pluck('InventoryID');
      foreach($data as $id)
      {
        $prd=inventory::where('InventoryID',$id)->first();
        $prd->product;
        $array[]=$prd;
      }
   // dd($array[0]->product['ProductName']);
     return view('admin.viewinventory',compact('array'));
    }


    function find(){
      
        $proid=request()->query('id');
        $forid=product::where('ProductName',$proid)->get();
        foreach($forid as $search)
        $proid=$search->ProductID;

        $data=inventory::where('ProductID',$proid)->get();
      
        foreach($data as $invent)
          $array=array(
            $invent->Stock,
            $invent->Purchaseprice,
            $invent->Minlvl,
            $invent->Maxlvl,
          );
          $data2=product::where('ProductID',$proid)->get();
          foreach($data2 as $pro)
          $array[4]=$pro->ProductPrice;
          $array[5]= $proid;
   
    return($array);
  }
  function add(){
    $proid=request()->query('id');
    $newstock=request()->query('newstock');
    $newprice=request()->query('newprice');
    $max=request()->query('max');
    $min=request()->query('min');
    $data=inventory::where('ProductID',$proid)->get();
    foreach($data as $invent)
        $oldstock=$invent->Stock;
        $oldprice=$invent->Purchaseprice;

        $newstock= $oldstock+ $newstock;
        $totalprice =  $oldprice+$newprice;
       
      $data=inventory::where('ProductID',$proid)
       ->update(['Stock' => $newstock,'Purchaseprice'=>$totalprice,'Minlvl'=>$min,'Maxlvl'=>$max]);

       $data2=product::where('ProductID',$proid)->update(['ProductPrice'=>$newprice]);

       $data=inventory::where('ProductID',$proid)->get();
       foreach($data as $invent)
         $array=array(
           $invent->Stock,
           $invent->Purchaseprice,
           $invent->Minlvl,
           $invent->Maxlvl,
         );
         $data3=product::where('ProductID',$proid)->get();
         foreach($data3 as $pro)
         $array[4]=$pro->ProductPrice;

         return($array);
  }
  
}
