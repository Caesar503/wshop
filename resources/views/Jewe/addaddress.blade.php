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
     <form action="/Jewe/addressdo" method="post" class="reg-login">
      @csrf
      <div class="lrBox">
       <div class="lrList"><input type="text" name="name" id="name" placeholder="收货人" /></div>
        <div class="lrList"><input type="text" name="tel" id="tel" placeholder="手机" /></div>
        <div class="lrList"><input type="text" value="所在省市县" disabled/></div>
       <div class="lrList">
        <select class="che" name="province" id="province">
          <option value="0">--请选择--</option>
          @foreach($res as $v)
         <option value="{{$v->id}}">{{$v->name}}</option>
         @endforeach
        </select>
       </div>
       <div class="lrList">
        <select class="che" name="city" id="city">
        <option value="0">--请选择--</option>
        </select>
       </div>
       <div class="lrList" id='replace'>
        <select class="che" name="area" id="area">
         <option value="0">--请选择--</option>
        </select>
       </div>
       <div class="lrList"><input type="text" id="detail" name="detail" placeholder="详细地址" /></div>
       <div class="lrList2"><input type="checkbox" id="is_default" name="is_default" value=1>设为默认</div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="submit" value="保存" id="sub"/>
      </div>
     </form><!--reg-login/-->
     
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
        //地址更新事件
        $(document).on('change','.che',function(){
          var _this = $(this);
          var id = _this.val();
          var name = $(this).prop('name');
          // alert(name);
          if(name!='province'&&name!='city'){
            return false;
          }
          $.ajaxSetup({
             headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
          })
          $.post(
            '/Jewe/getArea/'+id
            ,{name:name}
            ,function(res){
              // console.log(res);
              if(name=='province'){
                _this.parent('div').next('div').html(res);
                 $('#replace').html("<select class='che' name='area' id='area'><option value='0'>--请选择--</option></select>");
              }else{
                $('#replace').html(res);
              }
            }
          );
        });
        //点击提交的时候
        $(document).on('click','#sub',function(){
            // alert(111);
            if($('#name').val()==''){
              layer.msg('收件人不能空',{icon:2});
              return false;
            }
            if($('#tel').val()==''){
              layer.msg('手机不能为空',{icon:2});
              return false;
            }
            if($('#province').val()==0){
               layer.msg('省级以及直辖市，自治区不能为空',{icon:2});
              return false;
            }
            if($('#city').val()==0){
               layer.msg('市级不能为空',{icon:2});
              return false;
            }
            if($('#detail').val()==''){
              layer.msg('详细地址不能为空',{icon:2});
              return false;
            }
        });
    });
  })
</script>