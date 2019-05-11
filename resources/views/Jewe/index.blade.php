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
    <!-- HTML5 shim and Respond./one/js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond./one/js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min./one/js"></script>
      <script src="http://cdn.bootcss.com/respond./one/js/1.4.2/respond.min./one/js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="maincont">
     <div class="head-top">
      <img src="/one/images/head.jpg" />
      <dl>
       <dt><a href="javascript:;"><img src="/one/images/touxiang.jpg" /></a></dt>
       <dd>
        <h1 class="username">赵老佛爷开发测试</h1>
        <ul>
         <li><a href="/Jewe/prolist"><strong></strong><p>全部商品</p></a></li>
         <li><a href="javascript:;"><span class="glyphicon glyphicon-star-empty"></span><p>收藏本店</p></a></li>
         <li style="background:none;"><a href="javascript:;"><span class="glyphicon glyphicon-picture"></span><p>二维码</p></a></li>
         <div class="clearfix"></div>
        </ul>
       </dd>
       <div class="clearfix"></div>
      </dl>
     </div><!--head-top/-->
     <form method="get" class="search">
        <input type="text" class="seaText fl" name="keyword"/>
        <input type="submit" value="搜索" class="seaSub fr" />
     </form><!--search/-->
     <ul class="reg-login-click">
      @if(request()->user()!='')
        <li align="center"><a href="JavaScript:;" class="rlbg">欢迎{{request()->user()->name}}登录</a></li>
      @else
      <li><a href="/home" class="rlbg">登录</a></li>
      <li><a href="/register" class="rlbg">注册</a></li>
      @endif
      

      <div class="clearfix"></div>
     </ul><!--reg-login-click/-->
     <div id="sliderA" class="slider">
      <img src="/one/images/image1.jpg" />
      <img src="/one/images/image2.jpg" />
      <img src="/one/images/image3.jpg" />
      <img src="/one/images/image4.jpg" />
      <img src="/one/images/image5.jpg" />
     </div><!--sliderA/-->
     <ul class="pronav">
      <li><a href="/Jewe/prolist">晋恩干红</a></li>
      <li><a href="/Jewe/prolist">万能手链</a></li>
      <li><a href="/Jewe/prolist">高级手镯</a></li>
      <li><a href="/Jewe/prolist">特异戒指</a></li>
      <div class="clearfix"></div>
     </ul><!--pronav/-->
     <div class="index-pro1">
      @foreach($res as $v)
      <div class="index-pro1-list">
        
       <dl>
        <dt><a href="/Jewe/proinfo/{{$v->id}}"><img src="/one/uploads/goods/{{$v->goods_img}}" /></a></dt>
        <dd class="ip-text"><a href="/Jewe/proinfo/{{$v->id}}">{{$v->goods_name}}</a><span>已售：{{$v->sell_num}}</span></dd>
        <dd class="ip-price"><strong>¥{{$v->self_price}}</strong> <span>¥{{$v->market_price}}</span></dd>
       </dl>
     
      </div> 
      @endforeach
      <div class="clearfix"></div>
     </div><!--index-pro1/-->
      
      <!--  <div class="index-pro1-list">
       <dl>
        <dt><a href="/Goods/proinfo"><img src="/images/pro1.jpg" /></a></dt>
        <dd class="ip-text"><a href="/Goods/proinfo">这是产品的名称</a><span>已售：488</span></dd>
        <dd class="ip-price"><strong>¥299</strong> <span>¥599</span></dd>
       </dl>
      </div> -->
     <div class="prolist">
     </div><!--prolist/-->
     <div class="joins"><a href="fenxiao.html"><img src="/one/images/jrwm.jpg" /></a></div>
     <div class="copyright">Copyright &copy; <span class="blue">这是就是三级分销底部信息</span></div>
     
     <div class="height1"></div>
    @include('Jewe.onefoot')
    </div><!--maincont-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/one/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/one/js/bootstrap.min.js"></script>
    <script src="/one/js/style.js"></script>
    <!--焦点轮换-->
    <script src="/one/js/jquery.excoloSlider.js"></script>
    <script>
		$(function () {
		 $("#sliderA").excoloSlider();
		});
	</script>
  </body>
</html>