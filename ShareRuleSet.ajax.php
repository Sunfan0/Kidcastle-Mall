<?php
	include "paras.php";
	$mode = Get("mode");
	if(!CheckRights("bgscorerule")){
		echo 123;
		die();
	}
	switch($mode){
		case "ShowStandardScore"://通用的积分规则
			$strSql = "Select * from sharescorestandard ";
			$datainfo = DBGetDataRow($strSql);
			echo json_encode($datainfo);
			break;
		case "UpdateStandardScore"://编辑通用的积分规则
			$id = (int)(Get("id"));
			$sharescore = Get("sharescore");
			$sharecount = Get("sharecount");
			$clickscore = Get("clickscore");
			$clickcount = Get("clickcount");
			$signupscore = Get("signupscore");
			$arrFields=array("sharescore","sharecount","clickscore","clickcount","signupscore");
			$arrValues=array($sharescore,$sharecount,$clickscore,$clickcount,$signupscore);
			$r = DBUpdateField("sharescorestandard" , $id ,$arrFields, $arrValues);
			if($r)
				echo 1;
			else
				echo -1;
			break;	
		
	}
?>