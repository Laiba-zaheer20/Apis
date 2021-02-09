<?php

namespace App\Repo;

use Illuminate\Database\Eloquent\Model;

class book extends Model
{
    
    protected $primaryKey = "id";
    protected $fillable = ['title','image','catid','created_at','updated_at'];
    protected $timestamp=false;
   
}