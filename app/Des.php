<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Des extends Model
{
     protected $table = 'des';
     public $timestamps = false;
     protected $dates = ['deleted_at'];
}
