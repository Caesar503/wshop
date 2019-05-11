<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\StroeDesPost;
use App\Des;
class DesController extends Controller
{
	//首页
    public function index(Request $request){
    	$res1 = $request->all();
    	$where=[];
    	if($res1['name']??''){
    		$where[]=['name','like',"%$res1[name]%"];
    	}
    	if($res1['is_show']??''){
    		$where['is_show']=$res1['is_show'];
    	}
    	// var_dump($where);
    	$res = Des::where($where)->paginate(2);
    	// dd($res);
    	$p = config('app.imgdemain');
    	// dd($p);
    	return view('/Des/index',['res'=>$res,'p'=>$p,'where'=>$res1]);
    }
    //添加
    public function add(){
    	return view('/Des/add');
    }
    //执行添加
    public function adddo(StroeDesPost $request){
//    	 dd($request->all());
    	$res = $request->only('name','http','cate','is_show','person','desc');
    	$res['logo']=$this->uploads($request,'logo');
    	$res1 = Des::insert($res);
    	// var_dump($res1);
    	if($res1){
    		return redirect('/Des/show');
    	}
    }
    //图片上传
    public function uploads(Request $request,$file){
    	if ($request->hasFile($file) && $request->file($file)->isValid()) {
			 $photo = $request->file($file);
			 $extension = $photo->extension();
			 //$store_result = $photo->store('photo');
			 $store_result = $photo->store('uploads/'.date('Ymd'));
			 return $store_result;exit;
		}
		exit('未获取到上传文件或上传过程出错');
    }
     // 成功显示
    public function show(){
    	return view('/Des/view');
    }
    //删除
    public function del($id){
    	// echo $id;
    	$res = Des::where('id',$id)->delete();
    	// if($res){
    	// 	return redirect('/Des/show');
    	// }
    	if($res){
    		echo 1;
    	}else{
    		echo 2;
    	}
    }
    //修改
    public function upd($id){
    	$res = Des::find($id);
    	// dd($res);
    	$p = config('app.imgdemain');
    	return view('Des/upd',['res'=>$res,'p'=>$p]);
    }
    //执行修改
    public function upddo(Request $request,$id){
    	$res = $request->only('name','http','cate','is_show','person','desc');
    	$res['logo']=$this->uploads($request,'logo');
    	// $res1 = Des::find($id);
    	$res1 = Des::where('id',$id)->update($res);
    	if($res1){
    		return redirect('/Des/show');
    	}
    }
    //验证用户名
    public function checkname(Request $request,$id){
    	// echo $id;
    	$name = $request->name;
    	// echo $name;
    	$where[] =['id','<>',$id];
    	$where[] =['name',$name];
  //   	DB::connection()->enableQueryLog();
		
  //   	// print_r($where);die;
    	$res = Des::where($where)->count();
  //   	$logs = DB::getQueryLog();
		// dd($logs);
    	// dd($res);
    	if($res){
    		echo 1;
    	}else{
    		echo 2;
    	}
    }
}
