<?php
	include "paras.php";
	if(!isset($_SESSION["openid"])){
		Page("u.login.php");
	} 
	
	// $_SESSION["pageurl"]='';//当前页面链接地址 
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<title>至美教育会员商城</title>
		<link href="style/bootstrap.css" rel="stylesheet"/>	
		<link rel="stylesheet" type="text/css" href="js/kkpager-master/src/kkpager_blue.css" />
		<link href="style/style.css" rel="stylesheet"/>	
		<link href="js/craftpip/css/jquery-confirm.css" rel="stylesheet"/>
	</head>
	<body>
	<!--
		<div class="row" style="height:40px;background-color:#337ab7;color:white;">
			<div class="col-xs-4">
				<span class="glyphicon glyphicon-chevron-left" style="pading-right:5px;">返回</span>
			</div>
			<div class="col-xs-8">
				<span id="hearderTitle">编辑资料</span>
			</div>
		<div>-->

