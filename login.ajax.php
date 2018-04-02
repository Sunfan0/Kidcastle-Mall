<?php
	include "paras.php";
	$mode = Get("mode");
	$loginName = Get("loginname");
	$loginPassword = Get("loginpassword");
	$userInfo = DBGetDataRowByField("bgmanager","loginname",$loginName);
	$_SESSION["uname"]=$loginName;
	if($loginPassword != $userInfo["password"]){
		die("-1");
	}
	if(CheckRights()<0){
		echo -2;
		die();
	}
	switch($mode){
		case "Login":
			echo 1;
			break;
	}
?>