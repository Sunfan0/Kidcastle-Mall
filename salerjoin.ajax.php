<?php
	include "paras.php";
	$mode = Get("mode");
	switch($mode){
		case "applysaler"://销售人员申请
			$openid = Get("openid");
			$name = Get("name");
			$mobile = Get("mobile"); 
			$area = Get("area");
			$school = Get("school");
			$arrFields = array("status","name","mobile","area","school");
			$arrValues = array(0,$name,$mobile,$area,$school);
			$salerInfo = DBGetDataRowByField("saler","openid",$openid);
			if($salerInfo==null){
				die("-8");
			}
			if($salerInfo["mobile"] != "" && $salerInfo["name"] != ""&& $salerInfo["status"] != -1)
				die("-9");
			$r = DBUpdateField("saler" , $salerInfo["id"] , $arrFields ,$arrValues);
			if(!$r){
				echo -1;
			}else{
				echo 1;
			}
			break;
		case "getarea":
			$strSql = "Select * from area ";
			$data = DBGetDataRowsSimple($strSql);
			echo json_encode($data);
			break;
		case "getschool":
			$strSql = "Select * from school ";
			$data = DBGetDataRowsSimple($strSql);
			echo json_encode($data);
			break;
	}

?>