<?php

namespace App\Repo;
use App\Repo\category;
use App\Repo\book;


class categoryrepository{

    public function findById($id) {
      $cat=category::where('id','=',$id)->get()->map(function($cat){
            return[ 
             'status'=>'success',
             'reason' => 'record updated succesfully',  
             'data'=>array(
             "categoryinfo"=> array(
                "id"=>$cat->id,
                "name" => $cat->name,
                "image" => $cat->image,
                "books" => array(
                $cat->books
                )
            )
            )
            ];
        }); 
        return $cat;
    }

    public function update($request){
     
      $cat=category::find($request->id);
      $cat->update($request->all());
      return [
        'status'=>'success',
        'reason' => 'record updated succesfully',  
        'data'=> array(
            "id"=>$cat->id,
            "name" => $cat->name,
            "image" => $cat->image,
        )  
      ];
    } 
}
