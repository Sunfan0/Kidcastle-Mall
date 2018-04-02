<?php
	include "paras.php";
	$courseid = Get("courseid");
	$_SESSION["pageurl"]="u.mylesson.php?courseid=".$courseid;
	if(!isset($_SESSION["openid"])){
		Page("u.login.php");
	} 

	$strSql = "select c.id,c.price,c.score,c.ordertime,c.status,g.title,g.shortdesc,g.description1,g.description2,g.description3, ";
	$strSql .= " d.span,p.timefrom,p.timeto ";
	$strSql .= " FROM `custlessonorders` c ";
	$strSql .= " left join lessoninfos g on c.lessonid=g.id ";
	$strSql .= " left join lessonorderspan d on c.orderspanid=d.id ";
	$strSql .= " left join lessontimespan p on c.timespanid=p.id ";
	$strSql .= " where c.custid=".$_SESSION["userid"]." and c.lessonid=$courseid ";
	$courseinfo = DBGetDataRow($strSql);


	$smarty->assign("courseinfo",$courseinfo);
	
	$stropenid = substr($_SESSION["openid"], 0, 10);
	$strdate = date("YmdHi", time());
	$BarCodePara = md5($_SESSION["userid"].$stropenid.$strdate);//二维码参数
	$BarCodePara = substr($BarCodePara, 0, 10);

	$smarty->assign("BarCodePara",$BarCodePara,true);
	
	$smarty->setCaching(Smarty::CACHING_LIFETIME_CURRENT);
	$smarty->display('u.mylesson.tpl',$courseid);
	
	
	
?>