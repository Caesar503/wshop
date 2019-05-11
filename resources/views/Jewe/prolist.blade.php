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
    @csrf
    <div id="name" style="display:none">{{$name}}</div>
    <div class="maincont">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
        @csrf
       <form class="prosearch"><input type="text" name="goods_name"/></form>
      </div>
     </header>
     <ul class="pro-select">
        <li class="pro-selCur"><a id="where" filed="is_new">新品 <font>↑</font></a></li>
        <li><a id="where" filed="sell_num">销量 <font>↑</font></a></li>
        <li><a id="where" filed="self_price">价格 <font>↑</font></a></li>
     </ul><!--pro-select/-->

     <div class="prolist">
        @foreach($res as $v)
          <dl>
               <dt><a href="/Jewe/proinfo/{{$v->id}}"><img src="/one/uploads/goods/{{$v->goods_img}}" width="100" height="100" /></a></dt>
               <dd>
                <h3><a href="/Jewe/proinfo">{{$v->goods_name}}</a></h3>
                <div class="prolist-price"><strong>¥{{$v->self_price}}</strong> <span>¥{{$v->market_price}}</span></div>
                <div class="prolist-yishou"><span>5.0折</span> <em>已售：{{$v->sell_num}}</em></div>
               </dd>
               <div class="clearfix"></div>
          </dl>
        @endforeach
     </div><!--prolist/-->
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
     <script src="/layui/layui.js"></script>
    <script>
		$(function () {
		 $("#sliderA").excoloSlider();
		});
	</script>
  </body>
</html>
<script>
  $(function(){
    layui.use('layer',function(){
        var layer = layui.layer;
        //点击新品/销量/价格
        $(document).on('click','#where',function(){
          //获取搜索条件
          var name = $('#name').text();
          //需要排序的字段和顺序（升序或者降序）
          var filed = $(this).attr('filed');
          $(this).parent('li').siblings('li').removeClass('pro-selCur');
          $(this).parent('li').addClass('pro-selCur');
          var by = $(this).children('font').text();
          var replace = $(this).parents('ul').next('div');
          var _this = $(this);
          $.get(
            '/Jewe/replace'
            ,{filed:filed,by:by,name:name}
            ,function(res){
              // console.log(res);
              replace.html(res);
              if(by=='↑'){
                _this.children('font').text('↓');
              }else{
                _this.children('font').text('↑');
              }
            }
          )
          
        });
    });
  })
</script>