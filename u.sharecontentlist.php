<?php
	include "paras.php";
	$_SESSION["pageurl"]="u.sharecontentlist.php";
	if(!isset($_SESSION["openid"])){
		Page("u.login.php");
	}

	$strSql = "select * FROM `sharecontent` ";
	$strSql .= " WHERE status=1 ";//已经发布的代言人分享帖子
	$sharecontentlist = DBGetDataRowsSimple($strSql);
	
	$smarty->assign("sharecontentlist",$sharecontentlist);
	
	
	$smarty->setCaching(Smarty::CACHING_LIFETIME_CURRENT);//启动缓存
	$smarty->display('u.sharecontentlist.tpl');
	
//07nianchuzhongbiye11niangaozhongbiye15niandaxuebiye15nian8yuekaishishnagbangongzuo
?>