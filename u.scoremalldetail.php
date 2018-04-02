<?php
	include "paras.php";
	$commodityid = Get("commodityid");//商品id
	$_SESSION["pageurl"]="u.scoremalldetail.php?commodityid=".$commodityid;
	if(!isset($_SESSION["openid"])){
		Page("u.login.php");
	}
	$strSql = "select * FROM `commodity` WHERE id=$commodityid ";
	$commodityinfo = DBGetDataRow($strSql);

	$smarty->assign("commodityinfo",$commodityinfo);
	
	
	
	$smarty->setCaching(Smarty::CACHING_LIFETIME_CURRENT);
	$smarty->display('u.scoremalldetail.tpl',$commodityid);

	

?>