<!DOCTYPE html>
<html>
<head>
	<title>首页</title>
	<link rel="stylesheet" type="text/css" href="../css/page.css">

</head>
<body>
	<h3>友情链接</h3>
	<hr>
	<a href="/Des/add"><button>添加</button></a>
	<br>
	<br>
	<form>
		名称关键字：<input type="text" name="name">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		是否展示:<input type="radio" name="is_show" value="1">展示<input type="radio" name="is_show" value="2">隐藏&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="submit" value="搜索">
	</form>
	<br>
	<table border="1">
		{{csrf_field()}}
		<tr>
			<td align="center">序号</td>
			<td align="center">网站名称</td>
			<td align="center">LOGO</td>
			<td align="center">状态</td>
			<td align="center">链接类型</td>
			<td align="center">管理操作</td>
		</tr>
		@foreach($res as $v)
		<tr>
			<td>{{$v->id}}</td>
			<td>{{$v->name}}</td>
			<td><img src="{{$p}}/storage/app/{{$v->logo}}" style="width: 60px;height:60px"></td>
			<td>@if($v->is_show ==1)是@else否@endif</td>
			<td>@if($v->cate ==1)LOGO链接@else文字链家@endif</td>
			<td><a id="del" p="{{$v->id}}">删除</a>|<a href="/Des/upd/{{$v->id}}">编辑</a></td>
		</tr>
		@endforeach
	</table>
	{{ $res->appends($where)->links() }}
</body>
</html>
<script src="../js/jquery-3.2.1.min.js"></script>
<script src="../layui/layui.js"></script>
<script>
	$(function(){
		layui.use(['layer'],function(){
			var layer = layui.layer;
			$(document).on('click','#del',function(){
				var id = $(this).attr('p');
				// alert(id);
				$.get(
					'/Des/del/'+id
					// ,{id:id}
					,function(res){
						if(res==1){
							layer.msg('成功',{icon:1,time:1000},function(){
								history.go(0);
							});
						}else{
							layer.msg('失败',{icon:2,time:1000},function(){
								history.go(0);
							});
						}
					}
				);
			})
		})
	})
</script>