<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Ades extends Model
{
	use SoftDeletes;
    protected $table = 'ades';
    // public $timestamps = false;
    protected $dates = ['deleted_at'];
}
