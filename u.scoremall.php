<?php
	include "paras.php";
	$_SESSION["pageurl"]="u.scoremall.php";
	if(!isset($_SESSION["openid"])){
		Page("u.login.php");
	}
	
	$strSql = "select * FROM `commodity` ";
	$strSql .= " WHERE status=1 ";//已经发布的课程
	$scoremall = DBGetDataRowsSimple($strSql);
	
	$smarty->assign("scoremall",$scoremall);
	
	
	
	$smarty->setCaching(Smarty::CACHING_LIFETIME_CURRENT);//启动缓存
	$smarty->display('u.scoremall.tpl');
?>