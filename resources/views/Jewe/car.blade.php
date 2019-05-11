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
     <div class="head-top">
      <img src="/one/uploads/goods/20190118/2fd501293fc7eefe3bea88c3ee723596.jpg" />
     </div><!--head-top/-->
     <table class="shoucangtab">
      <tr>
       <td width="75%"><span class="hui">购物车共有：<strong>好多件</strong>件商品</span></td>
       <td width="25%" align="center" style="background:#fff url(/one/images/xian.jpg) left center no-repeat;">
        <span class="glyphicon glyphicon-shopping-cart" style="font-size:2rem;color:#666;"></span>
       </td>
      </tr>
     </table>
     

    

     <div class="dingdanlist">
      <table>
       <tr>
        <td width="100%" colspan="4"><a href="javascript:;"><input type="checkbox" class="allbox"/> 全选</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class="del">删除</button></td>
       </tr>
       @foreach($res as $v)
       <tr goods_id="{{$v->id}}" > 
          <td width="4%"><input type="checkbox" value="{{$v->id}}" class="box"/></td>
          <td class="dingimg" width="25%"><img src="/one/uploads/goods/{{$v->goods_img}}" /></td>
          <td width="50%">
             <h3>{{$v->goods_name}}</h3>
             <time style="color:orange">下单时间：<?php echo date('Y-m-d H:i:s',$v->create_time)?></time>
             <h6>库存<font id="goods_num">{{$v->goods_num}}</font></h6>
              <h6>单价<font id="self_price">{{$v->self_price}}</font></h6>
          </td>
          <td align="right">
            <button style="width:25px" id="jiannum">-</button>
            <p>{{$v->buy_number}}</p>
            <button id="addnum">+</button>
           <!--  <input type="hidden" value="{{$v->buy_number}}"/> -->
          </td>
       </tr>
       <tr id="next">
        <th colspan="4">¥<strong class="orange">{{$v->self_price*$v->buy_number}}</strong></th>
       </tr> 
       @endforeach
      </table>
     </div><!--dingdanlist/-->
    
    
     <div class="height1"></div>
     <div class="gwcpiao">
     <table>
      <tr>
       <th width="10%"><a href="javascript:history.back(-1)"><span class="glyphicon glyphicon-menu-left"></span></a></th>
       <td width="50%">总计：¥<strong id="allpr" style="color:red;font-size:30px">0</strong></td>
       <td width="40%"><a class="jiesuan">去结算</a></td>
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
        //获取所有的价格
        // var orange = $('.orange');
        // // console.log(orange);
        // _orange=0;
        // // orange = parseInt(orange.text());
        // orange.each(function(index){
        //   _orange+=parseInt($(this).text());
        // })
        // $('#allpr').text(_orange);
        // console.log(_orange);


        
        //点击+号
        $(document).on('click','#addnum',function(){
            //获取库存
            var goods_num = parseInt($(this).parents('td').prev('td').find('#goods_num').text());
            //获取商品的id
            var id = $(this).parents('tr').attr('goods_id');
            // alert(id);

            var num = parseInt($(this).prev('p').text());
            // alert(goods_num);
            if(num>=goods_num){
              num = parseInt(goods_num);
              $(this).prev('p').text(num);
            }else{
              num = parseInt(num)+1;
              $(this).prev('p').text(num);
            }
            var _this = $(this);
            $.get(
                "/Jewe/price"
                ,{buy_num:num,goods_id:id}
                ,function(res){
                  // console.log(res);
                  if(res==1){
                     smallPrice(_this,num);
                   }else{
                    layer.msg('修改商品数量失败',{icon:res});
                   }
                }
            );
            boxPrice();
        });
         //点击-号
        $(document).on('click','#jiannum',function(){
            //获取库存
            var goods_num = parseInt($(this).parents('td').prev('td').find('#goods_num').text());
            // alert(goods_num);
            //获取商品的id
            var id = $(this).parents('tr').attr('goods_id');
            // alert(id);

            var num = parseInt($(this).next('p').text());
            // alert(num);
            if(num<=0){
              num = 1;
              $(this).next('p').text(num);
            }else{
              num = parseInt(num)-1;
              $(this).next('p').text(num);
            }
             var _this = $(this);
            $.get(
                "/Jewe/price"
                ,{buy_num:num,goods_id:id}
                ,function(res){
                  // console.log(res);
                  if(res==1){
                     smallPrice(_this,num);
                   }else{
                    layer.msg('修改商品数量失败',{icon:res});
                   }
                }
            );
            boxPrice()
        });


        //全选
        $(document).on('click','.allbox',function(){
            var all = $(this).prop('checked');
            $('.box').prop('checked',all);
            boxPrice();
        });

        //选中
        $(document).on('click','.box',function(){
            boxPrice();
        })

        //小计
        function smallPrice(_this,$buy_number){
          var goods_price = _this.parent('td').prev('td').find('#self_price').text();
          _this.parents('tr').next('tr').find('strong').text($buy_number*goods_price);
        }

        //单选框
        function boxPrice(){
            var box = $('.box');
            var Price = 0;
            box.each(function(index){
                if($(this).prop('checked')==true){
                  Price+=parseInt($(this).parents('tr').next('tr').find('strong').text());
                }
            })
            // console.log(Price);
            $('#allpr').text(Price);
        }

        //结算
        $(document).on('click','.jiesuan',function(){
          // alert(111);/
          if($('#allpr').text()==0){
              layer.msg('您还没有选择商品',{icon:2});
              return false;
          }
          var box = $('.box');
          var id='';
          box.each(function(index){
              if($(this).prop('checked')==true){
                id+=$(this).parents('tr').attr('goods_id')+',';
              }
          });
          location.href="/Jewe/pay?id="+id;
          return false;
        })

        //点击删除
        $(document).on('click','.del',function(){
          // alert('aaaa');
          if($('#allpr').text()==0){
              layer.msg('您还没有选择商品',{icon:2});
              return false;
          }
          var box = $('.box');
          var delid = "";
          box.each(function(index){
              if($(this).prop('checked')==true){
                delid+=$(this).val()+',';
              }
          })
          // console.log(delid);
          $.ajaxSetup({
             headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
          });
          $.post(
              '/Jewe/deshop'
              ,{id:delid}
              ,function(res){
                 if(res==1){
                 //  box.each(function(index){
                 //    if($(this).prop('checked')==true){
                 //      $(this).parents('tr').remove();
                 //      // $(this).parents('tr').next('tr').remove();
                 //      console.log($(this).parents('tr'));
                 //    }
                 //  })
                  layer.msg('删除购物车商品成功',{icon:1,time:800},function(){
                      history.go(0);
                  });
                }else{
                  layer.msg('删除购物车商品错误',{icon:2});
                }
              }
          );
        })
       
    });
  })
</script>