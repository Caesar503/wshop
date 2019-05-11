
<!DOCTYPE html>
<html>
<head>
	<title>用户添加</title>
</head>
<body>
	@if($errors->any())
	 <div class="alert alert-danger">
	 <ul>
	 @foreach ($errors->all() as $error)
	 <li>{{ $error }}</li>
	 @endforeach
	 </ul>
	 </div>
	@endif
	<h3>用户添加</h3>
	<hr />
	<form method="post" action="{{route('editdo')}}" enctype="multipart/form-data">
		<table>
			{{csrf_field()}}
			<input type="hidden" name="id" value="{{$res->id}}">
			<tr>
				<td align="right">用户名:</td>
				<td><input type="text" name="username" placeholder="请输入用户名" value="{{$res->username}}"></td>
			</tr>
			<tr>
				<td align="right">密码:</td>
				<td><input type="text" id="pwd" placeholder="请输入密码"></td>
			</tr>
			<tr>
				<td align="right">确认密码:</td>
				<td><input type="text" id="repwd" placeholder="请输入密码"></td>
			</tr>
			<tr>
				<td align="right">性别:</td>
				<td>
					@if($res->sex==1)
					<input type="radio" name="sex" value="1" checked>男
					<input type="radio" name="sex" value="2">女
					@else
					<input type="radio" name="sex" value="1">男
					<input type="radio" name="sex" value="2" checked>女
					@endif
				</td>
			</tr>
			<tr>
				<td align="right">手机号:</td>
				<td><input type="text" name="tel" placeholder="请输入手机号" value="{{$res->tel}}"></td>
			</tr>
			<tr>
				<td align="right">邮箱:</td>
				<td><input type="text" name="email" placeholder="请输入邮箱" value="{{$res->email}}"></td>
			</tr>
			<tr>
				<td align="right">头像:</td>
				<td><img src="{{$pp}}/storage/app/<?php echo $res->headlogo?>" style="height:80px;width:80px"><input type="file" name="headlogo"></td>
			</tr>
			<!-- <img src="http://www.logo.com/storage/app/<?php echo $res->headlogo?>" style="height:80px;width:80px"> -->
			<tr>
				<td colspan="2" align="center"><input type="button" id="but" value="确定修改"></td>
			</tr>
		</table>
	</form>
</body>
</html>
<script src="../js/jquery-3.2.1.min.js"></script>
<script>
	$(function(){
		$('#but').click(function(){
			// alert('aaaa');
			if($('#pwd').val()!=''){
				$('#pwd').attr('name','pwd');
			}
			if($('#repwd').val()!=''){
				$('#repwd').attr('name','repwd');
			}
			$('form').submit();
		})
	})
</script>