<?php
	include "u.header.php";
?>
<!--
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<title>吉的堡</title>
		<link href="style/bootstrap.css" rel="stylesheet"/>	
		<link href="style/style.css" rel="stylesheet"/>	
		<link href="js/craftpip/css/jquery-confirm.css" rel="stylesheet"/>		
	</head>
	<body>-->
		<div class="pageTitle">
			<div class="row">
				<div class="col-xs-4">
					<span id="myLessonsBackBtn" class="glyphicon glyphicon-chevron-left" style="pading-right:5px;">返回</span>
				</div>
				<div class="col-xs-8">
					<span id="myLessonsTitle">我的课程</span>
				</div>
			</div>
		</div>
		<div class="container" id="myLessonsContent">
			<!--<div id="myLessonsList1" style="margin-top:10px;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;background-color:white;">
				<div class="row" style="background-color:white;">
					<div class="col-xs-6">
						<p style="font-size:16px;">课程名称</p>
					</div>
					<div class="col-xs-6 colRight">
						<p style="color:#607d8b;font-size:14px;">购买时间</p>
					</div>
				</div>
				<div class="row" style="padding: 0px 20px;color:#767876;font-size:14px;background-color:white;">
					<p style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis;width:100%;">
					课程简单介绍xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
					</p>
				</div>
			</div>-->
		</div>
	</body>
	<?php	include "u.footer.php";	?>
	<script type="text/javascript">
		var Settings = {};
	
		window.onload = OnLoad;
		
		function OnLoad(){
			BindEvents();
		}
		function BindEvents(){
			url = "u.mylessons.ajax.php?mode=MyCourseList";
			$.get(url,function(json,status){
				// alert(json);
				if(json == -7){
					CommonJustTip('您还未购买过任何课程！');
					return;
				}
				json = eval("("+json+")");
				console.log(json);
				for(var i=0;i<json.length;i++){	
					strmyLessons = "<div id='myLessonsList"+i+"' onclick='ShowMyLesson("+json[i].id+")' style='margin-top:10px;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;background-color:white;'>";
					strmyLessons+= "<div class='row' style='padding: 10px 5px;background-color:white;'><div class='col-xs-6'><p style='font-size:16px;'>"+json[i].title+"</p></div>";
					strmyLessons+= "<div class='col-xs-6 colRight'><p style='color:#607d8b;font-size:14px;'>"+json[i].ordertime+"</p></div></div>";
					strmyLessons+= "<div class='row' style='padding: 0px 20px;color:#767876;font-size:14px;background-color:white;'>";
					strmyLessons+= "<p style='white-space:nowrap;overflow:hidden;text-overflow:ellipsis;width:100%;'>"+json[i].shortdesc+"</p></div>";
					$("#myLessonsContent").append(strmyLessons);
				}
			});
			
			$("#myLessonsBackBtn").click(function(){
				window.location.href = "u.my.php";
			})
		}
		function ShowMyLesson(id){
			// window.location.href = "u.mylesson.php";
			window.location.href = "u.mylesson.php?courseid="+id;
		}
   </script> 
</html>