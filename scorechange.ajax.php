<?php
	include "paras.php";
	$mode = Get("mode");
	if(!CheckRights("bgscorechange")){
		echo 123;
		die();
	} 
	switch($mode){
	//代言人积分一览（历史获得积分，已兑换积分，可兑换积分）
 		case "SpokesmanScore":
			$strSql = "Select c.id,c.nickname,c.imgurl,c.name,c.mobile,c.score as afterscore,IFNULL(c1.getscore,0) as getscore,IFNULL(c2.changescore,0) as changescore from custinfo c ";
			$strSql .= " left join (select custid,sum(changescore) as getscore from custscorehistory where changetype=1 group by custid ) c1 on c.id=c1.custid ";
			$strSql .= " left join (select custid,sum(changescore) as changescore from  custscorehistory where changetype=-1 group by custid ) c2 on c.id=c2.custid ";
			$search = Get("search");
			$toLike = $search["value"];
			$strSql .= "where (c.nickname like '%" . $toLike . "%') or(c.name like '%" . $toLike . "%')";
			$sqlPara = GetPageParas();
			$strSqlDetail = $strSql . $sqlPara["where"] . $sqlPara["limit"];
//echo $strSqlDetail;
//die();
			$dataDetail = DBGetDataRows($strSqlDetail);
//按照页面传过来的参数进行过滤之后显示的内容
			$strSqlCountAll = " Select count(*) FROM custinfo ";
//需要显示的数据的总数量
			$dataCountAll = DBGetDataRow($strSqlCountAll);

			$result["data"] = $dataDetail;
			$result["draw"] = Get("draw");
			$result["recordsFiltered"] = $dataCountAll[0];
			$result["recordsTotal"] = $dataCountAll[0];
			echo json_encode($result);
			break;
			
			
	//每个代言人对应的积分详细流水信息
//积分变更理由，变更前，变更，变更后，操作员，操作时间
		case "SpokesmanScoreDetail":
			$custid = Get("custid");
			$strSql = "Select beforescore,changescore,afterscore,reason,changeuser,operattime from custscorehistory  ";
			$strSql .= " where custid=$custid and changeuser!='' ";
			$data = DBGetDataRowsSimple($strSql);
			echo json_encode($data);
			break; 
//根据用户id，显示用户头像，昵称，当前积分，			
		case "ShowUserInfo":
			$custid = Get("custid");
			$custInfo = DBGetDataRowByField("custinfo","id",$custid);
			echo json_encode($custInfo);
			break;
//调整积分数据更新
		case "UpdateUserScore":
			$custid = Get("custid");
			$type = Get("type");
			$scorenum = Get("scorenum");
			$scorereason = Get("scorereason");
			$custInfo = DBGetDataRowByField("custinfo","id",$custid);
	//更新当前用户的积分
			DBBeginTrans();
	//更新履历表
			$arrFields = array("custid","changetype","beforescore","changescore","afterscore","reason","changeuser","operattime");
			if($type==-1){
				$arrValues = array($custid,$type,$custInfo["score"],$scorenum,$custInfo["score"]-$scorenum,$scorereason,$_SESSION["uname"],$DB_FUNCTIONS["now"]);
			}
			if($type==1){
				$arrValues = array($custid,$type,$custInfo["score"],$scorenum,$custInfo["score"]+$scorenum,$scorereason,$_SESSION["uname"],$DB_FUNCTIONS["now"]);
			}
			$r = DBInsertTableField("custscorehistory" , $arrFields ,$arrValues);
			if($r<=0)
				AjaxRollBack("-1");
			if($type==-1){
				$strSql = " Update custinfo Set score = score-$scorenum Where id = $custid ";
			}
			if($type==1){
				$strSql = " Update custinfo Set score = score+$scorenum Where id = $custid ";
			}
			if(!DBExecute($strSql))
				AjaxRollBack("-2");
			DBCommitTrans();
			echo 1;
			break;
	}
	function GetPageParas(){
		$start = Get("start");
		$length = Get("length");
		$search = Get("search[value]");
		$columns = Get("columns");
		$orders = Get("order");
		$strWhere = "";
//myecho(count($orders));
		if(count($orders) > 0){
			if($orders[0]["column"] != ""){
				$columnName = $columns[$orders[0]["column"]]["data"];
				$orderDir = $orders[0]["dir"];
				$strWhere = " order by $columnName $orderDir ";
			}
		}
		$strLimit = " limit $start , $length ";
		
		return array("where" => $strWhere , "limit" => $strLimit);
	} 
?>