<?php
	include "paras.php";
	$openid = Get("wang");
	// $openid = "oi-lRwGgk2L60crNHyUzbyTw2-4o";
	// $openid = "oFb3-tkHk4WH0lp--vQsh0IDxJ5Q";
	$publisher = Get("publish");
	$ua = $_SERVER['HTTP_USER_AGENT'];
	$userInfo=null;
	
	if($openid == ""){
		$arrInfo = InitCustInfoV3(true);
		$openid = $arrInfo["openid"];
		$nickname=$arrInfo["nickname"];
		$headimgurl=$arrInfo["headimgurl"];
	} else {
		$userInfo = DBGetDataRowByField("custinfo" , "openid" , $openid);
		$nickname = $userInfo["nickname"];
		$headimgurl = $userInfo["imgurl"];
	}
	$_SESSION["openid"]=$openid;
	$_SESSION["nickname"]=$nickname;
	$_SESSION["headimgurl"]=$headimgurl;
	if($userInfo==null){//没有进行查找
		$userInfo = DBGetDataRowByField("custinfo" , "openid" , $openid);
	}
	if($userInfo==null){//没有找到数据
		$_SESSION["userid"] = DBInsertTableField("custinfo",array("openid","nickname","imgurl"), array($openid,$nickname,$headimgurl));
		$isregist=0;
	}else{
		$_SESSION["userid"]=$userInfo["id"];
		if($userInfo["mobile"]==""){
			$isregist=0;
		}else{
			$isregist=1;
		}
	}
//
//数据表不完善
	//$visitid = InitVisitidV3();
	/* $visitid = -1;
	$visitid = VisitHistoryV4($openid,$visitid,$_SESSION["pageurl"],$inviter,$ua,$publisher);//在visithistory表中插入访问数据 */
	if(!isset($_SESSION["pageurl"])){//如果url值为空
		if($isregist==0){
			page("u.regist.php");//注册页面
		}else{
			page("u.my.php");//个人首页
		} 
//
	}else{
		Page($_SESSION["pageurl"]);
	}
	
?>