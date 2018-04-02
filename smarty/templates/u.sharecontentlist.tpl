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
					<span id="sharecontentlistBackBtn" class="glyphicon glyphicon-chevron-left" style="pading-right:5px;">返回</span>
				</div>
				<div class="col-xs-8">
					<span id="sharecontentlistTitle">分享帖子</span>
				</div>
			</div>
		</div>
		<div style="overflow-x: hidden !important;">
			{foreach $sharecontentlist as $l}
				<div onclick="ShowshareOne({$l.id})" style="margin-top:5px;border:1px solid #e5e7e5;background-color:white;">
					<div class="row" style="background-color:white;">
						<div class="col-xs-7">
							<span style="font-size:16px;display:block;">{$l.title}</span>
							<span style="display:block;padding:3px 0px;color:#767876;font-size:14px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;width:100%;">
								{$l.description}
							</span>
							<span style="display:block;font-size:10px;color: #607d8b;">创建时间: {$l.createtime}</span>
						</div>
						<div class="col-xs-5 colRight">
							<img style="width:112px;height:65px;" src="{$l.picurl}">
						</div>
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
			console.log({json_encode($sharecontentlist)});
			console.log({$sharecontentlist|@count});	
			
			$("#sharecontentlistBackBtn").click(function(){
				window.location.href = "u.my.php";
			})
		}
		function ShowshareOne(id){
			window.location.href = "u.sharecontent.php?noteid="+id;
		}
   </script> 
</html>