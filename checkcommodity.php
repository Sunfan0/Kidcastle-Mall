<?php
	include "paras.php";
	$salerOpenId = Get("wang");
	if($salerOpenId == ""){
		$salerOpenId = InitOpenid();
	}

	$infoId = Get("id");
	$p = Get("p");
	//传递的二维码参数
	$salerInfo = DBGetDataRowByField("saler","openid",$salerOpenId);//是否是销售人员
	if($salerInfo == null || $salerInfo["status"] != 1)
		die("-1");
//审批通过的销售人员

	$salerId=$salerInfo["id"];//销售人员id
	$salerstropenid= substr($salerOpenId, 0, 10);
	$salerstrnow = date("YmdHi", time());
	$token = md5($salerId.$salerstropenid.$salerstrnow);
	//销售人员的验证参数

	$userinfo = DBGetDataRowByField("custinfo","openid",$_SESSION["openid"]);
	if($userinfo == null)
		die("-2");

	$useropenid=$userinfo["openid"];
	$stropenid = substr($useropenid, 0, 10);
	$hasflag=0;
	for($i=0;$i<11;$i++){//10分钟之内
		$strnow = date("YmdHi", time()-60*$i);
		$codepara = md5($userinfo["id"].$stropenid.$strnow);
		$codepara = substr($codepara, 0, 10);

		if($p==$codepara){//二维码参数和用户数据库数据符合
			$hasflag=1;
			break;
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<title>至美教育商品领取</title>
		<link href="style/bootstrap.css" rel="stylesheet"/>
		<link href="style/style.css" rel="stylesheet"/>
		<link href="js/craftpip/css/jquery-confirm.css" rel="stylesheet"/>
		<style>
			.row{
				margin-bottom: 0px !important;
				color: #777;
				padding: 5px !important;
			}
			.FooterText{
				display: none !important;
			}
		</style>
	<body>
		<div style="position:fixed;bottom:20px;left:35%;">
			<!--<a style="color: gray;text-decoration:underline;" href='http://wsestar.com/' target='_blank'>技术支持：西安传睿</a>-->
			<a style="color: gray;" href='http://wsestar.com/' target='_blank'>技术支持：西安传睿</a>
		</div>
		<div style="background-color:#337ab7;color:white;font-size:24px;text-align:center;line-height:40px;padding:5px;">
			至美教育商品领取
		</div>
		<div class="container text-center" style="margin-top:20px;">	
			<div class="text-center">
				<div class="form-group form-group-sm row">
					<label for="ReceiveUser" class="col-xs-5 control-label colRight">姓名:</label>
					<div class="col-xs-7 colLeft" style="color:black;">
						<p id="ReceiveUser"></p>
					</div>
				</div>
				<div class="form-group form-group-sm row">
					<label for="ReceiveMobile" class="col-xs-5 control-label colRight">手机号:</label>
					<div class="col-xs-7 colLeft" style="color:black;">
						<p id="ReceiveMobile"></p>
					</div>
				</div>
				<div class="form-group form-group-sm row">
					<label for="ReceiveGoodsname" class="col-xs-5 control-label colRight">兑换商品名称:</label>
					<div class="col-xs-7 colLeft" style="color:black;">
						<p id="ReceiveGoodsname"></p>
					</div>
				</div>
				<div class="form-group form-group-sm row">
					<label for="ReceiveGoodsintegral" class="col-xs-5 control-label colRight">兑换所需积分:</label>
					<div class="col-xs-7 colLeft" style="color:black;">
						<p id="ReceiveGoodsintegral"></p>
					</div>
				</div>
				<div class="form-group form-group-sm row">
					<label for="ReceiveGoodsTime" class="col-xs-5 control-label colRight">兑换时间:</label>
					<div class="col-xs-7 colLeft" style="color:black;">
						<p id="ReceiveGoodsTime"></p>
					</div>
				</div>
				<div class="form-group form-group-sm row alreadyReceive">
					<label for="ReceiveScantime" class="col-xs-5 control-label colRight">领取时间:</label>
					<div class="col-xs-7 colLeft" style="color:black;">
						<p id="ReceiveScantime"></p>
					</div>
				</div>
				<div class="form-group form-group-sm row alreadyReceive">
					<label for="ReceiveAdminUser" class="col-xs-5 control-label colRight">核销人员姓名:</label>
					<div class="col-xs-7 colLeft" style="color:black;">
						<p id="ReceiveAdminUser"></p>
					</div>
				</div>
				<div class="form-group form-group-sm row alreadyReceive">
					<label for="ReceiveAdminMobile" class="col-xs-5 control-label colRight">核销人员手机号:</label>
					<div class="col-xs-7 colLeft" style="color:black;">
						<p id="ReceiveAdminMobile"></p>
					</div>
				</div>
				<!--<div class="form-group form-group-sm row alreadyReceive">
					<label for="ReceiveAdminArea" class="col-xs-5 control-label colRight">区域:</label>
					<div class="col-xs-7 colLeft" style="color:black;">
						<p id="ReceiveAdminArea"></p>
					</div>
				</div>-->
				<div class="form-group form-group-sm row alreadyReceive">
					<label for="ReceiveAdminSchool" class="col-xs-5 control-label colRight">学校:</label>
					<div class="col-xs-7 colLeft" style="color:black;">
						<p id="ReceiveAdminSchool"></p>
					</div>
				</div>
				<div class="form-group form-group-sm" style="margin-top:25px;">
					<button id="ReceiveBtn"  class="btn btn-primary btn-block">确认领取</button>
				</div>
			</div>
		</div>
	</body>
	<?php	include "u.footer.php";	?>
	<script type="text/javascript">
		var Settings = {};
		Settings.ConfirmInfo = "";
		
		var token = "<?php echo $token; ?>";
		var salerId = "<?php echo $salerId; ?>";
		var infoId = "<?php echo $infoId; ?>";
		
		// var token = "1";
		// var salerId = "5";
		// var infoId = "5";

	
		window.onload = OnLoad;
		function OnLoad(){			
			$(".alreadyReceive").addClass("hidden");
			$("#ReceiveBtn").removeClass("disabled").text("确认领取");
			
			Showuserinfo();
			
			$("#ReceiveBtn").mousedown(function(){
				// SubmitApply();
				ConfirmInfo();
			}) 
		}
		function Showuserinfo(){
			url = "checkcommodity.ajax.php?mode=showuserinfo";
			$.post(url,{
				checktoken : token,
				checksalerid : salerId,
				id : infoId
			},function(json,status){
				json = eval("("+json+")");
				// console.log(json);
				// alert(json);
				if(json.status == "5"){
					$(".alreadyReceive").removeClass("hidden");
					$("#ReceiveBtn").addClass("disabled").text("已领取");
				}else{
					$(".alreadyReceive").addClass("hidden");
					$("#ReceiveBtn").removeClass("disabled").text("确认领取");
				}
			
				$("#ReceiveUser").text(json.custname);
				$("#ReceiveMobile").text(json.custmobile);
				$("#ReceiveGoodsname").text(json.goodsname);
				// $("#ReceiveGoodsintegral").text(json.custscore);//用户当前积分
				$("#ReceiveGoodsintegral").text(json.score);
				$("#ReceiveGoodsTime").text(json.ordertime);
				$("#ReceiveScantime").text(json.scantime);
				$("#ReceiveAdminUser").text(json.salername);
				$("#ReceiveAdminMobile").text(json.salermobile);
				// $("#ReceiveAdminArea").text(json.salerarea);
				$("#ReceiveAdminSchool").text(json.salerschool);
				
				Settings.ConfirmInfo = "您确认为用户"+json.custname+"领取"+json.goodsname+"?";
				Settings.ConfirmInfo+= "本次领取将扣除"+json.score+"积分";
			});
		}
		
		function ConfirmInfo(){
			$.confirm({
				title: '确认信息',
				content: Settings.ConfirmInfo,
				confirmButton: '确定',
				cancelButton: '取消',
				// cancel: function(){
					// $.alert('canceled');
				// },
				confirm: function(){
					ConfirmAgain();
				}
			});
		}
		function ConfirmAgain(){
			$.confirm({
				title: '提示',
				content: '您确认领取？',
				confirmButton: '确定',
				cancelButton: '取消',
				// cancel: function(){
					// $.alert('canceled');
				// },
				confirm: function(){
					SubmitApply();
				}
			});
		}
		
		function SubmitApply(){
			url = "checkcommodity.ajax.php?mode=comfirmsale";
			$.post(url,{
				checktoken : token,
				checksalerid : salerId,
				id : infoId 
			},function(json,status){
				console.log(json);
				switch (json){
					case "1":
						Showuserinfo();
						break;
					default:
						CommonJustTip('服务器忙，请稍候再试。');
						break;
				}
			});
		}

   </script>
</html>