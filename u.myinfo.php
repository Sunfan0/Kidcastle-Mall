<?php
	include "u.header.php";
?>
<!--
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<title>至美教育会员商城</title>
		<link href="style/bootstrap.css" rel="stylesheet"/>	
		<link href="style/style.css" rel="stylesheet"/>	
		<link href="js/craftpip/css/jquery-confirm.css" rel="stylesheet"/>		
	</head>
	<body>-->
		<div class="pageTitle">
			<div class="row">
				<div class="col-xs-4">
					<span id="myInfoBackBtn" class="glyphicon glyphicon-chevron-left" style="pading-right:5px;">返回</span>
				</div>
				<div class="col-xs-8">
					<span id="myInfoTitle">编辑资料</span>
				</div>
			</div>
		</div>
		
		<div class="container">
			<div class="row" style="background-color:white;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;">
			  <div class="col-xs-4" style="color:#767876;">
				姓名
			  </div>
			  <div class="col-xs-8">
				<input type="text" style="border:none;outline: none;" id="myInfoUser">
			  </div>
			</div>
			<div class="row" style="background-color:white;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;">
			  <div class="col-xs-4" style="color:#767876;">
				电话
			  </div>
			  <div class="col-xs-8">
				<input type="number" style="border:none;outline: none;" id="myInfoMobile">
			  </div>
			</div>
			<div class="row hidden" style="background-color:white;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;">
			  <div class="col-xs-4" style="color:#767876;">
				区域
			  </div>
			  <div class="col-xs-8">
				<select id="myInfoArea" style="border:none;outline: none;" id="myInfoArea"></select>
			  </div>
			</div>
			<div class="row" style="background-color:white;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;">
			  <div class="col-xs-4" style="color:#767876;">
				学校
			  </div>
			  <div class="col-xs-8">
				<select id="myInfoSchool" style="border:none;outline: none;" id="myInfoSchool"></select>
			  </div>
			</div>
			<button id="myInfoSubmitBtn" type="button" class="btn btn-primary btn-block" style="margin-top:50px;">保存</button>
		</div>
	</body>
	<?php	include "u.footer.php";	?>
	<script type="text/javascript">
		var Settings = {};
	
		window.onload = OnLoad;
		
		function OnLoad(){
			BindEvents();
			ShowAreaList();
			ShowSchoolList();
			ShowMyInfo();
		}
		function BindEvents(){		
			$("#myInfoBackBtn").click(function(){
				window.location.href = "u.my.php";
			})
			
			// $("#myInfoSubmitBtn").click(function(){
			$("#myInfoSubmitBtn").mousedown(function(){
				SaveMyInfo();
			})
		}
		function ShowSchoolList(){
			url = "u.myinfo.ajax.php?mode=ShowSchool";
			$.get(url,function(json,status){
				json = eval("("+json+")");
				console.log(json);
				for(var i=0;i<json.length;i++){		
					strTbody = '<option value="'+json[i].id+'">'+json[i].name+'</option>';
					$("#myInfoSchool").append(strTbody);
				}
			});
		}
		function ShowAreaList(){
			url = "u.myinfo.ajax.php?mode=ShowArea";
			$.get(url,function(json,status){
				json = eval("("+json+")");
				console.log(json);
				for(var i=0;i<json.length;i++){			
					strTbody = '<option value="'+json[i].id+'">'+json[i].name+'</option>';
					$("#myInfoArea").append(strTbody);
				}
			});
		}
		function ShowMyInfo(){
			url = "u.myinfo.ajax.php?mode=ShowInfo";
			$.get(url,function(json,status){
				json = eval("("+json+")");
				// console.log(json);
				// alert(json);
				$("#myInfoUser").val(json.name);
				$("#myInfoMobile").val(json.mobile);
				$("#myInfoArea").val(json.area);
				$("#myInfoSchool").val(json.school);
			});
		}
		function SaveMyInfo(){
			name = $("#myInfoUser").val();
			mobile = $("#myInfoMobile").val();
			// area = $("#myInfoArea").val();
			// school = $("#myInfoSchool").val();
			area = $('#myInfoArea option:selected').val();
			school = $('#myInfoSchool option:selected').val();
			
			if(name == ""){
				CommonJustTip('姓名不能为空！');
				return;
			}
			if(mobile == ""){
				CommonJustTip('手机号不能为空！');
				return;
			}
			if(!(/^1[3|4|5|7|8]\d{9}$/.test(mobile))){
				CommonJustTip('手机号码格式有误。');
				return;
			}
			url = "u.myinfo.ajax.php?mode=UpdateInfo&name=" + name + "&mobile=" + mobile +"&area=" + area +"&school=" + school;
			$.post(url,function(json,status){
				// console.log(json);
				switch(json){
					case "1":
						CommonJustTip('信息修改成功!');
						break;
					default:
						CommonJustTip('服务器忙，请稍候再试。');
						break;
				}
			});
		}
   </script> 
</html>