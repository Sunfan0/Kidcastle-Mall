<?php
	include "paras.php";
	$_SESSION["pageurl"]="u.lessonlist.php";
	if(!isset($_SESSION["openid"])){
		Page("u.login.php");
	}

	$strSql = "select * FROM `lessoninfos` ";
	$strSql .= " WHERE status=1 ";//已经发布的课程
	$lessonlist = DBGetDataRowsSimple($strSql);
	
	$smarty->assign("lessonlist",$lessonlist);
	
	
	$smarty->setCaching(Smarty::CACHING_LIFETIME_CURRENT);//启动缓存
	$smarty->display('u.lessonlist.tpl');
	
	
	
?>