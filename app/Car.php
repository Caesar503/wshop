<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
 	  protected $table = 'car';
     	public $timestamps = false;
 	  public static function getgoods(){
		 return self::join('Goods','car.goods_id','=','goods.id')->get();
	  }
}
