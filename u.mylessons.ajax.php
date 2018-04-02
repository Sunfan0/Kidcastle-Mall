<?php
	include "paras.php";
	$mode = Get("mode");
	switch($mode){
		case "MyCourseList":
			$Info = DBGetDataRowByField("custinfo","id",$_SESSION["userid"]);
			if($Info["isstudent"]==0){
				die("-7");//还未购买过课程
			}
//怎样标记从帖子分享过来
//获取到帖子id
			$strSql = "select d.id ,d.noteid,d.ordertime,d.price,d.score,e.title,e.shortdesc,e.description1,";
			$strSql .= "e.description2,e.description3,f.span,p.timefrom,p.timeto ";
			$strSql .= " FROM `custlessonorders` d  ";
			$strSql .= " left join lessoninfos e on d.lessonid = e.id ";
			$strSql .= " left join lessonorderspan f on d.orderspanid = f.id ";
			$strSql .= " left join lessontimespan p on d.timespanid = p.id ";
			$strSql .= " WHERE d.custid=".$_SESSION["userid"];
			$strSql .= " order by ordertime asc,e.title desc ";//按照购买时间升序，课程名称降序
			$courseInfo = DBGetDataRowsSimple($strSql);
			echo json_encode($courseInfo);
			break;
	}
//
?>