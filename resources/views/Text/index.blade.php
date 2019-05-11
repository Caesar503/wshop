<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="../css/page.css">
<head>
	<title>测试</title>
</head>
<body>
	<br>
	<h3>订单管理</h3>
	<br>
	<form>
		支付状态：<select name="pay_status">
					<option value="">请选择</option>
					<option value="1">未支付</option>
					<option value="2">已支付</option>
				</select>
		<input type="submit" value="搜索">
	</form>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<table border="1">
		<tr>
			<td>订单序号</td>
			<td>订单号</td>
			<td>支付状态</td>
			<td>支付类型</td>
			<td>下单时间</td>
		</tr>
		@foreach($res as $v)
		<tr>
			<td> {{$v->order_id}} </td>
			<td>{{$v->order_no}} </td>
			<td>@if($v->pay_status==1)未支付@else已支付@endif</td>
			<td>@if($v->pay_type==1)支付宝@elseif($v->pay_type==2)余额支付@elseif($v->pay_type==3)货到付款@endif</td>
			<td><?php echo date('Y-m-d H:i:s',$v->create_time)?></td>
		</tr>
		@endforeach
	</table>
	{{ $res->appends($where)->links() }}
</body>
</html>