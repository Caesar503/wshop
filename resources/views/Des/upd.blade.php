<!DOCTYPE html>
<html>
<head>
	<title>友情链接修改</title>
	<link rel="stylesheet" type="text/css" href="../css/page.css">
</head>
<body>
	<h3>友情链接修改</h3>
	<hr />
	<form method="post" action="/Des/upddo/{{$res->id}}" enctype="multipart/form-data">
		<input type="hidden" id="id" p="{{$res->id}}">
		<table>
		{{csrf_field()}}
			<tr>
				<td align="right">网站名称:</td>
				<td><input type="text" name="name" placeholder="请输入" id='title' value="{{$res->name}}"></td>
			</tr>
			<tr>
				<td align="right">网站网址:</td>
				<td><input type="text" name="http" placeholder="请输入" value="{{$res->http}}"></td>
			</tr>
			<tr>
				<td align="right">连接类型:</td>
				<td>
					@if($res->cate == 1)
					<input type="radio" name="cate" value="1" checked>logo链接
					<input type="radio" name="cate" value="2">文字链接
					@else
					<input type="radio" name="cate" value="1">logo链接
					<input type="radio" name="cate" value="2" checked>文字链接
					@endif
				</td>
			</tr>
			<tr>
				<td align="right">是否显示:</td>
				<td>@if($res->is_show == 1)
					<input type="radio" name="is_show" value="1" checked>是
					<input type="radio" name="is_show" value="2">否
					@else
					<input type="radio" name="is_show" value="1">是
					<input type="radio" name="is_show" value="2" checked>否
					@endif
				</td>
			</tr>
			<tr>
				<td align="right">图片logo:</td>
				<td><img src="{{$p}}/storage/app/{{$res->logo}}" style="width: 60px;height:60px"><input type="file" name="logo"></td>
			</tr>
			<tr>
				<td align="right">网站联系人:</td>
				<td><input type="text" name="person" value="{{$res->person}}"></td>
			</tr>
			<tr>
				<td align="right">网站介绍:</td>
				<td><textarea name="desc">{{$res->desc}}</textarea></td>
			</tr>
			<tr>
				<td colspan="2" align="center"><input type="button" value="提交" id="but"></td>
			</tr>
		</table>
	</form>
</body>
</html>
<script src="/js/jquery-3.2.1.min.js"></script>
<script src="/layui/layui.js"></script>
<script>
	$(function(){
		layui.use(['layer'],function(){
			var layer = layui.layer;
			$(document).on('click','#but',function(){
				// alert(1111);
				var name = $('#title').val();
				var id =$('#id').attr('p');
				// alert(id);
				var reg = /^[a-z]\w{1,}$/u;
				if($('#title').val()==''){
					layer.msg('不能为空',{icon:2});
					return false;
				}else if(!reg.test(name)){
					layer.msg('格式不正确',{icon:2});
					return false;
				}else{
					$falg=false;
					$.get(
						"/Des/checkname/"+id
						,{name:name}
						,function(res){
							if(res==1){
								layer.msg('已经存在',{icon:res});
								falg=false;
							}else{
								falg=''
							}
						}
					);
					if($falg!=''){
						return falg;
					}
				}
				$('form').submit();
			})
		})
	})
</script>