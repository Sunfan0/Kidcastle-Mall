<?php
	include "paras.php";
	$mode = Get("mode");
	$perpage = 20;
	switch($mode){
//显示积分交易详情
		case "ScoreDetail":
			$currentpage = Get("currentpage");
			$currentpage=$currentpage-1;
			$p=$currentpage*$perpage;
			$strSql = "select id,custid,changetype,beforescore,changescore,afterscore,reason,operator,operattime ";
			$strSql .= " FROM `custscorehistory` ";
			$strSql .= " WHERE custid=".$_SESSION["userid"];
			$strSql .= " order by operattime desc ";
			$strSql .= " limit $p,$perpage";
			$detail = DBGetDataRowsSimple($strSql);
			$strSql= "select  count(*) as total from custscorehistory WHERE custid=".$_SESSION["userid"];//
			$result = DBGetDataRow($strSql);
			$detailInfo['data']=$detail;
			$detailInfo['total']=$result['total'];
			$detailInfo["pagecount"]=ceil($detailInfo["total"]/$perpage);
			$detailInfo["perpage"]=$perpage;
			echo json_encode($detailInfo);
			break;
	}
?>