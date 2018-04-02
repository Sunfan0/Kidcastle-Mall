<?php
	include "paras.php";
	$mode = Get("mode");
	if(!CheckRights("bgregister")){
		echo 123;
		die();
	}
	$perpage = 30;
	switch($mode){
 		case "RegisterList":
//可以导出csv	
			$currentpage = Get("currentpage");
			$currentpage=$currentpage-1;
			$p=$currentpage*$perpage;
			$isread = Get("isread");//0未就读，1已就读，2全部
			$school = Get("school");//校区,0全部校区
			$strSql = " Select s.name as schoolname,c.id,c.nickname,c.imgurl,c.name,c.mobile,c.score,c.isread,c.grade  ";
			$strSql .= " from custinfo c ";
			$strSql .= " left join school s on c.school=s.id ";
			if($isread==2){
				if($school==0){
					$strSql .= " where  c.name!='' and c.mobile!='' ";
					$strSqlcount= "select  count(*) as total from custinfo WHERE  name!='' and mobile!='' ";//
				}else{
					$strSql .= " where c.name!='' and c.mobile!='' and c.school=$school ";
					$strSqlcount= "select  count(*) as total from custinfo WHERE name!='' and mobile!='' and school=$school ";//
				}
			}else{
				if($school==0){
					$strSql .= " where c.isread=$isread and c.name!='' and c.mobile!='' ";
					$strSqlcount= "select  count(*) as total from custinfo WHERE isread=$isread and name!='' and mobile!='' ";//
				}else{
					$strSql .= " where c.isread=$isread and c.name!='' and c.mobile!='' and c.school=$school ";
					$strSqlcount= "select  count(*) as total from custinfo WHERE isread=$isread and name!='' and mobile!='' and school=$school ";//
				}
			}
			$strSql .= " limit $p,$perpage";
			$detail = DBGetDataRowsSimple($strSql);
			$result = DBGetDataRow($strSqlcount);
			$detailInfo['data']=$detail;
			$detailInfo['total']=$result['total'];
			$detailInfo["pagecount"]=ceil($detailInfo["total"]/$perpage);
			$detailInfo["perpage"]=$perpage;
			echo json_encode($detailInfo);
			break;
		case "ShowSchool":
			$strSql = "Select * from school ";
			$data = DBGetDataRowsSimple($strSql);
			echo json_encode($data);
			break;
	}
?>