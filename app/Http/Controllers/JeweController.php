<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App;
use \Log;
class JeweController extends Controller
{
	//首页
    public function index(){
    
    
    	$wh = request()->keyword;
    	// dd($user);
    	if($wh??''){
    		// dd($where);
    		$where[]=['goods_name','like',"%$wh%"];
    	}
    	$where[] = ['sell_num','>',20];
    	// 商品销售量大于20的
    	$pp = App\Goods::where($where)->get();
    	// dd($pp);
    	return view('Jewe/index',['res'=>$pp]);
    }







    //全部商品
    public function prolist(){
    	$goods_name = request()->goods_name;
    	// $goods_name = request()->goods_name;
    	// $goods_name = request()->goods_name;
    	// $goods_name = request()->goods_name;
    	$where=[];
    	if($goods_name??''){
    		$where[]=['goods_name','like',"%$goods_name%"];
    	}

    	//所有商品
    	$pp = App\Goods::where($where)->get();
    	return view('Jewe/prolist',['res'=>$pp,'name'=>$goods_name]);
    }
	//商品信息
    public function proinfo($id){
    	// echo $id;
    	//根据传过来的id进行查询商品详细信息
    	$res = App\Goods::find($id);
    	// dd($res);
    	if($res['goods_imgs']??''){
    		 $imgs = rtrim($res['goods_imgs'],'/');
    		 $imgs = explode('/',$imgs);
    		 $res['goods_imgs']=$imgs;
    	}
    	return view('Jewe/proinfo',['res'=>$res]);
    }
    //替换
    public function replace(){
    	$r = request()->all();
    	// dd($r);
    	$where = [];
    	if($r['name']??''){
    		$where[] = ['goods_name','like',"%$r[name]%"];
    	}
    	if($r['by']=='↑'){
    		$r['by']='asc';
    	}else{
    		$r['by']='desc';
    	}
    	//根据传过来的id进行查询商品详细信息
    	$res = App\Goods::where($where)->orderBy($r['filed'],$r['by'])->get();
    	// dd($res);
    	return view('Jewe/replace',['res'=>$res]);
    }







     //购物车
    public function car(){
    	if(request()->user() !=''){
    		$user_id = request()->user()->id;
    	}else{
    		$user_id = null;
    	}
    	
    	// $res = App\Car::getgoods();
    	$res = App\Car::join('goods','car.goods_id','=','goods.id')->where(['user_id'=>$user_id,'is_status'=>1])->get();
    	
    	 // dd($res);
    	return view('Jewe/car',['res'=>$res]);
    }
    // 购物车购买数量加减
    public function price(){
    	$all = request()->all();
    	// dd($all);
    	$res = App\Car::where(['goods_id'=>$all['goods_id']])->update(['buy_number'=>$all['buy_num']]);
    	// dd($res);
    	if($res){
    		echo 1;
    	}else{
    		echo 2;
    	}
    }
     //购物车添加
    public function addcar($id){
    	//查询数据库中是否已经存在
    	if(request()->user() ==''){
    		// $user_id = request()->user()->id;
    		echo 3;die;
    	}
    	$res1 = App\Car::where('goods_id',$id)->first();
    	// dd($res1);
    	if($res1){
    		//数据库已经存在的时候
    		$buy_number = request()->buy_num+$res1['buy_number'];
    		$res2 = App\Car::where('goods_id',$id)->update(['buy_number'=>$buy_number,'update_time'=>time(),'self_price'=>request()->self_price,'user_id'=>request()->user_id]);
    		if($res2){
    			echo 1;
    		}else{
    			echo 2;
    		}
    	}else{
    		//数据库中不存在的时候
    		$res = ['goods_id'=>$id,'buy_number'=>request()->buy_num,'create_time'=>time(),'self_price'=>request()->self_price,'user_id'=>request()->user_id];
	    	$result = App\Car::insert($res);
	    	if($result){
	    		echo 1;
	    	}else{
	    		echo 2;
	    	}
    	}
    }
    //删除商品信息
    public function deshop(){
//  	dd(request()->all());
    	$id=request()->id;
    	$id = rtrim($id,',');
    	// dd($id);
    	$id = explode(',',$id);
    	$res = App\Car::where('user_id',request()->user()->id)->whereIn('goods_id',$id)->update(['is_status'=>2]);
    	// dd($res);
    	if($res){
    		echo 1;
    	}else{
    		echo 2;
    	}
    }

    //支付
    public function pay(){
    	$user_id = request()->user()->id;
    	// dd($user_id);
    	$id = request()->id;
    	$id = rtrim($id,',');
    	$id = explode(',',$id);
    	// dd($id);
    	$res = App\Car::join('goods','car.goods_id','=','goods.id')->whereIn('goods_id',$id)->where('user_id',$user_id)->get();
    	// whereIn('goods_id',$id)->
    	// var_dump($res);die;
    	if(!$res){
    		return view('/Jewe/error');
    	}else{
    		$res1 = App\Address::where(['is_status'=>2,'user_id'=>$user_id])->get();
    		//dd($res1);
    		if($res1 !=''){
    			foreach($res1 as $k =>$v){
    				// echo $v->province;
    				// echo '<hr>';
    				// echo $v->city;
    				// echo '<hr>';
    				// echo $v->area;
    				// echo '<hr>';
		    		$res1[$k]->province=App\Area::where('id',$v->province)->value('name');
		    		$res1[$k]->city=App\Area::where('id',$v->city)->value('name');
		    		$res1[$k]->area=App\Area::where('id',$v->area)->value('name');
		    	}
    		}
    		//dd($res1);

	    	return view('Jewe/pay',['res'=>$res,'res1'=>$res1]);
    	}
    }
    //错误信息
    public function error(){
    		return view('/Jewe/error');
    }
	//提交订单时 清理购物车
	public function clear_cart(){
		$user_id = request()->user()->id;
		$id = request()->goods_id;
		$id = rtrim($id,',');
		$id = explode(',',$id);
		$data = [
			'is_status'=>2
		];
		foreach	($id as $k=>$v){
			$p= App\Car::where(['user_id' =>$user_id,'goods_id'=>$v])->update($data);
		}
		if($p){
			echo 1;
		}else{
			echo 2;
		}
	}
    // 提交订单
    public function success(){
    	//添加到订单表
    	$on = time().rand(1000,9999);
    	$orderInfo = [
    		'order_no'=>$on
    		,'user_id'=>request()->user()->id
    		,'order_amount'=>request()->allprice
    		,'create_time'=>time()
    	];
    	$order_id = App\Order::insertGetId($orderInfo);


    	//添加到订单商品详情表
    	$user_id = request()->user()->id;
    	$id = request()->goods_id;
    	$id = rtrim($id,',');
    	$id = explode(',',$id);
    	foreach($id as $v){
    		$p= App\Car::join('goods','car.goods_id','=','goods.id')->select('user_id','goods_id','buy_number','car.self_price','goods_name','goods_img')->where('goods_id',$v)->where('user_id',$user_id)->first();
    		$pp[]=[
    			'user_id'=>$p->user_id
    			,'order_id'=>$order_id
    			,'goods_id'=>$p->goods_id
    			,'buy_number'=>$p->buy_number
    			,'self_price'=>$p->self_price
    			,'goods_name'=>$p->goods_name
    			,'goods_img'=>$p->goods_img
    			,'create_time'=>time()
    		];
    		
    	}
    	// $res1 = App\Detail::insert($pp); 

    	//添加到订单地址表
    	$address = App\Address::where('id',request()->orderaddress_id)->first();
    	// $res =  App\Order_address::insert([
    	// 	'user_id'=>$address->user_id
    	// 	,'order_id'=>$order_id
    	// 	,'order_receive_name'=>$address->name
    	// 	,'receive_phone'=>$address->tel
    	// 	,'province_id'=>$address->province
    	// 	,'city_id'=>$address->city
    	// 	,'area_id'=>$address->area
    	// 	,'receive_address'=>$address->detail
    	//  ,'create_time'=>time()
    	// ]);
    	DB::beginTransaction();
    	try{
    		//添加到订单表
            // $order_id = App\Order::insertGetId($orderInfo);
            //添加到订单商品详情表
            $res1 = App\Detail::insert($pp);
            //添加到订单地址表
            $res =  App\Order_address::insert([
            	'user_id'=>$address->user_id,
            	'order_id'=>$order_id,
            	'order_receive_name'=>$address->name,
            	'receive_phone'=>$address->tel,
            	'province_id'=>$address->province,
            	'city_id'=>$address->city,
            	'area_id'=>$address->area,
            	'receive_address'=>$address->detail,
            	'create_time'=>time()
            ]);
    		DB::commit();
			$code = 1; 
    	}catch(\Exception $e){
    		DB::rollBack();
    		$code = 2; 
    	}
    	echo $code;
    }
    //订单详情
    public function orderDetail(){
    	// echo 111;
		$res = App\Order::where('user_id',request()->user()->id)->orderBy('order_id','desc')->first();
    	return view('Jewe/success',['res'=>$res]);
    }
    //支付宝支付
    public function paytong($no){
    	 if(!$no){
            return redirect('/Jewe/success')->with('没有此订单信息');
        }
        $order = DB::table('order')->select('order_amount','order_no')->where('order_no',$no)->first();
        // dd($order);
        if($order->order_amount <=0){
            return redirect('/Jewe/success')->with('无效订单信息');
        }
        
        include_once app_path('/libs/alipay1/alipay/wappay/service/AlipayTradeService.php');
//      echo app_path('buildermodel/AlipayTradeWapPayContentBuilder.php');die;
        include_once app_path('/libs/alipay1/alipay/wappay/buildermodel/AlipayTradeWapPayContentBuilder.php');


        //商户订单号，商户网站订单系统中唯一订单号，必填
        $out_trade_no = trim($no);

        //订单名称，必填
        $subject = '1809测试';

        //付款金额，必填
        $total_amount = $order->order_amount;

        //商品描述，可空
        $body = '1809测试';

		//超时时间
    	$timeout_express="1m";
    	

        //构造参数
        $payRequestBuilder = new \AlipayTradeWapPayContentBuilder();
	    $payRequestBuilder->setBody($body);
	    $payRequestBuilder->setSubject($subject);
	    $payRequestBuilder->setOutTradeNo($out_trade_no);
	    $payRequestBuilder->setTotalAmount($total_amount);
	    $payRequestBuilder->setTimeExpress($timeout_express);

	   
        $aop = new \AlipayTradeService(config('alipay'));
         

        $response = $aop->wapPay($payRequestBuilder,config('alipay.return_url'),config('alipay.notify_url'));

        //输出表单
        var_dump($response);
    }
    //同步跳转地址
    public function paytongredirect(){
//  	dd($_GET);
		include_once app_path('/libs/alipay1/alipay/wappay/service/AlipayTradeService.php');
		$alipaySevice = new \AlipayTradeService(config('alipay')); 
		$result = $alipaySevice->check($_GET);
		//查询数据库中存在不存在该条数据
		$res = App\Order::where(['order_no'=>$_GET['out_trade_no'],'order_amount'=>$_GET['total_amount']])->first();
//		dd($res);
		if(!$res){
			return redirect('/Jewe/success')->with('付款错误,无此订单');
		}
		if(trim($_GET['seller_id'])!=config('alipay.seller_id')||trim($_GET['app_id'])!=config('alipay.app_id')){
			return redirect('/Jewe/success')->with('付款错误，商家爱或者卖家错误');
		}
		return redirect('/Jewe/index');
    }
//	异步跳转地址
	public function notify(){
		//存日志
		Log::channel('pay')->info($_POST);

		include_once app_path('/libs/alipay1/alipay/wappay/service/AlipayTradeService.php');
		$alipaySevice = new \AlipayTradeService(config('alipay')); 
		$result = $alipaySevice->check($_POST);
		if($result){
			$res = App\Order::where(['order_no'=>$_POST['out_trade_no'],'order_amount'=>$_POST['total_amount']])->first();
			if(!$res){
				Log::channel('pay')->info($_POST['out_trade_no'].'付款错误,无此订单');die;
			}
			if(trim($_POST['seller_id'])!=config('alipay.seller_id')||trim($_POST['app_id'])!=config('alipay.app_id')){
				Log::channel('pay')->info($_POST['out_trade_no'].'付款错误,商家爱或者卖家错误');die;
			}
		 	if($_POST['trade_status'] == 'TRADE_SUCCESS') {
					
			}
			echo 'success';
		}else{
			echo 'fail';
		}
		
		
			
	}
     //个人中心
    public function user(){
    	// echo 111;
    	return view('Jewe/user');
    }



  	//订单
    public function order(){
    	if(request()->p!=''){
    		$p = request()->p;
    	}else{
    		$p = 1;
    	}
    	$res = App\Order::where('user_id',request()->user()->id)->where('pay_status',$p)->get();
    	// dd($res);
    	return view('Jewe/order',['res'=>$res]);
    }
    //优惠券
    public function quan(){
    	// echo 111;
    	return view('Jewe/quan');
    }
    //收获地址
    public function address(){
    	// echo 111;
    	$res = App\Address::where(['is_status'=>2,'user_id'=>request()->user()->id])->get();
    	// dd($res);
    	foreach($res as $k =>$v){
    		$res[$k]['province']=App\Area::where('id',$res[$k]['province'])->value('name');
    		$res[$k]['city']=App\Area::where('id',$res[$k]['city'])->value('name');
    		$res[$k]['area']=App\Area::where('id',$res[$k]['area'])->value('name');
    	}
    	// dd($res);
    	return view('Jewe/address',['res'=>$res]);
    }
    //新增地址
    public function addaddress(){
    	$res = $this->getpid(0);
    	return view('Jewe/addaddress',['res'=>$res]);
    }
    //默认地址
    public function moaddress($id){
    	// dd($id);
    	$result = App\Address::where('id','<>',$id)->update(['is_default'=>2]);
    	$res = App\Address::where('id',$id)->update(['is_default'=>1]);
    	if($res){
    		echo 1;
    	}else{
    		echo 2;
    	}
    }
    //获取pid及一下省份
  	public function getpid($id){
  		$res = App\Area::where('pid',$id)->get();
  		return $res;
  	}
  	//获取地区信息
    public function threeArea($pid){
    	$res = $this->getpid($pid);
    	if(request()->name == 'province'){
    		return view('/Jewe/pp',['res'=>$res]);
    	}else{
    		return view('/Jewe/ppp',['res'=>$res]);
    	}
    }
    // 执行地址添加
    public function addressdo(){
    	$res = request()->all();
    	unset($res['_token']);
    	$res['user_id']=request()->user()->id;
    	// var_dump($res);die;
    	if($res['is_default']==1){
    		$where =[
	    		'is_default'=>1,
	    		'user_id'=>request()->user()->id
	    	];
	    	$check = App\Address::where($where)->get();
	    	if($check){
	    		App\Address::where('is_default',1)->update(['is_default'=>2]);
	    		$result = App\Address::insert($res);
		    	if($result){
		    		return view('/Jewe/view');
		    	}
	    	}else{
	    		$result = App\Address::insert($res);
		    	if($result){
		    		return view('/Jewe/view');
		    	}
	    	}
    	}else{
    		$result = App\Address::insert($res);
	    	if($result){
	    		return view('/Jewe/view');
	    	}
    	}	
    }
    //删除地址信息
    public function deaddress(){
    	$id=request()->id;
    	$id = rtrim($id,',');
    	// echo $id;die;
    	$id = explode(',',$id);
    	$res = App\Address::whereIn('id',$id)->delete();
    	// dd($res);
    	if($res){
    		echo 1;
    	}else{
    		echo 2;
    	}
    }



     //历史
    public function history(){
    	echo 111;
    	// return view('Jewe/history');
    }
     //收藏
    public function shoucang(){
    	return view('Jewe/shoucang');
    }
      //提现
    public function monery(){
    	return view('Jewe/tixian');
    }
    // 退出
    public function exit(){
    	request()->session()->flush();
    	return redirect('/Jewe/index');
    }





	 
  
  	
}
