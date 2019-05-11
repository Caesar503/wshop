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
       <h1>收货地址</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/one/images/head.jpg" />
     </div><!--head-top/-->
     <table class="shoucangtab">
      <tr>
       <td width="75%"><a href="/Jewe/addaddress" class="hui"><strong class="">+</strong> 新增收货地址</a></td>
       <td width="25%" align="center" style="background:#fff url(/one/images/xian.jpg) left center no-repeat;"><a href="javascript:;" class="orange">删除信息</a></td>
      </tr>
     </table>
     
     <div class="dingdanlist">
      @foreach($res as $v)
      @if($v->is_default == '1')
      <table style="background-color:orange" p="{{$v->id}}">
      @else
      <table p="{{$v->id}}">
      @endif
       <tr>
        <td width="15%"><input type="checkbox" class="box"></td>
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
<script src="/layui/layui.js"></script>
<script>
  $(function(){
    layui.use('layer',function(){
        var layer = layui.layer;
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
        //点击删除信息
        $(document).on('click','.orange',function(){
          // console.log($('.box'));
          var box = $('.box');
          var id = '';
          box.each(function(index){
            if($(this).prop('checked')==true){
              id+=$(this).parents('table').attr('p')+',';
            }
          })
          // console.log(id);
           $.ajaxSetup({
             headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
          });
          $.post(
              '/Jewe/deaddress'
              ,{id:id}
              ,function(res){
                // console.log(res);
                 if(res==1){
                  box.each(function(index){
                    if($(this).prop('checked')==true){
                      $(this).parents('table').remove();
                    }
                  })
                  layer.msg('地址删除成功',{icon:res});
                }else{
                  layer.msg('地址信息删除错误',{icon:2});
                }
              }
          );
        });
    });
  })
</script>