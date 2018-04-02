<?php
	include "paras.php";
	$mode = Get("mode");
	if(!CheckRights("viewcommoditygot")){
		echo 123;
		die();
	}
	switch($mode){
		case "EditGoodsGotList":
			$strSql = "Select s.name as salername,s.mobile as salermobile,s.school as salerschool,s.area as salerarea, c.imgurl,c.nickname,c.name,c.mobile,c.isstudent,c.score as custscore, ";
			$strSql.= " e.name as goodsname,e.imgurl as goodsimg,b.price,b.score,b.ordertime,b.scantime,e.type ,e.id from custcommodityorders b  ";
			$strSql.= " left join custinfo c on b.custid=c.id  ";
			$strSql.= " left join saler s on b.scanerid=s.id  ";
			$strSql.= " left join commodity e on b.commodityid=e.id  ";
			$strSql.= " where (b.status=3 or b.status=4 or b.status=5 or b.status=2) ";//已兑换或者已领取
			
			$search = Get("search");
			$toLike = $search["value"];
			$strSql .= "and (c.name like '%" . $toLike . "%') or (e.name like '%" . $toLike . "%') or (c.nickname like '%" . $toLike . "%') ";
			$sqlPara = GetPageParas();
			$strSqlDetail = $strSql . $sqlPara["where"] . $sqlPara["limit"];
			$dataDetail = DBGetDataRows($strSqlDetail);
//按照页面传过来的参数进行过滤之后显示的内容
			$strSqlCountAll = "Select count(*) FROM custcommodityorders where status=3 or status=4 or status=5 or status=2   ";
//需要显示的数据的总数量
			$dataCountAll = DBGetDataRow($strSqlCountAll);

			$result["data"] = $dataDetail;
			$result["draw"] = Get("draw");
			$result["recordsFiltered"] = $dataCountAll[0];
			$result["recordsTotal"] = $dataCountAll[0];
			echo json_encode($result);
			break;
		case "EditGoodsNoUsedList":
			$strSql = "Select s.name as salername,s.mobile as salermobile,s.school as salerschool,s.area as salerarea, c.imgurl,c.nickname,c.name,c.mobile,c.isstudent,c.score as custscore, ";
			$strSql.= " e.name as goodsname,e.imgurl as goodsimg,b.price,b.score,b.ordertime,b.scantime,e.type,e.id from custcommodityorders b  ";
			$strSql.= " left join custinfo c on b.custid=c.id  ";
			$strSql.= " left join saler s on b.scanerid=s.id  ";
			$strSql.= " left join commodity e on b.commodityid=e.id  ";
			$strSql.= " where b.status=4 ";//未领取
//商品状态需不需要修改			
			$search = Get("search");
			$toLike = $search["value"];
			$strSql .= "and (c.name like '%" . $toLike . "%') or (e.name like '%" . $toLike . "%') or (c.nickname like '%" . $toLike . "%')";
			$sqlPara = GetPageParas();
			$strSqlDetail = $strSql . $sqlPara["where"] . $sqlPara["limit"];
			$dataDetail = DBGetDataRows($strSqlDetail);
//按照页面传过来的参数进行过滤之后显示的内容
			$strSqlCountAll = "Select count(*) FROM custcommodityorders where status=4  ";
//需要显示的数据的总数量
			$dataCountAll = DBGetDataRow($strSqlCountAll);

			$result["data"] = $dataDetail;
			$result["draw"] = Get("draw");
			$result["recordsFiltered"] = $dataCountAll[0];
			$result["recordsTotal"] = $dataCountAll[0];
			echo json_encode($result);
			break;	
		case "EditGoodsUsedList":
			$strSql = "Select s.name as salername,s.mobile as salermobile,s.school as salerschool,s.area as salerarea, c.imgurl,c.nickname,c.name,c.mobile,c.isstudent,c.score as custscore, ";
			$strSql.= " e.name as goodsname,e.imgurl as goodsimg,b.price,b.score,b.ordertime,b.scantime,e.type,e.id from custcommodityorders b  ";
			$strSql.= " left join custinfo c on b.custid=c.id  ";
			$strSql.= " left join saler s on b.scanerid=s.id  ";
			$strSql.= " left join commodity e on b.commodityid=e.id  ";
			$strSql.= " where b.status=5 ";//已经领取
			
			$search = Get("search");
			$toLike = $search["value"];
			$strSql .= "and (c.name like '%" . $toLike . "%') or (e.name like '%" . $toLike . "%') or (c.nickname like '%" . $toLike . "%') ";
			$sqlPara = GetPageParas();
			$strSqlDetail = $strSql . $sqlPara["where"] . $sqlPara["limit"];
			$dataDetail = DBGetDataRows($strSqlDetail);
//按照页面传过来的参数进行过滤之后显示的内容
			$strSqlCountAll = "Select count(*) FROM custcommodityorders where status=5  ";
//需要显示的数据的总数量
			$dataCountAll = DBGetDataRow($strSqlCountAll);

			$result["data"] = $dataDetail;
			$result["draw"] = Get("draw");
			$result["recordsFiltered"] = $dataCountAll[0];
			$result["recordsTotal"] = $dataCountAll[0];
			echo json_encode($result);
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
				$strWhere = "  order by $columnName $orderDir ";
			}
		}
		$strLimit = " limit $start , $length ";
		
		return array("where" => $strWhere , "limit" => $strLimit);
	}
?>