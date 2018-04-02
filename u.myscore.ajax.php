<?php
	include "paras.php";
	$mode = Get("mode");
	switch($mode){
//显示当前用户积分
		case "MyScore":
			$scoreInfo = DBGetDataRowByField("custinfo","id",$_SESSION["userid"]);
			echo $scoreInfo["score"];
			break;
	}
?>