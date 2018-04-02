<?php
	include "paras.php";

	$mode = Get("mode");
	$checktoken = Get("checktoken");//销售人员身份验证
	$checksalerid = Get("checksalerid");
	
	$salerinfo = DBGetDataRowByField("saler","id",$checksalerid);
	if($salerinfo == null)
		die("1");
	if($salerinfo["status"] != 1)
		die("2");

	$checksaleropenid=$salerinfo["openid"];
	$strcheckopenid = substr($checksaleropenid, 0, 10);
	$salerflag=false;
	for($i=0;$i<11;$i++){//10分钟之内
		$strnow = date("YmdHi", time()-60*$i);
		$tokenpara = md5($checksalerid.$strcheckopenid.$strnow);
		if($checktoken==$tokenpara){
			$salerflag = true;
			break;
		}
	}
//
	if($salerflag!=true){
		die("3");
	} 
//课程选择购买前台已经完成
	switch($mode){	
//显示用户报名信息，以及分享者信息
		case "ShowSignUpInfo":
//显示下单者信息，邀请者信息，课程信息
			$courseinfoid = Get("courseinfoid");//课程购买明细表id//
			$strSql = "	select c.name as custname,c.mobile as custmobile,c.isstudent ,d.id as courseinfoid, d.custid,d.lessonid,d.ordertime,d.inviter,d.price,d.score,d.status, ";
			$strSql .= "c1.name as invitername,c1.mobile as invitermobile,e.title,e.shortdesc,e.description1,e.description2,e.description3,  ";
			$strSql .= "f.span,p.timefrom,p.timeto ";
			$strSql .= " FROM `custlessonorders` d  ";
			$strSql .= " left join custinfo c on d.custid = c.id ";
			$strSql .= " left join custinfo c1 on d.inviter = c1.id ";
			$strSql .= " left join lessoninfos e on d.lessonid = e.id ";
			$strSql .= " left join lessonorderspan f on d.orderspanid = f.id ";
			$strSql .= " left join lessontimespan p on d.timespanid = p.id ";
			$strSql .= " WHERE d.id=$courseinfoid ";
			//echo $strSql;
//custinfo ,custlessonorders,lessoninfos,lessonorderspan,lessontimespan		
			$result = DBGetDataRow($strSql);
			
			echo json_encode($result);
			break;
//线下报名积分记录
		case "SignUpAddEdit":
			$courseinfoid = Get("courseinfoid");//课程购买明细id
			//$inviter = Get("inviter");//邀请者id
			$orderInfo = DBGetDataRowByField("custlessonorders","id",$courseinfoid);
			$courseid = $orderInfo["lessonid"];//课程id
			$custid = $orderInfo["custid"];//用户id
			$custInfo = DBGetDataRowByField("custinfo","id",$custid);
			if($_SESSION["inviter"]!=0){
				$inviterInfo = DBGetDataRowByField("custinfo","id",$_SESSION["inviter"]);
				$arrValues = array($_SESSION["inviter"],1,$inviterInfo["score"],$courseInfo["orderscore"],$inviterInfo["score"]+$courseInfo["orderscore"],'推介好友报名',$salerid,$DB_FUNCTIONS["now"]);
			}
			$courseInfo = DBGetDataRowByField("lessoninfos","id",$courseid);
			
			DBBeginTrans();
//课程状态更新 
			$r = DBUpdateField("custlessonorders" , $courseinfoid , array("status","ordertime") ,array(2,$DB_FUNCTIONS["now"]));
			if(!$r)
				AjaxRollBack("-9");
//邀请者积分变动,
//用户购买课程积分变动
			$arrFields = array("custid","changetype","beforescore","changescore","afterscore","reason","operator","operattime");
			$arrValuescust = array($custid,-1,$custInfo["score"],$orderInfo["score"],$custInfo["score"]-$orderInfo["score"],'购买课程抵扣',$checksalerid,$DB_FUNCTIONS["now"]);
			if($_SESSION["inviter"]!=0){
				$r = DBInsertTableField("custscorehistory" , $arrFields ,$arrValues);//
				if($r<=0)
					AjaxRollBack("-8");	
				$r = DBUpdateField("custinfo" , $_SESSION["inviter"] , array("isstudent","score") ,array(1,$inviterInfo["score"]+$courseInfo["orderscore"]));
				if(!$r)
					AjaxRollBack("-7");
			}
			$r = DBInsertTableField("custscorehistory" , $arrFields ,$arrValuescust);
			if($r<=0)
				AjaxRollBack("8");
			$r = DBUpdateField("custinfo" , $custid , array("isstudent","score") ,array(1,$custInfo["score"]-$orderInfo["score"]));
			if(!$r)
				AjaxRollBack("7");
			DBCommitTrans();
			echo 1;
			break;
	}
?>