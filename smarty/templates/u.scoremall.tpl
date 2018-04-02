{include file="file:u.header.tpl"}
{*<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<title>至美教育会员商城</title>
		<link href="style/bootstrap.css" rel="stylesheet"/>	
		<link href="style/style.css" rel="stylesheet"/>		
	</head>
	<body>*}
		<div class="pageTitle">
			<div class="row">
				<div class="col-xs-4">
					<span id="scoreMallBackBtn" class="glyphicon glyphicon-chevron-left" style="pading-right:5px;">返回</span>
				</div>
				<div class="col-xs-8">
					<span id="scoreMallTitle">积分商城</span>
				</div>
			</div>
		</div>
		<div style="overflow-x: hidden !important;" id="scoremallContainer">			
			{foreach $scoremall as $s}
				<div id="scoreMallList{counter}" onclick="ShowScoreOne({$s.id})"  style="float:left;width:50%;margin-top:5px;border:1px solid #e5e7e5;background-color:white;">
					<img src="{$s.imgurl}" style="width:100%;height:150px;margin-bottom: 10px;">
					<div style="padding: 0px 10px;">
						<p style="font-size:16px;color:black;">{$s.name}</p>
						<p style="color:#767876;font-size:14px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;width:100%;">
						{$s.shortdesc}
						</p>
					</div>
				</div>
			{foreachelse}
					<p style="padding-top: 50px;text-align:center;font-size: 17px;">暂无数据</p>
			{/foreach}
		</div>
	</body>
	{include file="file:u.footer.tpl"}
	<script type="text/javascript">
		var Settings = {};
	
		window.onload = OnLoad;
		
		function OnLoad(){
			BindEvents();
		}
		function BindEvents(){
			console.log({json_encode($scoremall)});
			console.log({$scoremall|@count});
			
			$("#scoreMallBackBtn").click(function(){
				window.location.href = "u.my.php";
			})
		}
		function ShowScoreOne(id){
			window.location.href = "u.scoremalldetail.php?commodityid="+id;
		}
   </script> 
</html>