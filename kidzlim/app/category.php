<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
   protected $primaryKey = "id";
   protected $fillable = ['name','image'];


}
