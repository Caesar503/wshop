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
	<form method="post" action="/Ades/upddo/{{$res->id}}" enctype="multipart/form-data">
		<table>
		{{csrf_field()}}
			<tr>
				<td align="right">标题:</td>
				<td><input type="text" name="title" placeholder="请输入" value="{{$res->title}}"></td>
			</tr>
			<tr>
				<td align="right">关键词:</td>
				<td><input type="text" name="keyword" placeholder="请输入" value="{{$res->keyword}}"></td>
			</tr>
			<tr>
				<td align="right">是否上传:</td>
				<td>
					@if($res->is_show==1)
					<input type="radio" name="is_show" value="1" checked>是
					<input type="radio" name="is_show" value="2">否
					@endif
					@if($res->is_show==2)
					<input type="radio" name="is_show" value="1">是
					<input type="radio" name="is_show" value="2"checked>否
					@endif
				</td>
			</tr>
			<tr>
				<td align="right">公告图片:</td>
				<td><img src="{{$p}}/storage/app/{{$res->img}}" style="width: 60px;height:60px"><input type="file" name="img"></td>
			</tr>
			<tr>
				<td align="right">内容:</td>
				<td><textarea name="content">{{$res->content}}</textarea></td>
			</tr>
			<tr>
				<td colspan="2" align="center"><input type="submit" value="确定修改"></td>
			</tr>
		</table>
	</form>
</body>
</html>