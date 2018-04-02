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
					<span id="lessonsListBackBtn" class="glyphicon glyphicon-chevron-left" style="pading-right:5px;">返回</span>
				</div>
				<div class="col-xs-8">
					<span id="lessonsListTitle">在线选课</span>
				</div>
			</div>
		</div>
		<div style="overflow-x: hidden !important;" id="LessonContainer">
			{*{foreach $lessonlist as $l}
				<div id="lessonsList{counter}" onclick="ShowLessonOne({$l.id})" style="position:relative;float:left;width:50%;margin-top:5px;border:1px solid #e5e7e5;background-color:white;">
					<img src="{$l.titleimage}" style="width:100%;height:180px;margin-bottom: 10px;">
					<div style="background-color:#eee;opacity:0.8;color:#EF4E3A;font-size:14px;position:absolute;right:5px;top:155px;padding: 1px;">
					{if $l.price1 neq 0}
						{$l.price1} 元
					{/if}
					{if $l.price1 neq 0 && $l.score1 neq 0}
						+
					{/if}
					{if $l.score1 neq 0}
						{$l.score1} 积分
					{/if}
					</div>
					<div style="padding: 0px 10px;">
						<p style="font-size:16px;color:black;">{$l.title}</p>
						<p style="color:#767876;font-size:14px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;width:100%;">
						{$l.shortdesc}
						</p>
					</div>
				</div>
			{foreachelse}
					<p>暂无数据</p>
			{/foreach}*}
			{foreach $lessonlist as $l}
				<div id="lessonsList{counter}" onclick="ShowLessonOne({$l.id})" style="margin-top:5px;border:1px solid #e5e7e5;background-color:white;">
					<div class="row" style="background-color:white;">
						<div class="col-xs-6">
							<p style="font-size:16px;">{$l.title}</p>
						</div>
						<div class="col-xs-6 colRight">
							<p style="color:#EF4E3A;font-size:14px;">
								{if $l.price1 neq 0}
									{$l.price1} 元
								{/if}
								{if $l.price1 neq 0 && $l.score1 neq 0}
									+
								{/if}
								{if $l.score1 neq 0}
									{$l.score1} 积分
								{/if}
							</p>
						</div>
					</div>
					<div class="row" style="padding: 0px 10px;font-size:14px;background-color:white;">
						<div class="col-xs-8">
							<p style="color:#767876;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;width:100%;">
							{$l.shortdesc}
							</p>
						</div>
						<div class="col-xs-4 colRight">
							<p style="color:#607d8b;font-size:14px;">招生对象</p>
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
			console.log({json_encode($lessonlist)});
			console.log({$lessonlist|@count});	
			
			{*
			for(i=0;i<{$lessonlist|@count};i++){
				var position = "left";
				if(i%2 == 1){
					position = "right";
				}
				strlesson = '<div id="lessonsList'+i+'" onclick="ShowLessonOne('+{json_encode($lessonlist)}[i].id+')"  style="float:'+position+';width:49.5%;margin-top:5px;border:1px solid #e5e7e5;background-color:white;">';
				strlesson+= '<img src="" style="width:100%;height:150px;margin-bottom: 10px;">';
				strlesson+= '<div style="padding: 0px 10px;"><p style="font-size:16px;color:black;">'+{json_encode($lessonlist)}[i].title+'</p>';
				strlesson+= '<p style="color:#767876;font-size:14px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;width:100%;">';
				strlesson+= ''+{json_encode($lessonlist)}[i].shortdesc+'</p></div></div>';
				$("#LessonContainer").append(strlesson);
			}*}

			$("#lessonsListBackBtn").click(function(){
				window.location.href = "u.my.php";
			})
		}
		function ShowLessonOne(id){
			window.location.href = "u.lesson.php?courseid="+id;
		}
   </script> 
</html>