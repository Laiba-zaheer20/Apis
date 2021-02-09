<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class book extends Model
{
    protected $primaryKey = "id";
    protected $fillable = ['title','image','catid'];
}
