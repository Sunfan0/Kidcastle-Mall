<?php
	include "paras.php";
	$mode = Get("mode");
	switch($mode){
		case "UpdateInfo":
			$name = Get("name");
			$mobile = Get("mobile");
			$area = Get("area");
			$school = Get("school");
			$arrFields = array("name","mobile","area","school");
			$arrValues = array($name,$mobile,$area,$school);
			$id = DBUpdateField("custinfo" , $_SESSION["userid"] ,$arrFields, $arrValues);
			if($id){
				echo 1;
			}else{
				echo -1;
			}
			break;
//显示个人信息
		case "ShowInfo":
			$Info = DBGetDataRowByField("custinfo" , "id" ,$_SESSION["userid"]);
			echo json_encode($Info);
			break;
		case "ShowArea":
			$strSql = "	Select * from area ";
			$data = DBGetDataRowsSimple($strSql);
			echo json_encode($data);
			break;
		case "ShowSchool":
			$strSql = "	Select * from school ";
			$data = DBGetDataRowsSimple($strSql);
			echo json_encode($data);
			break;
			
	}
?>