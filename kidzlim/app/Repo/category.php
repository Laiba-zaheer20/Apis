<?php

namespace App\Repo;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
   protected $primaryKey = "id";
   protected $fillable = ['name','image'];
   protected $timestamp=false;

   public function books(){
    return $this->hasMany("App\Repo\book",'catid','id');
   }

}
