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
					<span id="scoreMallTitle">商品详情</span>
				</div>
			</div>
		</div>
		<div class="container" style="background-color:white;">
			<div id="ScoreMallDetail">
				<div class="row" style="background-color:#d9edf7;height:180px;padding:0px;">
					<img src="{$commodityinfo.imgurl}" style="width:100%;height:100%;">
				</div>
				<div class="row">
					<div class="col-xs-8">
						<p style="font-size:16px;">{$commodityinfo.name}</p>
					</div>
					<div class="col-xs-4 colRight">
						{if $commodityinfo.count <= 0}
						<button type="button" class="btn btn-primary btn-sm disabled" id="ScoreExchange">兑换</button>
						{else}
						<button type="button" class="btn btn-primary btn-sm" id="ScoreExchange">兑换</button>
						{/if}
					</div>
				</div>
				<div class="row" style="padding: 0px 25px;color:#767876;font-size:14px;">
					<p style="word-break:break-all;">
					{$commodityinfo.shortdesc}
					</p>
				</div>
				<div class="row" style="padding:0px;">
					{if $commodityinfo.description1 neq ""}
					<div class="row" style="margin:10px;padding: 10px 20px;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;background-color:white;">
						{$commodityinfo.description1}
					</div>
					{/if}
					{if $commodityinfo.description2 neq ""}
					<div class="row" style="margin:10px;padding: 10px 20px;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;background-color:white;">
						{$commodityinfo.description2}
					</div>
					{/if}
					{if $commodityinfo.description3 neq ""}
					<div class="row" style="margin:10px;padding: 10px 20px;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;background-color:white;">
						{$commodityinfo.description3}
					</div>
					{/if}
					<div class="row" style="margin:10px;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;background-color:white;">
						<div class="col-xs-5" style="color:#404340;">商品库存</div>
						<div class="col-xs-7">{$commodityinfo.count}</div>
					</div>
					<div class="row" style="margin:10px;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;background-color:white;">
						<div class="col-xs-5" style="color:#404340;">正常价格</div>
						<div class="col-xs-7">{$commodityinfo.price1}</div>
					</div>
					<div class="row" style="margin:10px;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;background-color:white;">
						<div class="col-xs-5" style="color:#404340;">正常积分</div>
						<div class="col-xs-7">{$commodityinfo.score1}</div>
					</div>
					{*
					<div class="row" style="margin:10px;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;background-color:white;">
						<div class="col-xs-5" style="color:#404340;">续费折扣价格</div>
						<div class="col-xs-7">{$commodityinfo.price2}</div>
					</div>
					<div class="row" style="margin:10px;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;background-color:white;">
						<div class="col-xs-5" style="color:#404340;">续费折扣积分</div>
						<div class="col-xs-7">{$commodityinfo.score2}</div>
					</div>
					<div class="row" style="margin:10px;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;background-color:white;">
						<div class="col-xs-5" style="color:#404340;">积分抵扣价格</div>
						<div class="col-xs-7">{$commodityinfo.price3}</div>
					</div>
					<div class="row" style="margin:10px;">
						<div class="col-xs-5" style="color:#404340;">积分抵扣积分</div>
						<div class="col-xs-7">{$commodityinfo.score3}</div>
					</div>
					*}
				</div>
			</div>
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
			console.log({json_encode($commodityinfo)});
			
			$("#scoreMallBackBtn").click(function(){
				window.location.href = "u.scoremall.php";
			})
			$("#ScoreExchange").click(function(){
				if({$commodityinfo.count} <= 0){
					return;
				}				
				url = "btnajax.php?mode=Exchange";
				$.post(url,{
					commodityid : {$commodityinfo.id},
					price : {$commodityinfo.price1},
					score : {$commodityinfo.score1}
				},function(json,status){
					window.location.href = "u.pay.php?commodityinfoid="+json;
				});
				
			})
		}
   </script> 
</html>