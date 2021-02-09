<?php

namespace App\Repo;
use App\category;
use App\book;

class data 
{
  
   public function getcat()
   {
    $data = category::all();
       return $data;
   }

  public function addcat($data)
  {
   category::create($data);
     
  }

  public function delcat($id)
  {
   category::find($id)->delete();
     
  }

  public function update($data)
  {
  $cat = category::find($id)->update($data);
     
  }

  public function getbook()
   {
    $data = category::all();
       return $data;
   }

  public function addbook($data)
  {
   book::create($data);
     
  }

  public function delbook($id)
  {
   book::find($id)->delete();
     
  }



  public function fetchcat($id){
    $cat = category::where("CategoryID",$id)->first();
  
return response()->json($cat);
}
  public function searchcat(Request $request){
   $data = category::pluck('CategoryType');
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

}