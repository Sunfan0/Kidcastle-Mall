<?php
	include "paras.php";
	$perpage = 50;
	$mode = Get("mode");
	if(!CheckRights("bgsaler")){
		echo 123;
		die();
	}
	switch($mode){
//工作人员审核
		case "GetStaffinfo"://工作人员列表(0未审核，1审核通过，-1审核不通过)
			$type = Get("type");
			$currentpage = Get("currentpage");
			$currentpage=$currentpage-1;
			$p=$currentpage*$perpage;
			if($type != "-1" && $type != "0" && $type != "1")
				die();
			$detail=array();
			$data=array();
			$strSql= "select  count(*) as total from saler Where status = $type  ";//总数据数量
			$result = DBGetDataRow($strSql);
			
			$data["total"]=$result[0];
			if($data["total"]==0){
				$detail=null;
				echo json_encode($detail);
				die();
			}
			$strSql = " SELECT * FROM `saler` s ";
			$strSql .= " Where s.status = $type ";
			$strSql .= " order by s.name ";
			$strSql .= " limit $p,$perpage ";
			$datas = DBGetDataRows($strSql);
			
			foreach($datas as $result){
				$data["id"]=$result["id"];
				$data["nickname"]=$result["nickname"];
				$data["imgurl"]=$result["imgurl"];
				$data["name"]=$result["name"];
				$data["mobile"]=$result["mobile"];
				$data["school"]=$result["school"];
				$data["area"]=$result["area"];
				$data["pagecount"]=ceil($data["total"]/$perpage);
				$data["perpage"]=$perpage;
				array_push($detail,$data);
			}
			echo json_encode($detail);
			die();
			break;
		case "UpdateStaff"://审核状态更新
			$id = (int)(Get("id"));
			$status=Get("type");//0重新审核，1通过，-1拒绝
			$infos = DBUpdateField("saler" , $id , array("status") ,array($status));
			if($infos)
				echo 1;
			else
				echo -1;
			break;

	}
?>