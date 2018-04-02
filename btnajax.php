<?php
	include "paras.php";
	$mode = Get("mode");
	switch($mode){
//点击报名，(课程购买数据表插入数据)
		case "ShareSuccess":
			$courseid = Get("courseid");//课程id
			$custInfo = DBGetDataRowByField("custinfo","id",$_SESSION["userid"]);
			$courseInfo = DBGetDataRowByField("lessoninfos","id",$courseid);
			$sharescore=$courseInfo["sharescore"];
			$coursename=$courseInfo["title"];
			$arrFields = array("custid","changetype","beforescore","changescore","afterscore","reason","operattime");
			$arrValues = array($_SESSION["userid"],1,$custInfo["score"],$sharescore,$custInfo["score"]+$sharescore,'成功分享'.$coursename.'课程给好友获得积分',$DB_FUNCTIONS["now"]);
			DBBeginTrans();
			$r = DBInsertTableField("custscorehistory" , $arrFields ,$arrValues);
			if($r<=0)
				DBRollbackTrans("-1");
			$r = DBUpdateField("custinfo" , $_SESSION["userid"] , array("score") ,array($sharescore+$custInfo["score"]));
			if(!$r)
				DBRollbackTrans("-2");
			DBCommitTrans();
			echo 1;
			break;
		case "ShareAddScore":
//scoretype(1分享积分,2点击积分,3成功报名积分)
//积分明细表数据增加(custscorehistory)，
//用户数据表积分更新，(custinfo)
//分享数据表数据记录，限制次数增加积分(spokesmansharescore)
			$noteid = Get("noteid");//帖子id
			$custInfo = DBGetDataRowByField("custinfo","id",$_SESSION["userid"]);
			$noteInfo = DBGetDataRowByField("sharecontent","id",$noteid);
			$sharescore=$noteInfo["sharescore"];
			$maxsharecount=$noteInfo["sharecount"];
			$notename=$noteInfo["title"];
			$sharearrFields = array("custid","contentid","scoretype","beforescore","changescore","afterscore","reason","orderdate");
			$sharearrValues = array($_SESSION["userid"],$noteid,1,$custInfo["score"],$sharescore,$custInfo["score"]+$sharescore,'成功分享课程帖子'.$notename.'给好友获得积分',$DB_FUNCTIONS["now"]);
			$countinfo = DBGetDataRowByField("spokesmansharescore" ,array("custid","contentid","scoretype","orderdate"), array($_SESSION["userid"],$noteid,1,date('Y-m-d')));
			if($countinfo==null){
				$r = DBInsertTableField("spokesmansharescore" , $sharearrFields ,$sharearrValues);
				if($r<=0){
					die("-9");
				}
			}//当日当前帖子分享数据登记
			if($countinfo["count"]<$maxsharecount){//达到每日分享上限次数，积分数据不增加
				$arrFields = array("custid","changetype","beforescore","changescore","afterscore","reason","operattime");
				$arrValues = array($_SESSION["userid"],1,$custInfo["score"],$sharescore,$custInfo["score"]+$sharescore,'成功分享课程帖子'.$notename.'给好友获得积分',$DB_FUNCTIONS["now"]);
				DBBeginTrans();
				$r = DBInsertTableField("custscorehistory" , $arrFields ,$arrValues);
				if($r<=0)
					DBRollbackTrans("-1");
				$r = DBUpdateField("custinfo" , $_SESSION["userid"] , array("score") ,array($sharescore+$custInfo["score"]));
				if(!$r)
					DBRollbackTrans("-2");

				if(!DBUpdateField("spokesmansharescore",$countinfo["id"],array("count"),array($countinfo["count"]+1)))
					DBRollbackTrans("-3");
				DBCommitTrans();
			}
			break;	
			
			
			
			
		case "SignUpCourse":
			$courseid = Get("courseid");//课程id
			$price = Get("price");
			$score = Get("score");
			$noteid = Get("noteid");
			if($noteid==""){
				$noteid=0;
			} 
			$orderspanid = Get("orderspanid");
			$timespanid = Get("timespanid");
			$arrFields = array("custid","noteid","lessonid","ordertime","inviter","price","score","orderspanid","timespanid","status");
			$arrValues = array($_SESSION["userid"],$noteid,$courseid,$DB_FUNCTIONS["now"],$_SESSION["inviter"],$price,$score,$orderspanid,$timespanid,1);
			
			$courseinfoid = DBInsertTableField("custlessonorders" , $arrFields ,$arrValues);//
			if($courseinfoid<=0){
				echo -1;
			}else{
				echo $courseinfoid;
			}
			break;
//在线支付完成后,更新课程状态
//会员身份成为学员
		case "FinishSign":
			$noteid = Get("noteid");
			$courseinfoid = Get("courseinfoid");//课程报名详情数据id
			$coursedetailInfo = DBGetDataRowByField("custlessonorders","id",$courseinfoid);
			$courseid=$coursedetailInfo["lessonid"];
			$score=$coursedetailInfo["score"];
			$price=$coursedetailInfo["price"];
			$custInfo = DBGetDataRowByField("custinfo","id",$_SESSION["userid"]);	
			$courseInfo = DBGetDataRowByField("lessoninfos","id",$courseid);
			if($custInfo["score"]==0||$custInfo["score"]<$score){
				die("-99");//积分不足
			} 
			if($courseInfo["count"]==0){
				die("-999");//库存不足
			}
			DBBeginTrans();
			if($price==0){//价格为0
				$arrFields = array("custid","changetype","beforescore","changescore","afterscore","reason","signupid","operattime");
				if($noteid==""||$noteid==0){
					$signupscore=$courseInfo["orderscore"];
					if($_SESSION["inviter"]!=0){
						$inviterInfo = DBGetDataRowByField("custinfo","id",$_SESSION["inviter"]);
						$arrValues = array($_SESSION["inviter"],1,$inviterInfo["score"],$signupscore,$inviterInfo["score"]+$signupscore,'推介好友成功购买'.$courseInfo["title"].'课程',$_SESSION["userid"],$DB_FUNCTIONS["now"]);
					}
					$arrValuescust = array($_SESSION["userid"],-1,$custInfo["score"],$score,$custInfo["score"]-$score,'购买'.$courseInfo["title"].'课程抵扣',0,$DB_FUNCTIONS["now"]);
				}else{
					$contentdetailInfo = DBGetDataRowByField("sharecontent","id",$noteid);
					$signupscore=$coursedetailInfo["score"];
					if($_SESSION["inviter"]!=0){
						$arrValues = array($_SESSION["inviter"],1,$inviterInfo["score"],$signupscore,$inviterInfo["score"]+$signupscore,'邀请好友进入课程帖子'.$contentdetailInfo["title"].'成功报名获得积分',$_SESSION["userid"],$DB_FUNCTIONS["now"]);
					}
					$arrValuescust = array($_SESSION["userid"],-1,$custInfo["score"],$score,$custInfo["score"]-$score,'通过好友邀请进入帖子'.$contentdetailInfo["title"].'购买课程抵扣',0,$DB_FUNCTIONS["now"]);
				}
				if($_SESSION["inviter"]!=0){
					$r = DBInsertTableField("custscorehistory" , $arrFields ,$arrValues);//
					if($r<=0)
						AjaxRollBack("-8");	
					$r = DBUpdateField("custinfo" , $_SESSION["inviter"] , array("isstudent","score") ,array(1,$inviterInfo["score"]+$signupscore));
					if(!$r)
						AjaxRollBack("-7");
				}
				$r = DBInsertTableField("custscorehistory" , $arrFields ,$arrValuescust);
				if($r<=0)
					AjaxRollBack("8");
				$r = DBUpdateField("custinfo" , $_SESSION["userid"] , array("isstudent","score") ,array(1,$custInfo["score"]-$score));
				if(!$r)
					AjaxRollBack("7");
				$r = DBUpdateField("custlessonorders" , $courseinfoid , array("inviter","status","ordertime") ,array($_SESSION["inviter"],2,$DB_FUNCTIONS["now"]));
				if(!$r)
					AjaxRollBack("-1");
				DBCommitTrans();
				echo 011;
				die();
			}
			
			$goodsarrFields = array("goodsid","salerid","custid","salestime","paystatus","paymoney");
			$goodsarrValues = array($courseid,0,$_SESSION["userid"],$DB_FUNCTIONS["now"],0,$price);
			$orderNo = DBInsertTableField("orderlist",$goodsarrFields,$goodsarrValues);
			if($orderNo == null || $orderNo < 0){
				AjaxRollBack("-8");	
			}	
			$out_trade_no = "Kidcastle2016".str_pad($_SESSION["userid"],8,'0',STR_PAD_LEFT).str_pad($orderNo,8,'0',STR_PAD_LEFT);	
			$r = DBUpdateField("orderlist" , $orderNo , "out_trade_no" , $out_trade_no);
			if(!$r){
				AjaxRollBack("-7");
			}
			DBCommitTrans();
			
			$smarty->clearCache('u.mylesson.tpl',$courseinfoid);
			
			
			include_once("WxPayPubHelper/WxPayPubHelper.php");
			//SetSalesCenterID(0);
			$WxPayConf["APPID"] = APPID;
			$WxPayConf["MCHID"] = '1409984102';
			$WxPayConf["KEY"] = 'kidcaskidcaskidcaskidcaskidcas16';
			$WxPayConf["APPSECRET"] = APPSECRET;
			$WxPayConf["SSLCERT_PATH"] = '/Pages/WXPay/WxPayPubHelper/cacert/apiclient_cert.pem';
			$WxPayConf["SSLKEY_PATH"] = '/Pages/WXPay/WxPayPubHelper/cacert/apiclient_key.pem';
$WxPayConf["JS_API_CALL_URL"] = 'http://weixin.wsestar.com/wxpay/confirm_order.php';;
$WxPayConf["NOTIFY_URL"] = 'http://www.wsestar.com/test/Kidcastle-Mall/get_pay_result_notify.php';
$WxPayConf["CURL_TIMEOUT"] = 30;
			//使用jsapi接口
//
			$jsApi = new JsApi_pub(0);
			//=========步骤1：网页授权获取用户openid============
			//通过code获得openid
			//=========步骤2：使用统一支付接口，获取prepay_id============
			//使用统一支付接口
			$unifiedOrder = new UnifiedOrder_pub(0);
			//设置统一支付接口参数
			//设置必填参数
			//appid已填,商户无需重复填写
			//mch_id已填,商户无需重复填写
			//noncestr已填,商户无需重复填写
			//spbill_create_ip已填,商户无需重复填写
			//sign已填,商户无需重复填写
			$unifiedOrder->setParameter("openid",$_SESSION["openid"]);
			$unifiedOrder->setParameter("body","\"" . $courseInfo["shortdesc"] . "\"");//商品描述


			//自定义订单号，此处仅作举例
			$timeStamp = time();
			$unifiedOrder->setParameter("out_trade_no","$out_trade_no");//商户订单号 
			$unifiedOrder->setParameter("total_fee",$price*100);//总金额
			//$unifiedOrder->setParameter("total_fee",1);//总金额
			$unifiedOrder->setParameter("notify_url",$GLOBALS["WxPayConf"]["NOTIFY_URL"]);//通知地址 
			$unifiedOrder->setParameter("trade_type","JSAPI");//交易类型

			$prepay_id = $unifiedOrder->getPrepayId();
			//=========步骤3：使用jsapi调起支付============
			$jsApi->setPrepayId($prepay_id);

			$jsApiParameters = $jsApi->getParameters();
			$t = json_decode($jsApiParameters , true);
		
			$result = array();
			$result["unifiedOrder"]=$unifiedOrder->parameters;
			$result["data"] = $jsApiParameters;
			$result["orderno"] = $out_trade_no;
			echo json_encode($result);
			break;	
			
//	
			
//点击兑换按钮
//都是线上支付，分为需要支付和不需要支付
		case "Exchange":
			$commodityid = Get("commodityid");
			$price = Get("price");
			$score = Get("score");
			$arrFields = array("custid","commodityid","ordertime","price","score","status");
			$arrValues = array($_SESSION["userid"],$commodityid,$DB_FUNCTIONS["now"],$price,$score,3);
			$r = DBInsertTableField("custcommodityorders" , $arrFields ,$arrValues);
			if($r<=0)
				echo -1;
			else 
				echo $r;
			break;
		case "ConfirmExchange"://使用积分兑换或者购买商品
			$commodityinfoid = Get("commodityinfoid");//商品明细表数据
			$commodityInfodetail = DBGetDataRowByField("custcommodityorders","id",$commodityinfoid);
			
			$commodityid = $commodityInfodetail["commodityid"];
			$score = $commodityInfodetail["score"];
			$price = $commodityInfodetail["price"];
			$commodityInfo = DBGetDataRowByField("commodity","id",$commodityid);//兑换商品信息
			$type = $commodityInfo["type"];	
//兑换按钮更新状态都是3
//支付完成状态是2，
//已经领取状态是4，
			$custInfo = DBGetDataRowByField("custinfo","id",$_SESSION["userid"]);
			if($custInfo["score"]==0||$custInfo["score"]<$score){
				die("-999");//积分不足
			} 
			DBBeginTrans();
			switch($type){
				case 90://限量虚拟商品
					$codeInfo = DBGetDataRowByFieldForUpdate("commoditycodes",array("commodityid","isgot"),array($commodityid,0));
					if($codeInfo==null){
						die("-99");//该商品已经兑换完
					}
					break;
				case 10:
					
				case 80://不限量虚拟商品和线下领取实物商品
					$codeInfo = DBGetDataRowByField("commodity",array("id"),array($commodityid));
					if($codeInfo["count"]==0){
						die("-99");//该商品已经兑换完
					}
					break;
			}
			if($price==0){
				switch($type){
					case 90://限量虚拟商品
						$codeInfo = DBGetDataRowByFieldForUpdate("commoditycodes",array("commodityid","isgot"),array($commodityid,0));
						
						$fid = DBUpdateField("commoditycodes" , $codeInfo["id"] , array("isgot","gottime","gotcust") ,array(1,$DB_FUNCTIONS["now"],$_SESSION["userid"]));
						if(!$fid)
							AjaxRollBack("-1");
						break;
				}
	//用户积分变动明细数据		
				$arrFields = array("custid","changetype","beforescore","changescore","afterscore","reason","operattime");
				$arrValues = array($_SESSION["userid"],-1,$custInfo["score"],$score,$custInfo["score"]-$score,'积分兑换'.$commodityInfo["name"],$DB_FUNCTIONS["now"]);
				$r = DBInsertTableField("custscorehistory" , $arrFields ,$arrValues);
				if($r<=0)
					AjaxRollBack("-5");
	//更新用户表可用积分
				$r = DBUpdateField("custinfo" , $_SESSION["userid"] , array("score") ,array($custInfo["score"]-$score));
				if(!$r)
					AjaxRollBack("-9");
				$strSql = " Update commodity Set count = count-1 Where id = $commodityid ";//更新库存
				if(!DBExecute($strSql))
					AjaxRollBack("-2");
				$r = DBUpdateField("custcommodityorders" , $commodityinfoid , array("status","ordertime") ,array(4,$DB_FUNCTIONS["now"]));
				if(!$r)
					AjaxRollBack("-3");
				DBCommitTrans();
				echo 011;
				die();
			}
			
			$goodsarrFields = array("goodsid","salerid","custid","salestime","paystatus","paymoney");
			$goodsarrValues = array($commodityid,0,$_SESSION["userid"],$DB_FUNCTIONS["now"],0,$price);
			$orderNo = DBInsertTableField("orderlist",$goodsarrFields,$goodsarrValues);
			if($orderNo == null || $orderNo < 0){
				AjaxRollBack("-7");	
			}	
			$out_trade_no = "Kidcastle2016".str_pad($_SESSION["userid"],8,'0',STR_PAD_LEFT).str_pad($orderNo,8,'0',STR_PAD_LEFT);	
			$r = DBUpdateField("orderlist" , $orderNo , "out_trade_no" , $out_trade_no);
			if(!$r){
				AjaxRollBack("-8");
			}	
			
			DBCommitTrans();
			include_once("WxPayPubHelper/WxPayPubHelper.php");
			//SetSalesCenterID(0);
			$WxPayConf["APPID"] = APPID;
			$WxPayConf["MCHID"] = '1409984102';
			$WxPayConf["KEY"] = 'kidcaskidcaskidcaskidcaskidcas16';
			$WxPayConf["APPSECRET"] = APPSECRET;
			$WxPayConf["SSLCERT_PATH"] = '/Pages/WXPay/WxPayPubHelper/cacert/apiclient_cert.pem';
			$WxPayConf["SSLKEY_PATH"] = '/Pages/WXPay/WxPayPubHelper/cacert/apiclient_key.pem';
$WxPayConf["JS_API_CALL_URL"] = 'http://weixin.wsestar.com/wxpay/confirm_order.php';;
$WxPayConf["NOTIFY_URL"] = 'http://www.wsestar.com/test/Kidcastle-Mall/get_pay_result_notify.php';
$WxPayConf["CURL_TIMEOUT"] = 30;
			//使用jsapi接口
			$jsApi = new JsApi_pub(0);
			//=========步骤1：网页授权获取用户openid============
			//通过code获得openid
			//=========步骤2：使用统一支付接口，获取prepay_id============
			//使用统一支付接口
			$unifiedOrder = new UnifiedOrder_pub(0);
			//设置统一支付接口参数
			//设置必填参数
			//appid已填,商户无需重复填写
			//mch_id已填,商户无需重复填写
			//noncestr已填,商户无需重复填写
			//spbill_create_ip已填,商户无需重复填写
			//sign已填,商户无需重复填写
			$unifiedOrder->setParameter("openid",$_SESSION["openid"]);
			$unifiedOrder->setParameter("body","\"" . $commodityInfo["name"] . "\"");//商品描述


			//自定义订单号，此处仅作举例
			$timeStamp = time();
			$unifiedOrder->setParameter("out_trade_no","$out_trade_no");//商户订单号 
			$unifiedOrder->setParameter("total_fee",$price*100);//总金额
			//$unifiedOrder->setParameter("total_fee",1);//总金额
			$unifiedOrder->setParameter("notify_url",$GLOBALS["WxPayConf"]["NOTIFY_URL"]);//通知地址 
			$unifiedOrder->setParameter("trade_type","JSAPI");//交易类型

			$prepay_id = $unifiedOrder->getPrepayId();
			//=========步骤3：使用jsapi调起支付============
			$jsApi->setPrepayId($prepay_id);

			$jsApiParameters = $jsApi->getParameters();
			$t = json_decode($jsApiParameters , true);
		
			$result = array();
			$result["unifiedOrder"]=$unifiedOrder->parameters;
			$result["data"] = $jsApiParameters;
			$result["orderno"] = $out_trade_no;
			echo json_encode($result);
			break;
		case "updatepaystatus":
			$orderNo = Get("orderno");
			$courseinfoid = Get("courseinfoid");//课程报名详情数据id
			$commodityinfoid = Get("commodityinfoid");//
			$noteid = Get("noteid");
			DBBeginTrans();
			if($commodityinfoid!=""){
				$commodityInfodetail = DBGetDataRowByField("custcommodityorders","id",$commodityinfoid);
				$commodityid = $commodityInfodetail["commodityid"];
				$score = $commodityInfodetail["score"];
				$commodityInfo = DBGetDataRowByField("commodity","id",$commodityid);//兑换商品信息
				$type = $commodityInfo["type"];
				switch($type){
					case 90://限量虚拟商品
						$codeInfo = DBGetDataRowByFieldForUpdate("commoditycodes",array("commodityid","isgot"),array($commodityid,0));
						
						$fid = DBUpdateField("commoditycodes" , $codeInfo["id"] , array("isgot","gottime","gotcust") ,array(1,$DB_FUNCTIONS["now"],$_SESSION["userid"]));
						if(!$fid)
							AjaxRollBack("-1");
						break;
				}
	//用户积分变动明细数据		
				$arrFields = array("custid","changetype","beforescore","changescore","afterscore","reason","operattime");
				$arrValues = array($_SESSION["userid"],-1,$custInfo["score"],$score,$custInfo["score"]-$score,'积分兑换'.$commodityInfo["name"],$DB_FUNCTIONS["now"]);
				$r = DBInsertTableField("custscorehistory" , $arrFields ,$arrValues);
				if($r<=0)
					AjaxRollBack("-8");
	//更新用户表可用积分
				$r = DBUpdateField("custinfo" , $_SESSION["userid"] , array("score") ,array($custInfo["score"]-$score));
				if(!$r)
					AjaxRollBack("-9");
				$strSql = " Update commodity Set count = count-1 Where id = $commodityid ";//更新库存
				if(!DBExecute($strSql))
					AjaxRollBack("-1");
				$r = DBUpdateField("custcommodityorders" , $commodityinfoid , array("status","ordertime") ,array(4,$DB_FUNCTIONS["now"]));
				if(!$r)
					AjaxRollBack("-2");
			}
			if($courseinfoid!=""){
				$coursedetailInfo = DBGetDataRowByField("custlessonorders","id",$courseinfoid);
				$courseid=$coursedetailInfo["lessonid"];
				$score=$coursedetailInfo["score"];
				$courseInfo = DBGetDataRowByField("lessoninfos","id",$courseid);
				$custInfo = DBGetDataRowByField("custinfo","id",$_SESSION["userid"]);
				$arrFields = array("custid","changetype","beforescore","changescore","afterscore","reason","signupid","operattime");
				if($noteid==""||$noteid==0){
					$signupscore=$courseInfo["orderscore"];
					if($_SESSION["inviter"]!=0){
						$inviterInfo = DBGetDataRowByField("custinfo","id",$_SESSION["inviter"]);
						$arrValues = array($_SESSION["inviter"],1,$inviterInfo["score"],$signupscore,$inviterInfo["score"]+$signupscore,'推介好友成功购买'.$courseInfo["title"].'课程',$_SESSION["userid"],$DB_FUNCTIONS["now"]);
					}
					$arrValuescust = array($_SESSION["userid"],-1,$custInfo["score"],$score,$custInfo["score"]-$score,'购买'.$courseInfo["title"].'课程抵扣',0,$DB_FUNCTIONS["now"]);
				}else{
					$contentdetailInfo = DBGetDataRowByField("sharecontent","id",$noteid);
					$signupscore=$coursedetailInfo["score"];
					if($_SESSION["inviter"]!=0){
						$arrValues = array($_SESSION["inviter"],1,$inviterInfo["score"],$signupscore,$inviterInfo["score"]+$signupscore,'邀请好友进入课程帖子'.$contentdetailInfo["title"].'成功报名获得积分',$_SESSION["userid"],$DB_FUNCTIONS["now"]);
					}
					$arrValuescust = array($_SESSION["userid"],-1,$custInfo["score"],$score,$custInfo["score"]-$score,'通过好友邀请进入帖子'.$contentdetailInfo["title"].'购买课程抵扣',0,$DB_FUNCTIONS["now"]);
				}
				if($_SESSION["inviter"]!=0){
					$r = DBInsertTableField("custscorehistory" , $arrFields ,$arrValues);//
					if($r<=0)
						AjaxRollBack("-8");	
					$r = DBUpdateField("custinfo" , $_SESSION["inviter"] , array("isstudent","score") ,array(1,$inviterInfo["score"]+$signupscore));
					if(!$r)
						AjaxRollBack("-7");
				}
				$r = DBInsertTableField("custscorehistory" , $arrFields ,$arrValuescust);
				if($r<=0)
					AjaxRollBack("8");
				$r = DBUpdateField("custinfo" , $_SESSION["userid"] , array("isstudent","score") ,array(1,$custInfo["score"]-$score));
				if(!$r)
					AjaxRollBack("7");
				$strSql = " Update lessoninfos Set count = count-1 Where id = $courseid ";//更新库存
				if(!DBExecute($strSql))
					AjaxRollBack("-2");
				$r = DBUpdateField("custlessonorders" , $courseinfoid , array("inviter","status","ordertime") ,array($_SESSION["inviter"],2,$DB_FUNCTIONS["now"]));
				if(!$r)
					AjaxRollBack("-1");
			}
			$data = DBGetDataRowByField("orderlist","out_trade_no",$orderNo);
			if($data != null){
				$r=DBUpdateField("orderlist",$data["id"],"paystatus",1);
				if(!$r)
				AjaxRollBack("-2");
			}
			DBCommitTrans();
			echo 1;
			break;
	
	}
?>