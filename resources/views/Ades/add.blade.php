<!DOCTYPE html>
<html>
<head>
	<title>用户添加</title>
</head>
<body>
	<h3>用户添加</h3>
	<hr />
	@if ($errors->any())
	 <div class="alert alert-danger">
		 <ul>
			 @foreach ($errors->all() as $error)
			 	<li>{{ $error }}</li>
			 @endforeach
		 </ul>
	 </div>
	@endif
	<form method="post" action="{{route('adddo')}}" enctype="multipart/form-data">
		<table>
		{{csrf_field()}}
			<tr>
				<td align="right">标题:</td>
				<td><input type="text" name="title" placeholder="请输入"></td>
			</tr>
			<tr>
				<td align="right">关键词:</td>
				<td><input type="text" name="keyword" placeholder="请输入"></td>
			</tr>
			<tr>
				<td align="right">是否上传:</td>
				<td><input type="radio" name="is_show" value="1">是<input type="radio" name="is_show" value="2">否</td>
			</tr>
			<tr>
				<td align="right">公告图片:</td>
				<td><input type="file" name="img"></td>
			</tr>
			<tr>
				<td align="right">内容:</td>
				<td><textarea name="content"></textarea></td>
			</tr>
			<tr>
				<td colspan="2" align="center"><input type="submit" value="提交"></td>
			</tr>
		</table>
	</form>
</body>
</html>