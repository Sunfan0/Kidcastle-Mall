<?php
	include "paras.php";
	
	$noteid = Get("noteid");
	$inviter = Get("inviter");
	
	
//从分享帖子进入
//主要区别给邀请者所增加的积分不一样，进去页面的链接地址参数不一样	
	if($inviter==''){
		$inviter=0;
		$_SESSION["inviter"]=$inviter;
		$_SESSION["pageurl"]="u.sharecontent.php?noteid=".$noteid;//某篇分享帖子进入
		if(!isset($_SESSION["openid"])){
			Page("u.login.php");
		} 
	}else{
		$_SESSION["inviter"]=$inviter;
		$inviterInfo = DBGetDataRowByField("custinfo","id",$_SESSION["inviter"]);
		$_SESSION["pageurl"]="u.sharecontent.php?noteid=".$noteid."&inviter=".$_SESSION["inviter"];
		if(!isset($_SESSION["openid"])){
			Page("u.login.php");
		} 
		if($inviterInfo["openid"] != $_SESSION["openid"]){
			//进入页面先判断当天，当前邀请者，当前帖子点击进入积分次数是否已经达到上限
			$noteInfo = DBGetDataRowByField("sharecontent","id",$noteid);
			$clickscore=$noteInfo["clickscore"];
			$maxclickcount=$noteInfo["clickcount"];
			$clickarrFields = array("custid","contentid","scoretype","beforescore","changescore","afterscore","reason","orderdate");
			$clickarrValues = array($_SESSION["userid"],$noteid,2,$inviterInfo["score"],$clickscore,$inviterInfo["score"]+$clickscore,'邀请好友进入课程帖子'.$noteid.'获得积分',$DB_FUNCTIONS["now"]);
			$countinfo = DBGetDataRowByField("spokesmansharescore" ,array("custid","contentid","orderdate"), array($_SESSION["inviter"],$noteid,date('Y-m-d')));
			if($countinfo==null){
				$r = DBInsertTableField("spokesmansharescore" , $clickarrFields ,$clickarrValues);
				if($r<=0){
					die("-9");
				}
			}//当日当前帖子点击数据登记
			
			$strSql = " Select count from spokesmansharescore where orderdate = date_format(now(),'%Y-%m-%d') and custid=".$_SESSION["inviter"];
			$clickcount = DBGetDataRow($strSql);
			if($clickcount["count"]<$maxclickcount){//达到每日邀请点击上限次数，积分数据不增加
				$arrFields = array("custid","changetype","beforescore","changescore","afterscore","reason","operattime");
				$arrValues = array($_SESSION["inviter"],1,$inviterInfo["score"],$clickscore,$inviterInfo["score"]+$clickscore,'邀请好友进入课程帖子'.$noteid.'获得积分',$DB_FUNCTIONS["now"]);
				DBBeginTrans();
				$r = DBInsertTableField("custscorehistory" , $arrFields ,$arrValues);
				if($r<=0)
					DBRollbackTrans();
				//积分履历表
				$r = DBUpdateField("custinfo" , $_SESSION["inviter"] , array("score") ,array($clickscore+$inviterInfo["score"]));
				if(!$r)
					DBRollbackTrans();
				if(!DBUpdateField("spokesmansharescore",$countinfo["id"],array("count"),array($countinfo["count"]+1)))
					DBRollbackTrans();
				//用户信息表	
				DBCommitTrans();
			}
		}	
	}

	
	$strSql = "select * FROM `sharecontent` WHERE id=$noteid ";
	$sharecontentinfo = DBGetDataRow($strSql);
	
	$smarty->assign("sharecontentinfo",$sharecontentinfo);
	$smarty->assign("inviter",$_SESSION["userid"],true);
	
	
	
	$smarty->setCaching(Smarty::CACHING_LIFETIME_CURRENT);
	
	$smarty->display('u.sharecontent.tpl',$noteid);
//
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