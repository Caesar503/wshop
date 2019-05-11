<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StroeAdesPost;
use App\Ades;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\SoftDeletes;
class AdesController extends Controller
{
    public function index(Request $request){
       
    	$res1 =$request->all();
    	// dd($res1);
    	$where=[];
    	if($res1['keyword']??''){
    		$where[]=['keyword','like',"%$res1[keyword]%"];
    	}
    	if($res1['is_show']??''){
    		$where['is_show']=$res1['is_show'];
    	}
    	// var_dump($where);
    	$res = Ades::where($where)->paginate(2);
    	$p = config('app.imgdemain');
    	// dd($p);
    	return view('/Ades/index',['res'=>$res,'p'=>$p,'where'=>$res1]);
    }
    // 添加
    public function add(Request $request){
    	return view('/Ades/add');
    }
    // 执行添加
    public function adddo(StroeAdesPost $request){
    	// dd(Ades::all());
    	$post = $request->only('title','keyword','is_show','content');
    	$post['img']=$this->uploads($request,'img');
    	// dd($post);
    	$Ades = new Ades;
    	$Ades->title =$post['title'];
    	$Ades->keyword =$post['keyword'];
    	$Ades->content =$post['content'];
    	$Ades->is_show =$post['is_show'];
    	$Ades->img =$post['img'];
    	$res = $Ades->save();
    	if($res){
    		return redirect('/Ades/show');
    	}else{
    		return back()->withInput();
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
    //删除
    public function del($id){
    	 // \Schema::table('Ades', function ($table) {
      //    $table->softDeletes();
      //   });
    	$res = Ades::destroy($id);
    	// var_dump($res);
    	if($res){
    		return redirect('/Ades/show');
    	}
    }
    // 成功显示
    public function show(){
    	return view('/Ades/view');
    }
    // 修改
    public function upd($id){
    	// echo $id;
    	$res = Ades::find($id);
    	$p =config('app.imgdemain');
    	return view('/Ades/upd',['res'=>$res,'p'=>$p]);
    }
    // 执行修改
    public function upddo(StroeAdesPost $request,$id){
    	// dd(Ades::all());
    	$post = $request->only('title','keyword','is_show','content');
    	// dd($post);
    	$Ades =Ades::find($id);
    	$Ades->title =$post['title'];
    	$Ades->keyword =$post['keyword'];
    	$Ades->content =$post['content'];
    	$Ades->is_show =$post['is_show'];
    	if($request->img??''){
    		$post['img']=$this->uploads($request,'img');
    		$Ades->img =$post['img'];
    	}
    	// if($post['img']!=''){
    	// 	$Ades->img =$post['img'];
    	// }
    	$res = $Ades->save();
    	if($res){
    		return redirect('/Ades/show');
    	}else{
    		return back()->withInput();
    	}
    }
}
