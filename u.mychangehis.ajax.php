<?php
	include "paras.php";
	$mode = Get("mode");
	$perpage = 20;
	switch($mode){
//查看已经兑换的商品列表
		case "ShowGotCommodity":
			$currentpage = Get("currentpage");
			$currentpage=$currentpage-1;
			$p=$currentpage*$perpage;
			$strSql = "select c.id as infoid,c.ordertime,c.scantime,c.price,c.score,c.status,d.id,d.imgurl,d.explaintext,d.name,d.type,d.shortdesc,d.description1, ";
			$strSql .= " d.description2,d.description3 ";
			$strSql .= " FROM `custcommodityorders` c ";
			$strSql .= " left join `commodity` d on c.commodityid=d.id";
			$strSql .= " WHERE (c.status=2 or c.status=4 or c.status=3 or c.status=5 ) and c.custid=".$_SESSION["userid"];//
			$strSql .= " order by c.ordertime desc ";
			$strSql .= " limit $p,$perpage ";
			$datadetail = DBGetDataRowsSimple($strSql);
			$strSql= "select  count(*) as total from custcommodityorders WHERE (status=2 or status=4 or status=3 or status=5) and custid=".$_SESSION["userid"];//
			$result = DBGetDataRow($strSql);
			$datainfo['data']=$datadetail;
			$datainfo['total']=$result['total'];
			$datainfo["pagecount"]=ceil($datainfo["total"]/$perpage);
			$datainfo["perpage"]=$perpage;
			echo json_encode($datainfo);
			break;
		case "GotCommodityDetail":
//发放人员，何时发放
			$commodityinfoid = Get("commodityinfoid");//商品履历id
			$strSql = "select c.scantime,s.nickname,s.imgurl,s.name,s.mobile ";
			$strSql .= " FROM `custcommodityorders` c ";
			$strSql .= " left join `saler` s on c.scanerid=s.id ";
			$strSql .= " where  c.id=$commodityinfoid ";
			$commodityInfo = DBGetDataRow($strSql);
			echo json_encode($commodityInfo);
			break;
//查看商品领取码
		case "ShowGotCode"://显示兑换码
			$commodityid = Get("commodityid");//商品id
			$commodityInfo = DBGetDataRowByField("commodity","id",$commodityid);
			if($commodityInfo==null){
				die("-10");
			}
			if($commodityInfo["type"]==90){
				$info = DBGetDataRowByField("commoditycodes",array("commodityid","isgot","gotcust"),array($commodityid,1,$_SESSION["userid"]));
				$datainfo["code"]=$info["code"];
			}
			if($commodityInfo["type"]==80){
				$datainfo["code"]=$commodityInfo["commoditycode"];
			}
			$datainfo["explain"]=$commodityInfo["explaintext"];
			echo json_encode($datainfo);
			break;
				
	}
?>