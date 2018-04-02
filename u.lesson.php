<?php
	include "paras.php";
	
//获得inviter
//判断进入页面的人和inviter不是同一个人
//加积分	
	$inviter=Get("inviter");
	$courseid = Get("courseid");

	$noteid = Get("noteid");//从某条代言人分享帖子进入
	
	if($noteid!=""){//从分享帖子进入
		if($inviter==''){
			$inviter=0;
			$_SESSION["inviter"]=$inviter;
			$_SESSION["pageurl"]="u.lesson.php?courseid=".$courseid."&noteid=".$noteid;
			if(!isset($_SESSION["openid"])){
				Page("u.login.php");
			} 
		}else{
			$_SESSION["inviter"]=$inviter;
			$_SESSION["pageurl"]="u.lesson.php?courseid=".$courseid."&noteid=".$noteid."&inviter=".$_SESSION["inviter"];
			if(!isset($_SESSION["openid"])){
				Page("u.login.php");
			} 
		}
	}else{//正常进入或者从好友正常分享出去的链接进入
		if($inviter==''){
			$inviter=0;
			$_SESSION["inviter"]=$inviter;
			$_SESSION["pageurl"]="u.lesson.php?courseid=".$courseid;
			if(!isset($_SESSION["openid"])){
				Page("u.login.php");
			} 
		}else{
			$_SESSION["inviter"]=$inviter;
			$inviterInfo = DBGetDataRowByField("custinfo","id",$_SESSION["inviter"]);
			
			$_SESSION["pageurl"]="u.lesson.php?courseid=".$courseid."&inviter=".$_SESSION["inviter"];
			if(!isset($_SESSION["openid"])){
				Page("u.login.php");
			} 
			if($inviterInfo["openid"] != $_SESSION["openid"]){
				$courseInfo = DBGetDataRowByField("lessoninfos","id",$courseid);
				$clickscore=$courseInfo["clickscore"];
				$arrFields = array("custid","changetype","beforescore","changescore","afterscore","reason","operattime");
				$arrValues = array($_SESSION["inviter"],1,$inviterInfo["score"],$clickscore,$inviterInfo["score"]+$clickscore,'邀请好友进入'.$courseInfo["title"].'课程获得积分',$DB_FUNCTIONS["now"]);
				DBBeginTrans();
				$r = DBInsertTableField("custscorehistory" , $arrFields ,$arrValues);
				if($r<=0)
					DBRollbackTrans();
				//积分履历表
				$r = DBUpdateField("custinfo" , $_SESSION["inviter"] , array("score") ,array($clickscore+$inviterInfo["score"]));
				if(!$r)
					DBRollbackTrans();
				//用户信息表	
				DBCommitTrans();
			}
		}
	}
	$strSql = "select isstudent,score FROM `custinfo` WHERE id=".$_SESSION["userid"];
	$statusinfo = DBGetDataRow($strSql);
	$strSql = "select * FROM `lessoninfos` WHERE id=$courseid ";
	$courseinfo = DBGetDataRow($strSql);
	$strSql = "Select id,span from lessonorderspan where lessonid=$courseid and status=0 order by span ";
	$orderpan = DBGetDataRowsSimple($strSql);
	$strSql = "Select id,timefrom,timeto from lessontimespan where lessonid=$courseid and status=0 order by timefrom ";
	$timespan = DBGetDataRowsSimple($strSql);
	$courseinfo["orderspan"]=$orderpan;
	$courseinfo["timespan"]=$timespan;
	$courseinfo["statusinfo"]=$statusinfo;

	
	$smarty->assign("courseinfo",$courseinfo);
	
	$smarty->assign("inviter",$_SESSION["userid"],true);
	
	$smarty->assign("noteid",$noteid,true);//传给页面做参数
	
	//任何一个在不缓存区域内的变量，都可以在缓存时从PHP获取到值。
	
	//使用$smarty->cacheLifetime()可以更精确定义缓存时间是秒
	//你可以使用{nocache}{/nocache}来设置页面上部分区块是动态的（不缓存）
	
	//
	$smarty->setCaching(Smarty::CACHING_LIFETIME_CURRENT);
	
	$smarty->display('u.lesson.tpl',$courseid);
//还有一个问题，商品领取的状态未更新成5，方便数据显示，暂时存储的是4
?>
<script type="text/javascript">
	json = eval('(' + '<?php echo GetWXConfigData(); ?>' + ')')
// json.debug=true;
			wx.config(json);
			wx.error(function (res) {
				// alert(res.errMsg);
				// alert(res);
			});
</script>