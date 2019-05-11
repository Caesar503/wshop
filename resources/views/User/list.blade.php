<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	
	<h3>用户列表展示</h3>
	<hr />
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
			<td><?php echo $value->id?></td>
			<td><?php echo $value->username?></td>
			@if($value->sex == 1)
			<!-- <td><?php echo $value->sex?></td> -->
			<td>男</td>
			@elseif($value->sex == 2)
			<td>女</td>
			@endif
			<td><?php echo $value->tel?></td>
			<td><?php echo $value->email?></td>
			<td><img src="http://www.logo.com/storage/app/<?php echo $value->headlogo?>" style="height:200px;width:300px"></td>
			<td><a href="">操作</a></td>
		</tr>	
		<?php endforeach ?>
	</table>
</body>
</html>