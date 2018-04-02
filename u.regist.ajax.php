<?php
	include "paras.php";
	$mode = Get("mode");
	switch($mode){
		case "RegistInfo":
			$name = Get("name");
			$mobile = Get("mobile");
			
			$isread = Get("isread");//是否就读
			$school = Get("school");//校区
			$grade = Get("grade");//就读班级
			$age = Get("age");//年龄
	
			$strSql = "Select * from sharescorestandard ";
			$datainfo = DBGetDataRow($strSql);
			$arrFields = array("name","mobile","isread","school","grade","age","score");
			$arrValues = array($name,$mobile,$isread,$school,$grade,$age,$datainfo["registscore"]);
			$mobileInfo = DBGetDataRowByField("custinfo" , "mobile" , $mobile);
			if($mobileInfo!=null){//该手机号已经注册会员了
				die("-9");
			}
			$id = DBUpdateField("custinfo" , $_SESSION["userid"] ,$arrFields, $arrValues);
			if($id){
				echo 1;
			}else{
				echo -1;
			}
			break;
//
		case "ShowArea":
			$strSql = "Select * from area ";
			$data = DBGetDataRowsSimple($strSql);
			echo json_encode($data);
			break;
		case "ShowSchool":
			$strSql = "Select * from school ";
			$data = DBGetDataRowsSimple($strSql);
			echo json_encode($data);
			break;
	}
?>