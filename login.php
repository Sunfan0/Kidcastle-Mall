<?php
	
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<title>吉的堡后台管理</title>
		<link href="style/bootstrap.css" rel="stylesheet"/>
	</head>
	<body>
		
		<div class="container" style="margin-top:50px;">
			<h2 class="text-center" style="margin-bottom:50px;">吉的堡后台管理</h2>
			<div id="LoginForm" class="text-center">
			  <div class="form-group form-group-lg">
				<label for="staffMobile" class="col-sm-2 control-label" style="font-size: 20px;line-height:46px;">账号 :</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" id="staffMobile">
				</div>
			  </div>
			  </br></br></br>
			  <div class="form-group form-group-lg">
				<label for="staffPassword" class="col-sm-2 control-label" style="font-size: 20px;line-height:46px;">密码 :</label>
				<div class="col-sm-10">
				  <input type="password" class="form-control" id="staffPassword">
				</div>
			  </div>
			  </br></br></br>
			  <div class="form-group form-group-lg">
				<div class="col-sm-12">
				  <button id="LoginBtn" class="btn btn-default btn-lg">登录</button>
				</div>
			  </div>
			</div>
		</div>
	</body>
	<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script src="js/md5.min.js" charset="utf-8"></script>
	<script type="text/javascript">
		var Settings = {};
	
		window.onload = OnLoad;
		
		function OnLoad(){
			BindEvents();
		}
		function BindEvents(){
			$("#LoginBtn").click(function(){
				loginname = $("#staffMobile").val();
				loginpassword = md5($("#staffPassword").val());
				url = "login.ajax.php?mode=Login&loginname=" + loginname + "&loginpassword=" + loginpassword;
				$.get(url,function(json,status){
					switch(json){
						case "1":
							window.location.href = "manager.php";
							break;
						default:
							alert("登陆失败。");
							break;
					}
				});
				// window.location.href = "manager.php";
			});
		}
   </script> 
</html>