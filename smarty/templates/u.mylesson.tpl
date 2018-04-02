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
		<div id="ShowLessonCodeImg" class="hidden"  style="z-index:999;position:fixed;padding: 40% 20%;top:0;left:0;right:0;bottom:0;overflow-y:auto;background-color:rgba(255, 255, 255, 0.56);"></div>
		<div class="pageTitle">
			<div class="row">
				<div class="col-xs-4">
					<span id="myLessonBackBtn" class="glyphicon glyphicon-chevron-left" style="pading-right:5px;">返回</span>
				</div>
				<div class="col-xs-8">
					<span id="myLessonTitle">我的课程详情</span>
				</div>
			</div>
		</div>
		<div class="container" style="background-color:white;">
			<div id="myLessonInfo">
				{*<div class="row" style="background-color:#d9edf7;height:150px;">
				</div>*}
				<div class="row">
					<div class="col-xs-6">
						<p style="font-size:16px;">{$courseinfo.title}</p>
					</div>
					<div class="col-xs-6 colRight">
						<p style="color:#607d8b;font-size:14px;">
							{$courseinfo.ordertime}
						</p>
					</div>
				</div>
				<div class="row" style="padding: 0px 25px;color:#767876;font-size:14px;">
					<p style="word-break:break-all;">
					{$courseinfo.shortdesc}
					</p>
				</div>
				<div class="row" style="padding:0px;">
					{if $courseinfo.description1 neq ""}
					<div class="row" style="margin:10px;padding: 10px 25px;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;background-color:white;">
						{$courseinfo.description1}
					</div>
					{/if}
					{if $courseinfo.description2 neq ""}
					<div class="row" style="margin:10px;padding: 10px 25px;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;background-color:white;">
						{$courseinfo.description2}
					</div>
					{/if}
					{if $courseinfo.description3 neq ""}
					<div class="row" style="margin:10px;padding: 10px 25px;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;background-color:white;">
						{$courseinfo.description3}
					</div>
					{/if}
					<div class="row" id="RowLessonNumber" style="margin:10px;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;background-color:white;">
						<div class="col-xs-4" style="color:#404340;">报名人数</div>
						<div class="col-xs-8">{$courseinfo.count}</div>
					</div>
					<div class="row" id="RowLessonSchool" style="margin:10px;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;background-color:white;">
						<div class="col-xs-4" style="color:#404340;">课程校区</div>
						<div class="col-xs-8">{$courseinfo.schoolname}</div>
					</div>
					<div class="row" id="RowLessonType" style="margin:10px;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;background-color:white;">
						<div class="col-xs-4" style="color:#404340;">课程类型</div>
						<div class="col-xs-8">{$courseinfo.coursetype}</div>
					</div>
					<div class="row" style="margin:10px;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;background-color:white;">
						<div class="col-xs-4" style="color:#404340;">上课时段</div>
						<div class="col-xs-8">
							{if $courseinfo.span eq 10}
								<p>2周</p>
							{elseif $courseinfo.span eq 20}
								<p>1个月</p>
							{elseif $courseinfo.span eq 30}
								<p>2个月</p>
							{elseif $courseinfo.span eq 40}
								<p>3个月</p>
							{elseif $courseinfo.span eq 50}
								<p>6个月</p>
							{elseif $courseinfo.span eq 60}
								<p>12个月</p>
							{/if}	
						</div>
					</div>
					<div class="row" style="margin:10px;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;background-color:white;">
						<div class="col-xs-4" style="color:#404340;">上课时间</div>
						<div class="col-xs-8">{$courseinfo.timerinfo}
							{*<p>{$courseinfo.timefrom|mb_substr:11:8:'GBK'} - {$courseinfo.timeto|mb_substr:11:8:'GBK'}</p>*}
						</div>
					</div>
					<div class="row" style="margin:10px;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;background-color:white;">
						<div class="col-xs-4" style="color:#404340;">价格</div>
						<div class="col-xs-8">{$courseinfo.price}</div>
					</div>
					<div class="row" style="margin:10px;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;background-color:white;">
						<div class="col-xs-4" style="color:#404340;">积分</div>
						<div class="col-xs-8">{$courseinfo.score}</div>
					</div>
					{if $courseinfo.status eq 1}
						<div class="row" style="margin:10px;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;background-color:white;">
							<div class="col-xs-4" style="color:#404340;">支付状态</div>
							<div class="col-xs-8">
								未支付
							</div>
						</div>
						<div class="row" style="margin:10px;">
							<div class="col-xs-4" style="color:#404340;">支付方式</div>
							<div class="col-xs-8">
								<button type="button" class="btn btn-primary btn-sm" onclick="ShowLessonCode();">线下支付</button>&nbsp;&nbsp;&nbsp;&nbsp;
								<button type="button" class="btn btn-primary btn-sm" onclick="ShowLessonPay();">线上支付</button>
							</div>
						</div>
					{else}
						<div class="row" style="margin:10px;">
							<div class="col-xs-4" style="color:#404340;">支付状态</div>
							<div class="col-xs-8">
								已支付
							</div>
						</div>
					{/if}
				</div>
			</div>
		</div>
	</body>
	{include file="file:u.footer.tpl"}
	<script type="text/javascript">
		var courseinfoid = {$courseinfo.id};
		var courseinfonoteid = {$courseinfo.noteid};
		var p = '{$BarCodePara}';
		
		window.onload = OnLoad;
		
		function OnLoad(){
			BindEvents();
		}
		function BindEvents(){
			console.log({json_encode($courseinfo)});
			
			$("#ShowLessonCodeImg").mousedown(function(){
				$("#ShowLessonCodeImg").addClass("hidden");
				$("#ShowLessonCodeImg").html("");
			})
			
			$("#myLessonBackBtn").click(function(){
				window.location.href = "u.mylessons.php";
			})
		}
		function ShowLessonCode(){
			strCodeImg = 'http://www.wsestar.com/test/Kidcastle-Mall/checksignup.php?id='+courseinfoid+'&p='+p+'&noteid='+courseinfonoteid;
			$("#ShowLessonCodeImg").qrcode({
				render:"canvas",
				width:220,
				height:220,
				text:strCodeImg
			});
			$("#ShowLessonCodeImg").removeClass("hidden");
		}
		function ShowLessonPay(){
			window.location.href = "u.pay.php?courseinfoid="+{$courseinfo.id};
		}
   </script> 
</html>