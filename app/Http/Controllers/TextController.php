<?php

namespace App\Http\Controllers;
use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
class TextController extends Controller
{
   public function index(){
   		$p = request()->page??1;
   		$where=[];
   		$pay_status = request()->pay_status??'';
   		if($pay_status!=''){
   			$where=['pay_status'=>$pay_status];
   		}
	   	$res = Cache::get($p.'/'.$pay_status);
	   	if(!$res){
	   		$res = App\Order::where($where)->paginate(3);
	   		$res1 = Cache::put($p.'/'.$pay_status,$res,1);
	   	}
   		return view('/Text/index',['res'=>$res,'where'=>$where]);
   }
}
