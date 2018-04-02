<?php
	include "paras.php";
	// if(!isset($_SESSION["openid"])){
		// Page("u.login.php");
	// } 
	
	$iframeid = Get("iframeid");
	$insertcourseid = Get("insertcourseid");
	$noteid = Get("noteid");
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<title>至美教育会员商城</title>
		<link href="style/bootstrap.css" rel="stylesheet"/>
		<link href="js/craftpip/css/jquery-confirm.css" rel="stylesheet"/>
		<link rel="stylesheet" type="text/css" href="js/kkpager-master/src/kkpager_blue.css" />
		<link rel="stylesheet" type="text/css" href="style/bootstrap-select.css" />
		<link rel="stylesheet" href="js/DataTables-1.10.11/media/css/jquery.dataTables.min.css" type="text/css">
		<link rel="stylesheet" type="text/css" href="uploadify/uploadify.css">
		<style>
			.FooterText{
				display: none !important;
			}
		</style>
	</head>
	<body>
		<div id="InsertContentContainer" name="InsertContentContainer" class="container" style="background-color:white;" style="height:100%;">
			<button type="button" class="btn btn-primary btn-sm hidden courseSignupBtn" id="InsertSignupBtn" style="height:100%;">报名</button>
			<div id="InsertLessonShortdesc" class="hidden" style="height:100%;">
				<!--<div style="background-color:#d9edf7;height:150px;margin:0px -15px;">
					<img id="InsertLessonimage1" src="" style="width:100%;height:100%;">
				</div>-->
				<div class="row" style="margin-top: 10px;">
					<div class="col-xs-8">
						<p style="font-size:16px;" id="InsertLessontitle1"></p>
					</div>
					<div class="col-xs-4 colRight">
						<button type="button" class="btn btn-primary btn-sm courseSignupBtn" id="lessonshortdescBtn">报名</button>
					</div>
				</div>
				<div class="row" style="padding: 0px 25px;color:#767876;font-size:14px;">
					<p style="word-break:break-all;" id="InsertLessonshortdesctext1"></p>
				</div>
			</div>
			<div id="InsertLessonDescription" class="hidden" style="height:100%;">
				<!--<div style="background-color:#d9edf7;height:150px;margin:0px -15px;">
					<img id="InsertLessonimage2" src="" style="width:100%;height:100%;">
				</div>-->
				<div class="row" style="margin: 10px 0px;">
					<div class="col-xs-8">
						<p style="font-size:16px;" id="InsertLessontitle2"></p>
					</div>
					<div class="col-xs-4 colRight">
						<button type="button" class="btn btn-primary btn-sm courseSignupBtn" id="lessonSignup1">报名</button>
					</div>
				</div>
				<!--<div class="row" style="padding: 0px 25px;color:#767876;font-size:14px;">
					<p style="word-break:break-all;" id="InsertLessonshortdesctext2"></p>
				</div>-->
				<div class="row" style="padding:0px;">
					<div id="lessondescriptionText1" class="row" style="margin:10px;padding: 10px 25px;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;background-color:white;">
						
					</div>
					<div id="lessondescriptionText2" class="row" style="margin:10px;padding: 10px 25px;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;background-color:white;">
						
					</div>
					<div id="lessondescriptionText3" class="row" style="margin:10px;padding: 10px 25px;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;background-color:white;">
						
					</div>
					<div class="row" style="margin:10px;background-color:white;">
						<button type="button" class="btn btn-primary btn-block courseSignupBtn" id="lessonSignup2">报名</button>
					</div>
				</div>
			</div>
		</div>
	</body>
	<?php	include "footer.php";	?>
	<script type="text/javascript">
		var Settings = {};
		
		window.onload = OnLoad;
		
		var iframeid = "<?php echo $iframeid; ?>";
		var insertcourseid = "<?php echo $insertcourseid; ?>";
		var noteid = "<?php echo $noteid; ?>";
		
		function OnLoad(){
			BindEvents();
		}
		function BindEvents(){
			$("#"+iframeid).removeClass("hidden");
			url = "spokesman.ajax.php?mode=CourceDetail&counseid="+insertcourseid;
			$.get(url,function(json,status){
				if(json=="null"){
					CommonJustTip('暂无数据。');
					return;
				}
				json = eval("("+json+")");
				// console.log(json);
				// $("#InsertLessonimage1,#InsertLessonimage2").attr("src",json.titleimage);
				$("#InsertLessontitle1,#InsertLessontitle2").html(json.title);
				$("#InsertLessonshortdesctext1").html(json.shortdesc);
				// $("#InsertLessonshortdesctext2").html(json.shortdesc);
				$("#lessondescriptionText1").html(json.description1);
				$("#lessondescriptionText2").html(json.description2);
				$("#lessondescriptionText3").html(json.description3);
				window.parent.IframeOnloadHeight(insertcourseid);
			});
			$(".courseSignupBtn").click(function(){
				// window.location.href = "http://www.wsestar.com/test/Kidcastle-Mall/u.lesson.php?courseid="+insertcourseid;
				window.open("http://www.wsestar.com/test/Kidcastle-Mall/u.lesson.php?courseid="+insertcourseid+"&noteid="+noteid);
			});
		}
   </script> 
</html>