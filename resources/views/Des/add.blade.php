<!DOCTYPE html>
<html>
<head>
	<title>友情链接添加</title>
	<link rel="stylesheet" type="text/css" href="../css/page.css">
</head>
<body>
	<h3>友情链接添加</h3>
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
				<td align="right">网站名称:</td>
				<td><input type="text" name="name" placeholder="请输入" id='title'></td>
			</tr>
			<tr>
				<td align="right">网站网址:</td>
				<td><input type="text" name="http" placeholder="请输入"></td>
			</tr>
			<tr>
				<td align="right">连接类型:</td>
				<td>
					<input type="radio" name="cate" value="1" checked>logo链接
					<input type="radio" name="cate" value="2">文字链接
				</td>
			</tr>
			<tr>
				<td align="right">是否显示:</td>
				<td>
					<input type="radio" name="is_show" value="1"checked>是
					<input type="radio" name="is_show" value="2">否
				</td>
			</tr>
			<tr>
				<td align="right">图片logo:</td>
				<td><input type="file" name="logo"></td>
			</tr>
			<tr>
				<td align="right">网站联系人:</td>
				<td><input type="text" name="person"></td>
			</tr>
			<tr>
				<td align="right">网站介绍:</td>
				<td><textarea name="desc"></textarea></td>
			</tr>
			<tr>
				<td colspan="2" align="center"><input type="submit" value="提交" id="but"></td>
			</tr>
		</table>
	</form>
</body>
</html>
<script src="../js/jquery-3.2.1.min.js"></script>
<script src="../layui/layui.js"></script>
<!-- <script>
	$(function(){
		layui.use(['layer'],function(){
			var layer = layui.layer;
			$(document).on('click','#but',function(){
				// alert(1111);
				var reg = /^(\w|[\w{4e00}-\w{9fa5}]){1,}$/;
				if($('#title').val()==''){
					layer.msg('不能为空',{icon:2});
					return false;
				}else if(!reg.test($('#title').val())){
					layer.msg('格式不正确',{icon:2});
					return false;
				}
			})
		})
	})
</script> -->