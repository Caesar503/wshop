<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StroeUsersPost;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // echo config('app.imgdemain');
        $all = $request->all();
        // var_dump($all);
        $where=[];
        if($all['username']??''){
            $where[]=['username','like',"%$all[username]%"];
        }
        if($all['sex']??''){
            $where['sex']=$all['sex'];
        }
        $res = DB::table('user')->where($where)->paginate(2);
        $pp=config('app.imgdemain');
        // dd($res);
        // var_dump($res);
        return view('/User/index',['res'=>$res,'where'=>$all,'pp'=>$pp]);
        // return view('User/');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // echo 111;
        return view('User/add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StroeUsersPost $request)
    {
        $post =$request->only(['username','pwd','repwd','sex','tel','email']);
        $post['headlogo'] = $this->upload($request,'headlogo');
        // dd($post);
        unset($post['repwd']);
        $res = DB::table('User')->insert($post);
        // dd($res);
        if($res==true){
            return redirect('/User/index');
        }else{
            return back()->withInput();
        }
    }

    //文件上传
    public function upload(Request $request,$file){
        //判断文件在请求中是否存在         判断文件爱你是否在上传中出错
         if($request->hasFile($file) && $request->file($file)->isValid()){
            // 接受表单会传过来的值
             $photo = $request->file($file);
             // 临时文件名
             $extension = $photo->extension();
             $store_result = $photo->store('uploads/'.date('Ymd'));
             // $store_result = $photo->storeAs('photo', 'test.jpg');
             return $store_result;exit;
         }
         exit('未获取到上传文件或上传过程出错');
    } 


    //删除
    public function dele(Request $request){
        $id = $request->id;
        // echo 11111;
        $res = DB::delete("delete from User where id = $id");
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        // echo 111111;
        $res = DB::select('select * from user');
        return view('/User/list',['res'=>$res]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $id = request()->input();
        $res = DB::table('user')->where('id',$id)->first();
        $pp=config('app.imgdemain');
        return view('user.edit',['res'=>$res,'pp'=>$pp]);
        // return redirect('user/index')->with('name','赵恺');
    }


    public function editdo(StroeUsersPost $request)
    {
        // dd($request->all());
        $post =request()->only(['username','pwd','repwd','sex','tel','email']);
        // dd($post);
        unset($post['repwd']);
        if($post['pwd']??''){
             $post['pwd']= encrypt($post['pwd']);
        }
        if($post['headlogo']??''){
            $post['headlogo'] = $this->upload(request(),'headlogo');
        }
        // dd($post);
        $id = request()->id;
        // dd($id);
        $res = DB::table('User')->where('id',$id)->update($post);
        // var_dump($res);die;
        if($res){
            return redirect('/User/index');
        }else{
            return back()->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
