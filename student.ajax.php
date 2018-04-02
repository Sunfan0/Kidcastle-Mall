<?php
	include "paras.php";
	$mode = Get("mode");
	if(!CheckRights("bgstudent")){
		echo 123;
		die();
	}
	switch($mode){
		case "CourceList"://课程列表显示
			$strSql = "Select d.id,d.title,d.shortdesc,d.status,d.description1,d.description2,d.description3,f.cnt ";
			$strSql .=" from lessoninfos d ";
			$strSql .= " left join (select count(*) as cnt,lessonid from custlessonorders where status=2 group by lessonid ) f on d.id=f.lessonid ";
			$data = DBGetDataRowsSimple($strSql);
			echo json_encode($data);
			break;	
		//课程报名学员一览表
		case "PublishCource":
			$courseid = (int)(Get("id"));//课程id
			$strSql = "Select b.custid,b.lessonid,b.price,b.score,b.ordertime,c.imgurl,c.nickname, ";
			$strSql.= " c.name,c.mobile,c.isstudent,c.score,d.title,e.span,p.timefrom,p.timeto from custlessonorders b  ";
			$strSql.= " left join custinfo c on b.custid=c.id  ";
			$strSql.= " left join lessoninfos d on b.lessonid=d.id  ";
			$strSql.= " left join lessonorderspan e on b.orderspanid=e.id  ";
			$strSql.= " left join lessontimespan p on b.timespanid=p.id  ";
			$strSql.= " where b.lessonid=$courseid and b.status=2 ";//已经支付
			$data = DBGetDataRowsSimple($strSql);
			echo json_encode($data);
			break;
	}


?>