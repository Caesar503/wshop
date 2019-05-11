<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Author" contect="http://www.webqin.net">
    <title>三级分销</title>
    <link rel="shortcut icon" href="/one/images/favicon.ico" />
    
    <!-- Bootstrap -->
    <link href="/one/css/bootstrap.min.css" rel="stylesheet">
    <link href="/one/css/style.css" rel="stylesheet">
    <link href="/one/css/response.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond./one/js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="maincont">
     <div class="userName">
      <dl class="names">
       <dt><img src="/one/uploads/goods/20190118/2fd501293fc7eefe3bea88c3ee723596.jpg" /></dt>
       <dd>
        <h3>{{request()->user()->name}}</h3>
       </dd>
       <div class="clearfix"></div>
      </dl>
      <div class="shouyi">
       <dl>
        <dt>我的余额</dt>
        <dd>0.00元</dd>
       </dl>
       <dl>
        <dt>我的积分</dt>
        <dd>0</dd>  
       </dl>
       <div class="clearfix"></div>
      </div><!--shouyi/-->
     </div><!--userName/-->
     
     <ul class="userNav">
      <li><span class="glyphicon glyphicon-list-alt"></span><a href="/Jewe/order">我的订单</a></li>
      <div class="height2"></div>
      <div class="state">
         <dl>
          <dt><a href="/Jewe/order"><img src="/one/images/user1.png" /></a></dt>
          <dd><a href="/Jewe/order">待支付</a></dd>
         </dl>
         <dl>
          <dt><a href="/Jewe/order"><img src="/one/images/user2.png" /></a></dt>
          <dd><a href="/Jewe/order">代发货</a></dd>
         </dl>
         <dl>
          <dt><a href="/Jewe/order"><img src="/one/images/user3.png" /></a></dt>
          <dd><a href="/Jewe/order">待收货</a></dd>
         </dl>
         <dl>
          <dt><a href="/Jewe/order"><img src="/one/images/user4.png" /></a></dt>
          <dd><a href="/Jewe/order">全部订单</a></dd>
         </dl>
         <div class="clearfix"></div>
      </div><!--state/-->
      <li><span class="glyphicon glyphicon-usd"></span><a href="/Jewe/quan">我的优惠券</a></li>
      <li><span class="glyphicon glyphicon-map-marker"></span><a href="/Jewe/address">收货地址管理</a></li>
      <li><span class="glyphicon glyphicon-star-empty"></span><a href="/Jewe/shoucang">我的收藏</a></li>
      <li><span class="glyphicon glyphicon-heart"></span><a href="/Jewe/history">我的浏览记录</a></li>
      <li><span class="glyphicon glyphicon-usd"></span><a href="/Jewe/tixian">余额提现</a></li>
	 </ul><!--userNav/-->
     
     <div class="lrSub">
       <a href="/Jewe/exit">退出登录</a>
     </div>
     
     <div class="height1"></div>
        @include('Jewe.onefoot')
    </div><!--maincont-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/one/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/one/js/bootstrap.min.js"></script>
    <script src="/one/js/style.js"></script>
    <!--jq加减-->
    <script src="/one/js/jquery.spinner.js"></script>
   <script>
	$('.spinnerExample').spinner({});
   </script>
  </body>
</html>