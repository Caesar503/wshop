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
	<form method="post" action="{{route('do')}}" enctype="multipart/form-data">
		<table>
			@csrf
			<tr>
				<td align="right">用户名:</td>
				<td><input type="text" name="username" placeholder="请输入用户名"></td>
			</tr>
			<tr>
				<td align="right">密码:</td>
				<td><input type="text" name="pwd" placeholder="请输入密码"></td>
			</tr>
			<tr>
				<td align="right">确认密码:</td>
				<td><input type="text" name="repwd" placeholder="请输入密码"></td>
			</tr>
			<tr>
				<td align="right">性别:</td>
				<td><input type="radio" name="sex" value="1">男<input type="radio" name="sex" value="2">女</td>
			</tr>
			<tr>
				<td align="right">手机号:</td>
				<td><input type="text" name="tel" placeholder="请输入手机号"></td>
			</tr>
			<tr>
				<td align="right">邮箱:</td>
				<td><input type="text" name="email" placeholder="请输入邮箱"></td>
			</tr>
			<tr>
				<td align="right">头像:</td>
				<td><input type="file" name="headlogo"></td>
			</tr>
			<tr>
				<td colspan="2" align="center"><input type="submit" value="提交"></td>
			</tr>
		</table>
	</form>
</body>
</html>