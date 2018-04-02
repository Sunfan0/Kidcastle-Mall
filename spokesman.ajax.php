<?php
	include "paras.php";
	$mode = Get("mode");
	if(!CheckRights("bgspokesman")){
		echo 123;
		die();
	}
	switch($mode){
		case "ShareContentList"://发布的代言人分享内容列表（帖子的形式显示）
			$strSql = "Select * from sharecontent where status=1 or status=0 ";
			$data = DBGetDataRowsSimple($strSql);
			echo json_encode($data);
			break;
			
		case "ShowStandardScore"://通用的积分规则
			$strSql = "Select * from sharescorestandard ";
			$datainfo = DBGetDataRow($strSql);
			echo json_encode($datainfo);
			break;
			
		case "CourceList"://插入课程选择列表显示
			$strSql = "Select * from lessoninfos where status=1 ";
			$data = DBGetDataRowsSimple($strSql);
			echo json_encode($data);
			break;	
		case "CourceDetail"://课程详情
			$counseid = Get("counseid");
			$courseInfo = DBGetDataRowByField("lessoninfos","id",$counseid);
			echo json_encode($courseInfo);
			break;	
		case "ShareContentDetail"://帖子详情
			$noteid = Get("noteid");
			$noteInfo = DBGetDataRowByField("sharecontent","id",$noteid);
			echo json_encode($noteInfo);
			break;		
		case "UpdateShareContent"://新增或者修改帖子
			//$data = json_decode(Get("data") , true);
			$data = Get("data");
			$arrFields = array("title","description","picurl","content","defaulttitle","defaultdesc","defaulttimeline","defaultimgurl","sharescore","sharecount","clickscore","clickcount","signupscore","status");
			$arrValues = array($data["title"],$data["description"],$data["picurl"],$data["content"],$data["defaulttitle"],$data["defaultdesc"],$data["defaulttimeline"],$data["defaultimgurl"],$data["sharescore"],$data["sharecount"],$data["clickscore"],$data["clickcount"],$data["signupscore"],$data["publishid"]);
			
			if($data["flagid"]==""){//新增
				$shareId = DBInsertTableField("sharecontent",$arrFields,$arrValues);
				if($shareId>0){
					$smarty->clearCache('u.sharecontentlist.tpl');//帖子列表缓存清除
					echo 1;
				}else{
					echo -1;
				}
			}else{//修改
				$r = DBUpdateField("sharecontent" , $data["flagid"] ,$arrFields, $arrValues);
				if($r){
					$smarty->clearCache('u.sharecontent.tpl',$data["flagid"]);//帖子详情清除缓存
					$smarty->clearCache('u.sharecontentlist.tpl');//帖子列表缓存清除
					echo 1;
				}else{
					echo -1;
				}
			}
			break;
	}
?>