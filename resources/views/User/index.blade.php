<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../css/page.css">
	<title></title>
</head>
<body>
	<h3>用户列表展示</h3>
	<a href="/User/create"><input type="button" value="添加"></a>
	<hr />
	<br>
	<form>
		搜索关键字：<input type="text" name="username">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;性别：
		<input type="radio" name="sex" value="1">男
		<input type="radio" name="sex" value="2">女
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="submit" value="点击搜索">
	</form>
	<br><br>
	<table>
		<tr>
			<td align="center">用户id</td>
			<td align="center">用户名</td>
			<td align="center">性别</td>
			<td align="center">电话</td>
			<td align="center">邮箱</td>
			<td align="center">头像</td>
			<td align="center">操作</td>
		</tr>
		<?php foreach ($res as $key => $value): ?>
		<tr>
			<td id="user_id"><?php echo $value->id?></td>
			<td><?php echo $value->username?></td>
			@if($value->sex == 1)
			<!-- <td><?php echo $value->sex?></td> -->
			<td>男</td>
			@elseif($value->sex == 2)
			<td>女</td>
			@endif
			<td><?php echo $value->tel?></td>
			<td><?php echo $value->email?></td>
			<td><img src="{{$pp}}/storage/app/<?php echo $value->headlogo?>" style="height:150px;width:200px"></td>
			<td>
				<button id="dele">删除</button>
				<a href="{{route('edit')}}?id={{$value->id}}">编辑</a>
			</td>
		</tr>	
		<?php endforeach ?>
	</table>
	{{ $res->appends($where)->links() }}
</body>
</html>
<script src="../js/jquery-3.2.1.min.js"></script>
<script src="../layui/layui.js"></script>
<script>
	$(function(){
		layui.use('layer',function(){
			var layer = layui.layer;
			//点击删除
			$(document).on('click','#dele',function(){
				var id= $(this).parents('tr').children().first().text();
				// alert(id);
				// console.log(id);
				$.get(
					"/User/dele"
					,{id:id}
					,function(res){
						if(res ==1){
							layer.msg('删除成功',{icon:res,time:1500},function(){
								history.go(0);
							});
							// alert('删除成功');
						}else{
							// alert('删除失败');
							layer.msg('删除失败',{icon:res,time:1500},function(){
								history.go(0);
							});
							
						}
					}
				);
			});
		})
	})
</script>