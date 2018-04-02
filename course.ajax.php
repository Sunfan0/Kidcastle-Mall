<?php
	include "paras.php";
	$mode = Get("mode");
	if(!CheckRights("bgcourse")){
		echo 123;
		die();
	}
	switch($mode){
//课程列表
		case "CourceList"://课程列表显示
			$schoolid = Get("school");//校区id
			$coursetypeid = Get("coursetype");//课程类型id
			$strSql = "Select d.id,d.title,d.shortdesc,d.status,d.description1,d.description2,d.description3,f.cnt, ";
			$strSql .="s.name as school,c.name as typename from lessoninfos d ";
			$strSql .= " left join (select count(*) as cnt,lessonid from custlessonorders where status=2 group by lessonid ) f on d.id=f.lessonid ";
			$strSql .= " left join school s on d.school=s.id ";//校区
			$strSql .= " left join coursetype c on d.coursetype=c.id ";//课程类型
			
			if($schoolid==0){
				if($coursetypeid!=0){
					$strSql .= " where d.coursetype=$coursetypeid ";//课程类型筛选
				}
			}else{
				if($coursetypeid==0){
					$strSql .= " where d.school=$schoolid ";//校区筛选
				}else{
					$strSql .= " where d.coursetype=$coursetypeid and d.school=$schoolid ";//课程类型,校区筛选
				}
			}
			$data = DBGetDataRowsSimple($strSql);
			echo json_encode($data);
			break;	
		case "ShowCourseType":
			$strSql = "Select * from coursetype ";
			$data = DBGetDataRowsSimple($strSql);
			echo json_encode($data);
			break;
		case "ShowSchool":
			$strSql = "Select * from school ";
			$data = DBGetDataRowsSimple($strSql);
			echo json_encode($data);
			break;
		case "ShowCource"://每个课程的详细内容显示
			$id = (int)(Get("id"));
			$strSql = "Select * from lessoninfos where id=$id ";
			$datainfo = DBGetDataRow($strSql);
			/* $strSql = "Select * from lessontimespan where lessonid=$id and status=0 ";
			$timespan = DBGetDataRowsSimple($strSql); */
			$strSql = "Select * from lessonorderspan where lessonid=$id and status=0 ";
			$orderspan = DBGetDataRowsSimple($strSql);
			//$datainfo["timespan"]=$timespan;
			$datainfo["orderspan"]=$orderspan;
			echo json_encode($datainfo);
			break;
		
		case "UpdateCource"://更新课程设置信息，课程时段设置
			$data = json_decode(Get("data") , true);
			$arrFields = array("title","titleimage","timerinfo","count","shortdesc","description1","description2","description3","price1","score1","price2","score2","price3","score3","sharescore","clickscore","orderscore","status");
			$arrValues = array($data["title"],$data["titleimage"],$data["timerinfo"],$data["count"],$data["shortdesc"],$data["description1"],$data["description2"],$data["description3"],$data["price1"],$data["score1"],$data["price2"],$data["score2"],$data["price3"],$data["score3"],$data["sharescore"],$data["clickscore"],$data["orderscore"],$data["publishid"]);
			DBBeginTrans();
			if($data["flagid"]==""){//新增
				$courseId = DBInsertTableField("lessoninfos",$arrFields,$arrValues);
				if($courseId<=0)
					AjaxRollBack('-1');
//数组中传递所有的时段选择状态status(0,-1),spantype,spancount,
				/* for($i=0;$i<count($data["orderspan"]);$i++){//2和月分开（spancount和spantype）
					if($data["orderspan"][$i]["status"]==0){//选中设置
						$arrFields1 = array("lessonid","spantype","spancount","shortdesc");
						$arrValues1 = array($courseId,$data["orderspan"][$i]["spantype"],$data["orderspan"][$i]["spancount"],$data["shortdesc"]);
						$Id = DBInsertTableField("lessonorderspan" , $arrFields1 , $arrValues1);
						if($Id<=0)
							AjaxRollBack('-9');
					}
				} */
				for($i=0;$i<count($data["orderspan"]);$i++){
					if($data["orderspan"][$i]["status"]==0){//选中设置
						$arrFields1 = array("lessonid","span","shortdesc");
						$arrValues1 = array($courseId,$data["orderspan"][$i]["span"],$data["shortdesc"]);
						$Id = DBInsertTableField("lessonorderspan" , $arrFields1 , $arrValues1);
						if($Id<=0)
							AjaxRollBack('-9');
					}
				}
//数组传递时间点状态选择状态status(0,-1),timefrom,timeto,
				/* for($i=0;$i<count($data["timespan"]);$i++){
					if($data["timespan"][$i]["status"]==0){//选中设置
						$arrFields2 = array("lessonid","timefrom","timeto");
						$arrValues2 = array($courseId,'0000:00:00 '.$data["timespan"][$i]["timefrom"].':00','0000:00:00 '.$data["timespan"][$i]["timeto"].':00');
						$Id = DBInsertTableField("lessontimespan" , $arrFields2 , $arrValues2);
						if($Id<=0)
							AjaxRollBack('-5');
					}
				} */
			}else{//修改
				$r = DBUpdateField("lessoninfos" , $data["flagid"] ,$arrFields, $arrValues);
				if(!$r)
					AjaxRollBack('-3');
				/* for($i=0;$i<count($data["orderspan"]);$i++){//能不能2和月分开（spancount和spantype）
					//先在数据库中根据传递过来的spancount,spantype,lessonid查找
					$data1 = DBGetDataRowByField("lessonorderspan" , array("lessonid","spantype","spancount"),array($data["flagid"],$data["orderspan"][$i]["spantype"],$data["orderspan"][$i]["spancount"]));
					if($data1==null&&$data["orderspan"][$i]["status"]==0){//新添加的上课时段
						$arrFields1 = array("lessonid","spantype","spancount","shortdesc");
						$arrValues1 = array($data["flagid"],$data["orderspan"][$i]["spantype"],$data["orderspan"][$i]["spancount"],$data["shortdesc"]);
						$Id = DBInsertTableField("lessonorderspan" , $arrFields1 , $arrValues1);
						if($Id<=0)
							AjaxRollBack('-7');
					}
					if($data1!=null&&$data["orderspan"][$i]["status"]==-1){//数据库中存在，本次设置取消
						if($data1["status"]==0){//本次设置取消
							$r = DBUpdateField("lessonorderspan" , $data1["id"] ,array("status"), $array(-1));
							if($r<=0)
								AjaxRollBack('-8');
						}
					}
				} */
				for($i=0;$i<count($data["orderspan"]);$i++){
					$data1 = DBGetDataRowByField("lessonorderspan" , array("lessonid","span"),array($data["flagid"],$data["orderspan"][$i]["span"]));
					if($data1==null&&$data["orderspan"][$i]["status"]==0){//新添加的上课时段
						$arrFields1 = array("lessonid","span","shortdesc");
						$arrValues1 = array($data["flagid"],$data["orderspan"][$i]["span"],$data["shortdesc"]);
						$Id = DBInsertTableField("lessonorderspan" , $arrFields1 , $arrValues1);
						if($Id<=0)
							AjaxRollBack('-7');
					}
					if($data1!=null&&$data["orderspan"][$i]["status"]==-1){//数据库中存在，本次设置取消
						if($data1["status"]==0){//本次设置取消
							$r = DBUpdateField("lessonorderspan" , $data1["id"] ,array("status"), $array(-1));
							if($r<=0)
								AjaxRollBack('-8');
						}
					}
				}
				/* for($i=0;$i<count($data["timespan"]);$i++){
					$data2 = DBGetDataRowByField("lessontimespan" , array("lessonid","timefrom","timeto"),array($data["flagid"],'0000:00:00 '.$data["timespan"][$i]["timefrom"].':00','0000:00:00 '.$data["timespan"][$i]["timeto"].':00'));
					if($data2==null&&$data["timespan"][$i]["status"]==0){//新添加
						$arrFields2 = array("lessonid","timefrom","timeto");
						$arrValues2 = array($data["flagid"],'0000:00:00 '.$data["timespan"][$i]["timefrom"].':00','0000:00:00 '.$data["timespan"][$i]["timeto"].':00');
						$Id = DBInsertTableField("lessontimespan" , $arrFields2 , $arrValues2);
						if($Id<=0)
							AjaxRollBack('-3');
					}
					if($data2!=null&&$data["timespan"][$i]["status"]==-1){//数据库中存在，本次设置取消
						if($data2["status"]==0){//本次设置取消
							$r = DBUpdateField("lessontimespan" , $data2["id"] ,array("status"), $array(-1));
							if($r<=0)
								AjaxRollBack('-2');
						}
					}
				} */
				$smarty->clearCache('u.lesson.tpl',$data["flagid"]);//课程详情清除缓存
			}
			DBCommitTrans();
			$smarty->clearCache('u.lessonlist.tpl');//课程列表缓存清除
			echo 1;
			break;	
//课程时间操作	
		//增加时间点
		/* case "AddTimespan":
			$lessonid = Get("lessonid");
			$timefrom = Get("timefrom");
			$timeto = Get("timeto");
			$lessonInfo = DBGetDataRowByField("lessoninfos","id",$lessonid);
			$status=$lessonInfo["status"];
			$id = DBInsertTableField("lessontimespan" ,$array("lessonid","timefrom","timeto","status") ,$array($lessonid,'0000-00-00 '.$timefrom.':00','0000-00-00 '.$timeto.':00',$status));
			if($id > 0){
				echo 1;
			} else {
				echo -1;
			}
			break;*/
		//点击编辑时间点，显示所有设置的时间点
		case "ShowTimespan":	
			$lessonid = Get("lessonid");
			$strSql = "Select * from lessontimespan where lessonid=$lessonid ";
			$timespan = DBGetDataRowsSimple($strSql);
			echo json_encode($timespan);
			break;
		//删除某个时间点
		/*case "DeleteTimespan":	
			$id = Get("id");
			$r = DBUpdateField("lessontimespan" , $id ,array("status"), $array(-1));
			if($r > 0){
				echo 1;
			} else {
				echo -1;
			}
			break;*/
//显示已经选中设置上课时段
		case "ShowOrderspan":	
			$lessonid = Get("lessonid");
			$strSql = "Select * from lessonorderspan where lessonid=$lessonid and status=0 ";
			$orderspan = DBGetDataRowsSimple($strSql);
			echo json_encode($orderspan);
			break;  
//同一门课程，不同时段课程价格未设置			
			
		
//
	}
?>