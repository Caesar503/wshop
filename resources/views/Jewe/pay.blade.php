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
     <div class="maincont">
     <table class="shoucangtab">
      <tr>
       <td width="75%"><a href="/Jewe/addaddress" class="hui"><strong class="">+</strong> 新增收货地址</a></td>
       <td width="25%" align="center" style="background:#fff url(/one/images/xian.jpg) left center no-repeat;"></td>
      </tr>
     </table>
     
     <div class="dingdanlist">
      @foreach($res1 as $v)
      @if($v->is_default == '1')
      <table style="background-color:orange" p="{{$v->id}}">
      @else
      <table p="{{$v->id}}">
      @endif
       <tr>
        <td width="15%"><input type="radio" class="box" name="box"></td>
        <td width="30%">
         <h3>{{$v->name}}</h3>
         <time>{{$v->province}}{{$v->city}}{{$v->area}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$v->detail}}</time>
        </td> 
        @if($v->is_default == '1')
        <td align="right" style="display:none">
          <a href="javascript:;" class="hui">
              <span class="glyphicon glyphicon-check"></span> 
            设为默认
            </a>
        </td>  
          @else
            <td align="right">
          <a href="javascript:;" class="hui">
              <span class="glyphicon glyphicon-check"></span> 
            设为默认
            </a>
        </td>  
          @endif
       </tr>
      </table>
         @endforeach
     </div><!--dingdanlist/-->
    </div><!--maincont-->
     <div class="dingdanlist" >
      <table>
       <tr><td colspan="3" style="height:10px; background:#efefef;padding:0;"></td></tr>
       <tr><td colspan="3" style="height:10px; background:#efefef;padding:0;"></td></tr>
       <tr>
        <td class="dingimg" width="75%" colspan="2">支付方式</td>
        <td align="right"><span class="hui">支付宝</span></td>
       </tr>
       <tr><td colspan="3" style="height:10px; background:#efefef;padding:0;"></td></tr>
       <tr>
        <td class="dingimg" width="75%" colspan="2">优惠券</td>
        <td align="right"><span class="hui">无</span></td>
       </tr>
       <tr><td colspan="3" style="height:10px; background:#efefef;padding:0;"></td></tr>
      <!--  <tr>
        <td class="dingimg" width="75%" colspan="2">是否需要开发票</td>
        <td align="right"><a href="javascript:;" class="orange">是</a> &nbsp; <a href="javascript:;">否</a></td>
       </tr>
       <tr>
        <td class="dingimg" width="75%" colspan="2">发票抬头</td>
        <td align="right"><span class="hui">个人</span></td>
       </tr>
       <tr>
        <td class="dingimg" width="75%" colspan="2">发票内容</td>
        <td align="right"><a href="javascript:;" class="hui">请选择发票内容</a></td>
       </tr> -->
       <tr><td colspan="3" style="height:10px; background:#fff;padding:0;"></td></tr>
       <tr>
        <td class="dingimg" width="75%" colspan="3">商品清单</td>
       </tr>
       @foreach($res as $v)
       
       <tr>
        <input type="hidden" class="sbwy" value="{{$v->goods_id}}">
        <td class="dingimg" width="15%"><img src="/one/uploads/goods/{{$v->goods_img}}" /></td>
        <td width="50%">
         <h3>{{$v->goods_name}}</h3>
         <time>下单时间：<?php echo date('Y-m-d H:i:s',$v->create_time)?></time>
        </td>
        <td align="right"><span class="qingdan">X {{$v->buy_number}}</span></td>
       </tr>
       <tr>
        <th colspan="3"><strong class="orange price">¥<font style="color:orange" >{{$v->buy_number*$v->self_price}}</font></strong></th>
       </tr>
       @endforeach
       
       <tr>
        <td class="dingimg" width="75%" colspan="2">商品金额</td>
        <td align="right">¥<strong class="orange" id="allpr">0</strong></td>
       </tr>
       <!-- <tr>
        <td class="dingimg" width="75%" colspan="2">运费</td>
        <td align="right"><strong class="orange">¥20.80</strong></td>
       </tr> -->
      </table>
     </div><!--dingdanlist/-->
     
     
    </div><!--content/-->
    
    <div class="height1"></div>
    <div class="gwcpiao">
     <table>
      <tr>
       <th width="10%"><a href="javascript:history.back(-1)"><span class="glyphicon glyphicon-menu-left"></span></a></th>
       <td width="50%">总计：¥<strong class="orange" id="allp">0</strong></td>
       <td width="40%"><a class="jiesuan">提交订单</a></td>
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
  </body>
</html>
<script src="/layui/layui.js"></script>
<script>
  $(function(){
    layui.use('layer',function(){
        var layer = layui.layer;
            //修改总价信息
            var price = $('.price');
            var all=0;
            price.each(function(index){
                all+=parseInt($(this).find('font').text());
            })
//             console.log($('#allp'));
            $('#allpr').text(all);
            $('#allp').text(all);
         //点击默认
        $(document).on('click','.hui',function(){
          var id=$(this).parents('table').attr('p');
          // alert(id);
          var _this = $(this);
          $.ajaxSetup({
             headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
          });
          $.post(
            "/Jewe/moaddress/"+id
            ,function(res){
              // console.log(res);
              if(res==1){
                $('.hui').parent('td').show();
                $('.hui').parents('table').css('background-color','');
                _this.parent('td').hide();
                _this.parents('table').css('background-color','orange');
                layer.msg('设为默认成功',{icon:1});
              }else{
                 layer.msg('设为默认失败',{icon:2});
              }
            }
          );
        })
        
         // 点击结算
        $(document).on('click','.jiesuan',function(){
          // alert(11111);\
           var box = $('.box');
           //获取收货地址的id
           var orderaddress_id='';
           
           var allprice = $('#allpr').text();
           box.each(function(index){
            if($(this).prop('checked')==true){
              orderaddress_id=$(this).parents('table').attr('p');
            }
          })
           if(orderaddress_id==''){
            layer.msg('请选择收货地址',{icon:2});
            return false;
           }


           //获取商品的id
           var goods =$('.sbwy'); 
           var goods_id='';
           goods.each(function(index){
              goods_id+=$(this).val()+',';
           })
           $.ajaxSetup({
             headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
            });
            var flag = '';
            $.post(
                    '/Jewe/clear_cart'
                    ,{goods_id:goods_id}
                    ,function(res){
                        console.log(res);
                        if(res==2){
                           flag = false;
                        }
                    }
            );
            if(flag!=''){
                return flag;
            }
           $.post(
            '/Jewe/success'
            ,{orderaddress_id:orderaddress_id,goods_id:goods_id,allprice:allprice}
            ,function(res){
              console.log(res);
              if(res==1){
                layer.msg('订单提交成功',{icon:res,time:800},function(){
                    location.href="/Jewe/orderDetail"
                });
              }else{
                layer.msg('订单提交失败',{icon:res,time:800},function(){
                    history.go(0);
                });
              }
              
            }
          );
           // location.href="/Jewe/success?orderaddress_id="+orderaddress_id+"&&goods_id="+goods_id;
          return false;
        })








        //点击删除信息
        // $(document).on('click','.orange',function(){
        //   // console.log($('.box'));
        //   var box = $('.box');
        //   var id = '';
        //   box.each(function(index){
        //     if($(this).prop('checked')==true){
        //       id+=$(this).parents('table').attr('p')+',';
        //     }
        //   })
        //   // console.log(id);
        //    $.ajaxSetup({
        //      headers: {
        //       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //      }
        //   });
        //   $.post(
        //       '/Jewe/deaddress'
        //       ,{id:id}
        //       ,function(res){
        //         // console.log(res);
        //          if(res==1){
        //           box.each(function(index){
        //             if($(this).prop('checked')==true){
        //               $(this).parents('table').remove();
        //             }
        //           })
        //           layer.msg('地址删除成功',{icon:res});
        //         }else{
        //           layer.msg('地址信息删除错误',{icon:2});
        //         }
        //       }
        //   );
        // });
    });
  })
</script>