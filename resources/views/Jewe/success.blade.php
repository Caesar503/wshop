<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Author" contect="http://www.webqin.net">
      <meta name="csrf-token" content="{{ csrf_token() }}">
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
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>购物车</h1>
      </div>
     </header>
     <div class="susstext">订单提交成功</div>
     <div class="sussimg">&nbsp;</div>
     <div class="dingdanlist">
      <table>
       <tr>
        <td width="50%">
         <h3>订单号：<h2>{{$res->order_no}}</h2></h3>
         <time>创建日期：<?php echo date('Y-m-d H:i:s',$res->create_time)?><br />
失效日期：-------</time>
            ¥<strong class="orange bbbb">{{$res->order_amount}}</strong>
        </td>
        <td align="right"><span class="orange">等待支付</span></td>
       </tr>
      </table>
     </div><!--dingdanlist/-->
     <div class="succTi orange">请您尽快完成付款，否则订单将被取消</div>
     
    </div><!--content/-->
    
    <div class="height1"></div>
    <div class="gwcpiao">
     <table>
      <tr>
       <td width="33%"><a href="/Jewe/prolist" class="jiesuan" style="background:#5ea626;">继续购物</a></td>
       <td width="33%"><a href="/Jewe/paytong/{{$res->order_no}}" class="jiesuan">点击此处支付宝立即支付</a></td>
          <td width="33%"><a class="jiesuan aaaa">点击此处微信立即支付</a></td>
      </tr>
     </table>
    </div><!--gwcpiao/-->
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
    <script>
        $(function(){
           //点击微信立即支付
            $(document).on('click','.aaaa',function(){
                //获取订单号
                var aa = $('h2').text();
                //价格
                var bb = $('.bbbb').text();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.post(
                        "/Weixin/pay/"
                        ,{order:aa,price:bb}
                        ,function(res){
                             $('body').html(res)
                        }
                );
            })
        })
    </script>
  </body>
</html>