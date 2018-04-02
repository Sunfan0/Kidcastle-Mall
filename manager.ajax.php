<?php
	include "paras.php";
	$mode = Get("mode");
	if(!CheckRights("bgmanager")){
		echo 123;
		die();
	}
	switch($mode){
		case "ShowAllBgmanager"://后台账号显示
			$strSql = "Select b.id,b.loginname,b.rights,b.name, s.name as school from bgmanager b ";
			$strSql.= "left join school s on b.school=s.id ";
			$data = DBGetDataRowsSimple($strSql);
			echo json_encode($data);
			break;
		case "ShowOneBgmanager"://账号详细信息显示
			$id = Get("id");
			$strSql = "Select id,loginname,rights,name,school from bgmanager b ";
			$strSql.= " where id=$id ";
			$data = DBGetDataRow($strSql);
			echo json_encode($data);
			break;
		case "UpdateBgmanager"://更新账号信息
			$flagid = Get("flagid");//判断是更新还是新增
			$loginname = Get("username");
			$password = Get("password");
			
			$name = Get("name");//姓名
			$school = Get("school");//校区
//
			$bgmanager = Get('bgmanager');//管理后台账号
			$bgsaler = Get('bgsaler');//管理工作人员
			$bgcommodity = Get('bgcommodity');//管理兑换商品
			$bgcourse = Get('bgcourse');//管理课程
			$bgstudent = Get('bgstudent');//管理报名学员
			$viewcommoditygot= Get('viewcommoditygot');//查看商品兑换
			$bgspokesman = Get('bgspokesman');//代言人分享内容设置
			$bgscorerule = Get('bgscorerule');//分享积分规则
			$bgscoredetail = Get('bgscoredetail');//积分明细
			
			$bgregister = Get('bgregister');//注册学员
			$bgscorechange = Get('bgscorechange');//积分管理
			
//权限不完整
			$manager = array("bgmanager"=>$bgmanager,"bgsaler"=>$bgsaler,"bgcommodity"=>$bgcommodity,"bgcourse"=>$bgcourse,"bgstudent"=>$bgstudent,"viewcommoditygot"=>$viewcommoditygot,"bgspokesman"=>$bgspokesman,"bgscorerule"=>$bgscorerule,"bgscoredetail"=>$bgscoredetail,"bgregister"=>$bgregister,"bgscorechange"=>$bgscorechange,);
			$rights=json_encode($manager);
			if($password=='d41d8cd98f00b204e9800998ecf8427e'){
				$arrFields = array("name","school","loginname","rights");
				$arrValues = array($name,$school,$loginname,$rights);
			}else{
				$arrFields = array("name","school","loginname","password","rights");
				$arrValues = array($name,$school,$loginname,$password,$rights);
			}
			if($flagid==""){//新增
				$r = DBInsertTableField("bgmanager" , $arrFields ,$arrValues);
				if($r > 0){
					echo 1;
				} else {
					echo -1;
				}
				die();
			}else{//修改
				$r = DBUpdateField("bgmanager" , $flagid ,$arrFields, $arrValues);
				if($r){
					echo 1;
				}else{
					echo -1;
				}
				die();
			}
			break;
		case "DeleteBgmanager"://删除
			$id = Get("id");
			$r = DBDeleteData("bgmanager" , $id);
			if($r > 0){
				echo 1;
			} else {
				echo -1;
			}
			break;
		case "ShowSchool":
			$strSql = "Select * from school ";
			$data = DBGetDataRowsSimple($strSql);
			echo json_encode($data);
			break;

	}
?>