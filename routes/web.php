<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	// session(['user'=>['user_id'=>1,'name'=>'赵恺']]);
	// request()->session()->flush();
	// Cookie::queue(Cookie::make('name', 'zhaokai',1));
 // 	Cookie::queue('lover', '娇娇', 1);
   return response('Hello World', 200)
 ->header('Content-hei', 'hellow');
});
// 路由 闭包
// Route::get('/goods/index',function(){
// 	echo 123123;
// });

// 路由  闭包  传参
// Route::get('/add/{id?}',function($id=0){
// 	echo '传的参数为'.$id;
// })->where('id','\d+');

// 路由  闭包 返回试图
// Route::get('/goods',function(){
// 	return view('goods/goods');
// });




// 默认路由
// Route::get('/goods','goodsController@index');

// 默认路由  传参  正则
// Route::get('/adds/{id?}','addController@index')->where('id','[0-9]+');

//命名 路由
Route::get('/goods/index/{id?}','goodsController@index')->name('show');
// 重定向
Route::redirect('/a',"/goods/index/8",302);



//用户管理
// 首页
Route::get('/User/index','UserController@index');
// ->middleware('login');
// 添加
Route::get('/User/create','UserController@create');
// 执行添加
Route::post('/User/adddo','UserController@store')->name('do');
//列表展示
Route::get('/User/list','UserController@show')->name('list');
//删除
Route::get('/User/dele','UserController@dele');
//编辑
Route::get('/User/edit','UserController@edit')->name('edit');
//执行修改
Route::post('/User/editdo','UserController@editdo')->name('editdo');




// 公告
//首页
Route::get('/Ades/index','AdesController@index');
// 添加
Route::get('/Ades/add','AdesController@add');
//执行添加
Route::post('/Ades/adddo','AdesController@adddo')->name('adddo');
//删除
Route::get('/Ades/del/{id}','AdesController@del');
//返回的试图
Route::get('/Ades/show/','AdesController@show');
//修改
Route::get('/Ades/upd/{id}','AdesController@upd');
//执行修改
Route::post('/Ades/upddo/{id}','AdesController@upddo');



//友情链接
//首页
Route::get('/Des/index','DesController@index');
//添加
Route::get('/Des/add','DesController@add');
//执行添加
Route::post('/Des/adddo','DesController@adddo')->name('adddo');
//成功
Route::get('/Des/show/','DesController@show');
//删除
Route::get('/Des/del/{id}','DesController@del');
//编辑
Route::get('/Des/upd/{id}','DesController@upd');
//编辑
Route::post('/Des/upddo/{id}','DesController@upddo');
//验证用户名
Route::get('/Des/checkname/{id}','DesController@checkname');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



//------------------------------------------------------------------------------------
//珠宝


Route::get('/Jewe/home','JeweController@home');
//首页
Route::get('/Jewe/index','JeweController@index');




// 所有商品
Route::get('/Jewe/prolist','JeweController@prolist');
// 商品信息
Route::get('/Jewe/proinfo/{id}','JeweController@proinfo');



//购物车
Route::get('/Jewe/car','JeweController@car');
// ->middleware('login')
//购物车列表购买数量添加或者减少
Route::get('/Jewe/price','JeweController@price');
//加入购物车
Route::get('/Jewe/addcar/{id}','JeweController@addcar');
//删除商品信息
Route::post('/Jewe/deshop','JeweController@deshop')->middleware('login');
//提交订单
Route::post('/Jewe/success','JeweController@success')->middleware('login');
//订单详情
Route::get('/Jewe/orderDetail','JeweController@orderDetail')->middleware('login');
//付款
Route::get('/Jewe/pay','JeweController@pay')->middleware('login');
//支付宝支付
Route::any('/Jewe/paytong/{no}','JeweController@paytong')->middleware('login');
//支付宝同步跳转地址
Route::any('/Jewe/paytongredirect','JeweController@paytongredirect')->middleware('login');
//支付宝异步
Route::post('/notify','JeweController@notify');
//商品错误信息
Route::get('/Jewe/error','JeweController@error');
//微信支付
Route::post('/Weixin/pay','WxPayController@test');






// 个人中心
Route::get('/Jewe/user','JeweController@user')->middleware('login');
// 优惠券
Route::get('/Jewe/quan','JeweController@quan')->middleware('login');


// 收获地址
Route::get('/Jewe/address','JeweController@address')->middleware('login');
// 新增地址
Route::get('/Jewe/addaddress','JeweController@addaddress')->middleware('login');
//获取地址信息
Route::post('/Jewe/getArea/{id}','JeweController@threeArea')->middleware('login');
//地址添加执行
Route::post('/Jewe/addressdo','JeweController@addressdo')->middleware('login');
//默认地址
Route::post('/Jewe/moaddress/{id}','JeweController@moaddress')->middleware('login');
//删除地址信息
Route::post('/Jewe/deaddress','JeweController@deaddress')->middleware('login');


//收藏
Route::get('/Jewe/shoucang','JeweController@shoucang')->middleware('login');
//浏览地址
Route::get('/Jewe/history','JeweController@history')->middleware('login');
//浏览提现
Route::get('/Jewe/tixian','JeweController@monery')->middleware('login');
// 订单
Route::get('/Jewe/order','JeweController@order')->middleware('login');
//提交订单 清除购物车
Route::post('/Jewe/clear_cart','JeweController@clear_cart')->middleware('login');




//分组
// Route::middleware(['login'])->group(function () {
// 		 Route::get('/Jewe/user', function () { Uses login Middleware });
// 		 Route::get('/Jewe/quan', function () {});
// 		 Route::get('/Jewe/add-address', function () {});
// 		 Route::get('/Jewe/addaddress', function () {});
// 		 Route::get('/Jewe/getArea/{id}', function () {});
// 		 Route::get('/Jewe/shoucang', function () {});
// 		 Route::get('/Jewe/history', function () {});
// 		 Route::get('/Jewe/tixian', function () {});
// 		 Route::get('/Jewe/order', function () {});
// 		 // Route::get('/Jewe/profile', function () {});
// 		 // Route::get('/Jewe/profile', function () {});
// })








//替换
Route::get('/Jewe/replace','JeweController@replace');
//退出
Route::get('/Jewe/exit','JeweController@exit');



// ------------------------------------------------------------------------------------------
// 测试
Route::any('/Text/index','TextController@index');