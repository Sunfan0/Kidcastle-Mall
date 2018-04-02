<?php
	include "paras.php";
	$mode = Get("mode");
	$perpage = 30;
	if(!CheckRights("bgscoredetail")){
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
			$strSql .= "where (c.nickname like '%" . $toLike . "%') or (c.name like '%" . $toLike . "%')";
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
			$currentpage = Get("currentpage");
			$currentpage=$currentpage-1;
			$p=$currentpage*$perpage;
			$strSql = "Select c1.nickname as custnickname,c1.name as custname,c1.imgurl as custimg,c1.mobile as custmobile,c.beforescore,c.changescore,c.afterscore,c.reason,c.operattime,c.changeuser,s.nickname,s.name,s.mobile from custscorehistory c  ";
			$strSql .= " left join saler s on c.operator =s.id  ";
			$strSql .= " left join custinfo c1 on c.signupid =c1.id  ";//因好友分享报名
			$strSql .= " where c.custid=$custid ";
			$strSql .= " limit $p,$perpage";
			$detail = DBGetDataRowsSimple($strSql);
			$strSql= "select  count(*) as total from custscorehistory WHERE custid=$custid ";//
			$result = DBGetDataRow($strSql);
			$detailInfo['data']=$detail;
			$detailInfo['total']=$result['total'];
			$detailInfo["pagecount"]=ceil($detailInfo["total"]/$perpage);
			$detailInfo["perpage"]=$perpage;
			echo json_encode($detailInfo);
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