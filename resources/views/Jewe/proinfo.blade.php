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
    <div class="maincont">
       @if(request()->user()!='')
       <div style="display:none" id="user_id">{{request()->user()->id}}</div>
        @else
        <div style="display:none" id="user_id"></div>
        @endif
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl">
        <span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>产品详情</h1>
      </div>
     </header>
     <div id="sliderA" class="slider">
      @foreach($res->goods_imgs as $v)
      <img src="/one/uploads/goodsimg/{{$v}}" />
      @endforeach
      <!-- <img src="/one/images/image2.jpg" />
      <img src="/one/images/image3.jpg" />
      <img src="/one/images/image4.jpg" />
      <img src="/one/images/image5.jpg" /> -->
     </div><!--sliderA/-->
     <table class="jia-len">
      <tr>
       <th><strong class="orange">{{$res->self_price}}</strong></th>
       <td>
        <input type="text" class="spinnerExample" />
       </td>
      </tr>
      <tr>
       <td>
        <strong>{{$res->goods_name}}</strong>
        <p class="hui">....</p>
       </td>
       <td align="right">
        <a href="javascript:;" class="shoucang"><span class="glyphicon glyphicon-star-empty"></span></a>
       </td>
      </tr>
     </table>
     <div style="display:none" id="self_price">{{$res->self_price}}</div>
      <div id="addCar" style="display:none">{{$res->id}}</div>
     <div class="height2"></div>
     <div class="height2"></div>
     <div class="zhaieq">
      <a href="javascript:;" class="zhaiCur">商品简介</a>
      <a href="javascript:;">商品参数</a>
      <a href="javascript:;" style="background:none;">订购列表</a>
      <div class="clearfix"></div>
     </div><!--zhaieq/-->
     <div class="proinfoList">
      <!-- <img src="/one/images/image4.jpg" width="636" height="822" /> -->
      {{$res->goods_desc}}
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息....
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息......
     </div><!--proinfoList/-->
     <table class="jrgwc">
      <tr>
       <th>
        <a href="/Jewe/index"><button><span class="glyphicon glyphicon-home"></span></button></a>
       </th>
       <td><button id='btu'>加入购物车</button></td>
      </tr>
     </table>
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
     <!--jq加减-->
    <script src="/one/js/jquery.spinner.js"></script>
   <script>
	$('.spinnerExample').spinner({});
	</script>
  </body>
</html>
<script src="/layui/layui.js"></script>
<script>
  $(function(){
    layui.use('layer',function(){
        var layer = layui.layer;
        //点击加入购物车
        $(document).on('click','#btu',function(){
            var car_id = $('#addCar').text();
            var buy_num = $('.spinnerExample').val();
            var self_price = $('#self_price').text();
            var user_id = $('#user_id').text();
            // alert(user_id);
            if(buy_num<=0){
                layer.msg('商品数量不能为0',{icon:2});
              return false;
            }
            $.get(
              '/Jewe/addcar/'+car_id
              ,{buy_num:buy_num,self_price:self_price,user_id:user_id}
              ,function(res){
                if(res==1){
                  layer.msg('加入购物车成功',{icon:1});
                }else if(res==3){
                  layer.msg('您还未登录，加入购物车错误',{icon:2});
                }else{
                   layer.msg('加入购物车错误',{icon:2});
                }
              }
            );
        });
       
    });
  })
</script>