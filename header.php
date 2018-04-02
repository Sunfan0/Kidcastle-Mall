<?php
	include "paras.php";
	
	if(CheckRights() < 0)
		Page("login.php");
	
	$mode = Get("mode");
	switch($mode){
		case "ChangePassword":
			$oldPassword = Get("oldPassword");
			$newPassword = Get("newPassword");
			$loginName = $_SESSION["uname"];
			$userInfo = DBGetDataRowByField("bgmanager","loginname",$loginName);
			if($userInfo == null)
				die("-8");
			if($userInfo["password"] != $oldPassword)
				die("-9");
			
			if(DBUpdateField("bgmanager" , $userInfo["id"] , "password" , $newPassword))
				die("1");
			else
				die("-1");
			break;
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<title>至美教育会员商城系统</title>
		
		<link href="style/bootstrap.css" rel="stylesheet"/>
		<link href="js/craftpip/css/jquery-confirm.css" rel="stylesheet"/>
		<link rel="stylesheet" type="text/css" href="js/kkpager-master/src/kkpager_blue.css" />
		<link rel="stylesheet" type="text/css" href="style/bootstrap-select.css" />
		<link rel="stylesheet" href="js/DataTables-1.10.11/media/css/jquery.dataTables.min.css" type="text/css">
		<link rel="stylesheet" type="text/css" href="uploadify/uploadify.css">
		<style>
			body{
				font-size:150% !important;
				font-family: "Microsoft YaHei" ! important;
				background-color:#e5e7e5 !important;
			}
			.container{
				font-size: 16px !important;
			}
			.nav-tabs>li>a{
				background-color:#337ab7 !important;
				border-bottom-color:transparent !important;
				color:#c8c8c8 !important;
				white-space: nowrap;
			}

			.nav-tabs>.active>a{
				color:#777 !important;
				background-color:#e5e7e5 !important;
			}
			.nav-tabs>li>a:hover{
				background-color:#286090 !important;
				border-color:#286090 !important;
				color:#c8c8c8 !important;
			}
			.table-hover > tbody > tr:hover {
				background-color: #b9bbbc !important;
			}
			<!--
			.edui-default .edui-popup {
				z-index: 9999 !important;
			}-->
			.modal {
				z-index: 1000 !important;
			}
			.modal-backdrop {
				z-index: 800 !important;
			}
			.PreviewRow .row{
				padding:10px;
				font-size:14px !important;
			}
		</style>
	</head>
	<body>
		<nav class="navbar navbar-default" role="navigation" style="background-color:#337ab7;border:none;margin-bottom:0px;">
			<div class="container">
				<div class="navbar-header" style="padding:20px;">
					<a class="navbar-brand" href="javascript:void(0);" style="font-size:150%;font-weight:bold;color:#e5e7e5;">至美教育会员商城系统</a>
				</div>
			</div>
			<div class="container" id="bs-example-navbar-collapse-1" style="margin:0px auto;text-align:center">
				<ul class="nav nav-tabs nav-justified">
					<li class="navBtn" id="manager"><a href="javascript:void(0);">后台账号</a></li>
					<li class="navBtn" id="saler"><a href="javascript:void(0);">审核人员</a></li>
					<li class="navBtn" id="RegistMember"><a href="javascript:void(0);">注册会员</a></li>
					<li class="navBtn" id="course"><a href="javascript:void(0);">课程管理</a></li>
					<li class="navBtn" id="student"><a href="javascript:void(0);">课程报名学员表</a></li>
					<li class="navBtn" id="commodity"><a href="javascript:void(0);">商品管理</a></li>
					<li class="navBtn" id="exchange"><a href="javascript:void(0);">商品兑换一览表</a></li>
					<li class="navBtn" id="spokesman"><a href="javascript:void(0);">代言人</a></li>
					<li class="navBtn" id="scoreobtain"><a href="javascript:void(0);">积分一览</a></li>
					<li class="navBtn" id="scorechange"><a href="javascript:void(0);">积分管理</a></li>
					<li class="navBtn" id="ShareRuleSet"><a href="javascript:void(0);">积分规则</a></li>
					<li class="navBtn" id="changepassword"><a href="javascript:void(0);">修改密码</a></li>
				</ul>
			</div>
		</nav>
