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
					<span id="lessonsBackBtn" class="glyphicon glyphicon-chevron-left" style="pading-right:5px;">返回</span>
				</div>
				<div class="col-xs-8">
					<span id="lessonsListTitle">课程详情</span>
				</div>
			</div>
		</div>
		<div class="container" style="background-color:white;">
			<div id="LessonInfo">
				<div style="background-color:#d9edf7;height:180px;margin:0px -15px;">
					<img src="{$courseinfo.titleimage}" style="width:100%;height:100%;">
				</div>
				<div class="row">
					<div class="col-xs-8">
						<p style="font-size:16px;">{$courseinfo.title}</p>
					</div>
					<div class="col-xs-4 colRight">
						{if $courseinfo.count <= 0}
							<button type="button" class="btn btn-primary btn-sm disabled" id="lessonSignup1">报名</button>
						{else}
							<button type="button" class="btn btn-primary btn-sm" id="lessonSignup1">报名</button>
						{/if}
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
						<div class="col-xs-5" style="color:#404340;">报名人数</div>
						<div class="col-xs-7">{$courseinfo.count}</div>
					</div>
					<div class="row" id="RowLessonSchool" style="margin:10px;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;background-color:white;">
						<div class="col-xs-5" style="color:#404340;">课程校区</div>
						<div class="col-xs-7">{$courseinfo.school}</div>
					</div>
					<div class="row" id="RowLessonType" style="margin:10px;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;background-color:white;">
						<div class="col-xs-5" style="color:#404340;">课程类型</div>
						<div class="col-xs-7">{$courseinfo.coursetype}</div>
					</div>
					<div class="row" style="margin:10px;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;background-color:white;">
						<div class="col-xs-5" style="color:#404340;">上课时段</div>
						<div class="col-xs-7">
							{*<p>{$courseinfo.orderspan}</p>*}
							{foreach $courseinfo.orderspan as $s}
								{if $s.span eq 10}
									<div class="radio">
										<label>
											<input type="radio" name="lessonOrderspan" class="lessonOrderspan" value="{$s.id}">2周
										</label>
									</div>
								{elseif $s.span eq 20}
									<div class="radio">
										<label>
											<input type="radio" name="lessonOrderspan" class="lessonOrderspan" value="{$s.id}">1个月
										</label>
									</div>
								{elseif $s.span eq 30}
									<div class="radio">
										<label>
											<input type="radio" name="lessonOrderspan" class="lessonOrderspan" value="{$s.id}">2个月
										</label>
									</div>
								{elseif $s.span eq 40}
									<div class="radio">
										<label>
											<input type="radio" name="lessonOrderspan" class="lessonOrderspan" value="{$s.id}">3个月
										</label>
									</div>
								{elseif $s.span eq 50}
									<div class="radio">
										<label>
											<input type="radio" name="lessonOrderspan" class="lessonOrderspan" value="{$s.id}">6个月
										</label>
									</div>
								{elseif $s.span eq 60}
									<div class="radio">
										<label>
											<input type="radio" name="lessonOrderspan" class="lessonOrderspan" value="{$s.id}">12个月
										</label>
									</div>
								{/if}
							{foreachelse}
								<p>没有数据</p>
							{/foreach}
						</div>
					</div>
					<div class="row" style="margin:10px;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;background-color:white;">
						<div class="col-xs-5" style="color:#404340;">上课时间</div>
						<div class="col-xs-7">{$courseinfo.timerinfo}
							{*{foreach $courseinfo.timespan as $t}
									<div class="radio">
										<label>
											<input type="radio" name="lessonTimespan" class="lessonTimespan" value="{$t.id}">{$t.timefrom|mb_substr:11:8:'GBK'} - {$t.timeto|mb_substr:11:8:'GBK'}
										</label>
									</div>
							{foreachelse}
								<p>没有数据</p>
							{/foreach}*}
						</div>
					</div>
					{if $courseinfo.price2 eq 0}
					<div class="row" style="margin:10px;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;background-color:white;">
						<div class="col-xs-5" style="color:#404340;">报名价格</div>
						<div class="col-xs-7" style="color:#EF4E3A;font-size:14px;">
							{if $courseinfo.price1 neq 0}{$courseinfo.price1}元{/if}
							{if $courseinfo.price1 neq 0 && $courseinfo.score1 neq 0}+{/if}
							{if $courseinfo.score1 neq 0}{$courseinfo.score1} 积分{/if}
						</div>
					</div>
					{else if $courseinfo.statusinfo.isstudent eq 1}
						<div class="row" style="margin:10px;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;background-color:white;">
							<div class="col-xs-5" style="color:#404340;">报名价格</div>
							<div class="col-xs-7" style="color:#EF4E3A;font-size:14px;text-decoration:line-through;">
								{if $courseinfo.price1 neq 0}{$courseinfo.price1}元{/if}
								{if $courseinfo.price1 neq 0 && $courseinfo.score1 neq 0}+{/if}
								{if $courseinfo.score1 neq 0}{$courseinfo.score1} 积分{/if}
							</div>
						</div>
						<div class="row" style="margin:10px;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;background-color:white;">
							<div class="col-xs-5" style="color:#404340;">续费价格</div>
							<div class="col-xs-7" style="color:#EF4E3A;font-size:14px;">
								{if $courseinfo.price2 neq 0}{$courseinfo.price2}元{/if}
								{if $courseinfo.price2 neq 0 && $courseinfo.score2 neq 0}+{/if}
								{if $courseinfo.score2 neq 0}{$courseinfo.score2} 积分{/if}
							</div>
						</div>
					{/if}
					{if $courseinfo.price3 neq 0}
					<div class="row" style="margin:10px;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;background-color:white;">
						<div class="col-xs-5" style="color:#404340;">积分价格</div>
						<div class="col-xs-7" style="color:#EF4E3A;font-size:14px;">
							{if $courseinfo.price3 neq 0}{$courseinfo.price3}元{/if}
							{if $courseinfo.price3 neq 0 && $courseinfo.score3 neq 0}+{/if}
							{if $courseinfo.score3 neq 0}{$courseinfo.score3} 积分{/if}
						</div>
					</div>					
					{/if}

					{if $courseinfo.score3 neq 0}
					{*<div class="row" style="margin:10px;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;background-color:white;">
						<div class="col-xs-5" style="color:#404340;">积分抵扣积分</div>
						<div class="col-xs-7">{$courseinfo.score3}</div>
					</div>*}
					{/if}
					<div class="row" style="margin:10px;background-color:white;">
						<button type="button" class="btn btn-primary btn-block" id="lessonSignup2">报名</button>
					</div>
				</div>
			</div>
		</div>
	</body>
	{include file="file:u.footer.tpl"}
	<script type="text/javascript">
		var courseinfoId = {$courseinfo.id};
		var inviter = '{$inviter}';
		var noteid = '{$noteid}';
		
		var WXSettings = {};
		WXSettings.defaulttitle="吉的堡lesson";
		WXSettings.defaultdesc="吉的堡lesson";
		WXSettings.link='http://www.wsestar.com/test/Kidcastle-Mall/u.lesson.php?courseid='+courseinfoId+'&inviter='+inviter+'&noteid='+noteid;
		WXSettings.defaultimgUrl='http://www.wsestar.com/test/Kidcastle-Mall/image/a.jpg';
		WXSettings.defaulttimeline="吉的堡会员积分商城";
	
		window.onload = OnLoad;
		

		function OnLoad(){
			BindEvents();
			BuildShareData();
		}
		function BindEvents(){
			console.log({json_encode($courseinfo)});
			console.log({json_encode($courseinfo)}.title);
			
			$("#lessonsBackBtn").click(function(){
				window.location.href = "u.lessonlist.php";
			})
			$("#lessonSignup1,#lessonSignup2").mousedown(function(){
				if({$courseinfo.count} <= 0){
					return;
				}
				
				var lessonOrderspan = "";
				$(function(){ 
					$(".lessonOrderspan").each(function(){ 
						if($(this).prop("checked")==true){
							lessonOrderspan = $(this).val();
						} 
					}); 
				});
				if(lessonOrderspan == ""){
					CommonJustTip('您还未选择上课时段！');
					$('body').scrollTop( $('body')[0].scrollHeight );
					return;
				}
				
				var lessonTimespan = "";
				{*$(function(){ 
					$(".lessonTimespan").each(function(){ 
						if($(this).prop("checked")==true){
							lessonTimespan = $(this).val();
						} 
					}); 
				});				
				
				if(lessonTimespan == ""){
					CommonJustTip('您还未选择上课时间！');
					$('body').scrollTop( $('body')[0].scrollHeight );
					return;
				}*}
				
				var myscore = {$courseinfo.statusinfo.score};
				var price = {$courseinfo.price1};
				var score = {$courseinfo.score1};
				if(myscore >= {$courseinfo.score3} && ({$courseinfo.price3} > 0 || {$courseinfo.score3} > 0)){
					price = {$courseinfo.price3};
					score = {$courseinfo.score3};
				}else if({$courseinfo.statusinfo.isstudent} == 1){
					price = {$courseinfo.price2};
					score = {$courseinfo.score2};
				}
				
				url = "btnajax.php?mode=SignUpCourse";
				$.post(url,{
					courseid : {$courseinfo.id},
					price : price,
					score : score,
					noteid: noteid,
					orderspanid : lessonOrderspan
				},function(json,status){
					window.location.href = "u.pay.php?courseinfoid="+json+"&noteid="+noteid;
				});
				
			})
		}
		
		function BuildShareData(){
			if(!WXSettings)
				return;
		
			shareDataMessage = {
				title: WXSettings.defaulttitle,
				desc: WXSettings.defaultdesc,
				link: WXSettings.link,
				imgUrl: WXSettings.defaultimgUrl
			};
			shareDataTimeline = {
				title: WXSettings.defaulttimeline,
				desc: WXSettings.defaulttimeline,
				link: WXSettings.link,
				imgUrl: WXSettings.defaultimgUrl
			};
			wx.onMenuShareAppMessage({
				title: WXSettings.defaulttitle,
				desc: WXSettings.defaultdesc,
				link: WXSettings.link,
				imgUrl: WXSettings.defaultimgUrl,
				success: function () {
					$.post("btnajax.php?mode=ShareSuccess&courseid=" + courseinfoId);
				}
			});
			wx.onMenuShareTimeline({
				title: WXSettings.defaulttimeline,
				desc: WXSettings.defaulttimeline,
				link: WXSettings.link,
				imgUrl: WXSettings.defaultimgUrl,
				success: function () {
					$.post("btnajax.php?mode=ShareSuccess&courseid=" + courseinfoId);
				}
			});
			wx.onMenuShareQQ({
				title: WXSettings.defaulttitle,
				desc: WXSettings.defaultdesc,
				link: WXSettings.link,
				imgUrl: WXSettings.defaultimgUrl,
				success: function () {
					$.post("btnajax.php?mode=ShareSuccess&courseid=" + courseinfoId);
				}
			});
		}
		wx.ready(function () {
			BuildShareData();
		});
   </script> 
</html>