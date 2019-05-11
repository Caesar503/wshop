<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../css/page.css">
	<title>首页</title>
</head>
<body>
	<h3>公告管理</h3>
	<hr>
	<a href="/Ades/add"><input type="button" value="添加"></a>
	<br>
	<br>
	<form>
		关键字：<input type="text" name="keyword">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		是否展示:<input type="radio" name="is_show" value="1">展示<input type="radio" name="is_show" value="2">隐藏&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="submit" value="搜索">
	</form>
	<br>
	<table border="1">
		<tr>
			<td align="center">公告序号</td>
			<td align="center">公告标题</td>
			<td align="center">关键字</td>
			<td align="center">是否展示</td>
			<td align="center">公告图片</td>
			<td align="center">内容</td>
			<td align="center">操作</td>
		</tr>
		@foreach($res as $v)
		<tr>
			<td>{{$v->id}}</td>
			<td>{{$v->title}}</td>
			<td>{{$v->keyword}}</td>
			<td>@if($v->is_show ==1)是@else否@endif</td>
			<td><img src="{{$p}}/storage/app/{{$v->img}}" style="width: 60px;height:60px"></td>
			<td>{{$v->content}}</td>
			<td><a href="/Ades/del/{{$v->id}}">删除</a>|<a href="/Ades/upd/{{$v->id}}">编辑</a></td>
		</tr>
		@endforeach
	</table>
	{{ $res->appends($where)->links() }}
</body>
</html>