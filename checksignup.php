<?php
	include "paras.php";
	$salerOpenId = Get("wang");
	if($salerOpenId == ""){
		$salerOpenId = InitOpenid();
	}

	$infoId = Get("id");
	$p = Get("p");
	$noteid = Get("noteid");
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
		<title>至美教育线下报名</title>
		<link href="style/bootstrap.css" rel="stylesheet"/>
		<link href="style/style.css" rel="stylesheet"/>
		<link href="js/craftpip/css/jquery-confirm.css" rel="stylesheet"/>
		<style>
			.row{
				margin-bottom: 0px !important;
				color: #777;
				padding: 5px !important;
			}
		</style>
	<body>
		<div style="background-color:#337ab7;color:white;font-size:24px;text-align:center;line-height:40px;padding:5px;">
			至美教育线下报名
		</div>
		<div id="checksignupContent" class="container text-center hidden" style="margin-top:20px;">
			<div class="text-center">
				<div>
					<img style="width:50px;height:50px;" src="" id="UserHead">
				</div>
				<p style="margin-top:10px;" id="UserName"></p>
				<div class="form-group form-group-sm row ShareInfo" style="margin-top:20px;">
					<label for="ShareName" class="col-xs-5 control-label colRight">分享者姓名:</label>
					<div class="col-xs-7 colLeft" style="color:black;">
						<p id="ShareName"></p>
					</div>
				</div>
				<div class="form-group form-group-sm row ShareInfo">
					<label for="ShareMobile" class="col-xs-5 control-label colRight">分享者手机号:</label>
					<div class="col-xs-7 colLeft" style="color:black;">
						<p id="ShareMobile"></p>
					</div>
				</div>
				<div class="form-group form-group-sm row">
					<label for="CourseName" class="col-xs-5 control-label colRight">课程名称:</label>
					<div class="col-xs-7 colLeft" style="color:black;">
						<p id="CourseName"></p>
					</div>
				</div>
				<div class="form-group form-group-sm row">
					<label for="CourseSchool" class="col-xs-5 control-label colRight">课程校区:</label>
					<div class="col-xs-7 colLeft" style="color:black;">
						<p id="CourseSchool"></p>
					</div>
				</div>
				<div class="form-group form-group-sm row">
					<label for="CourseType" class="col-xs-5 control-label colRight">课程类型:</label>
					<div class="col-xs-7 colLeft" style="color:black;">
						<p id="CourseType"></p>
					</div>
				</div>
				<div class="form-group form-group-sm row">
					<label for="CourseSpan" class="col-xs-5 control-label colRight">课程时长:</label>
					<div class="col-xs-7 colLeft" style="color:black;">
						<p id="CourseSpan"></p>
					</div>
				</div>
				<div class="form-group form-group-sm row">
					<label for="CourseTimeinfo" class="col-xs-5 control-label colRight">课程时间:</label>
					<div class="col-xs-7 colLeft" style="color:black;">
						<p id="CourseTimeinfo"></p>
					</div>
				</div>
				<!--
				<div class="form-group form-group-sm row">
					<label for="CourseStartTime" class="col-xs-5 control-label colRight">课程开始时间:</label>
					<div class="col-xs-7 colLeft" style="color:black;">
						<p id="CourseStartTime"></p>
					</div>
				</div>
				<div class="form-group form-group-sm row">
					<label for="CourseEndTime" class="col-xs-5 control-label colRight">课程结束时间:</label>
					<div class="col-xs-7 colLeft" style="color:black;">
						<p id="CourseEndTime"></p>
					</div>
				</div>-->
				<div class="form-group form-group-sm row">
					<label for="CoursePrice" class="col-xs-5 control-label colRight">价格:</label>
					<div class="col-xs-7 colLeft" style="color:black;">
						<p id="CoursePrice"></p>
					</div>
				</div>
				<div class="form-group form-group-sm row">
					<label for="CourseScore" class="col-xs-5 control-label colRight">积分:</label>
					<div class="col-xs-7 colLeft" style="color:black;">
						<p id="CourseScore"></p>
					</div>
				</div>
				<div class="form-group form-group-sm" style="margin-top:25px;">
					<button id="SignupBtn"  class="btn btn-primary  btn-block">报名</button>
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
		var noteid = "<?php echo $noteid; ?>";
	
		window.onload = OnLoad;
		function OnLoad(){
			url = "checksignup.ajax.php?mode=ShowSignUpInfo";
			$.post(url,{
				checktoken : token,
				checksalerid : salerId,
				courseinfoid : infoId
			},function(json,status){
				json = eval("("+json+")");
				// console.log(json);
				if(json == "1" || json == "2"){
					CommonJustTip('您不是销售人员，没有此权限！');
					return;
				}
				if(json == "-99"){
					CommonJustTip('课程校区与销售人员校区不一致，不可以报名！');
					return;
				}
				$("#checksignupContent").removeClass("hidden");
				
				switch(json.span){
					case "10":
						var span = "2周";
						break;
					case "20":
						var span = "1个月";
						break;
					case "30":
						var span = "2个月";
						break;
					case "40":
						var span = "3个月";
						break;
					case "50":
						var span = "6个月";
						break;
					case "60":
						var span = "12个月";
						break;
				}
				
				$("#UserHead").attr("src",json.imgurl);
				$("#UserName").text(json.nickname);
				$("#ShareName").text(json.invitername);
				$("#ShareMobile").text(json.invitermobile);
				$("#CourseName").text(json.title);
				$("#CourseSchool").text(json.schoolname);
				$("#CourseType").text(json.coursetype);
				$("#CourseTimeinfo").text(json.timerinfo);
				$("#CourseSpan").text(span);
				
				if(json.invitername == null || json.invitername == ""){
					$(".ShareInfo").addClass("hidden");
				}
				
				// var timefrom = json.timefrom.slice(11,19);
				// var timeto = json.timeto.slice(11,19);
				
				// $("#CourseStartTime").text(timefrom);
				// $("#CourseEndTime").text(timeto);
				$("#CoursePrice").text(json.price);
				$("#CourseScore").text(json.score);
				
				Settings.ConfirmInfo = "您确认报名课程为"+json.title+";";
				Settings.ConfirmInfo+= "本次报名需支付费用"+json.price+"元，并扣除"+json.score+"积分";
			});
			
			$("#SignupBtn").mousedown(function(){
				// SubmitApply();
				ConfirmInfo();
			})
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
				content: '您确认该用户已支付所需费用？',
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
			url = "checksignup.ajax.php?mode=SignUpAddEdit";
			$.post(url,{
				checktoken : token,
				checksalerid : salerId,
				courseinfoid : infoId,
				noteid : noteid
			},function(json,status){
				console.log(json);
				// alert(json);
				if(json == 1){
					CommonJustTip('您已成功报名！');
				}else if(json == -99){
					CommonJustTip('您的积分不足！');
				}else
					CommonJustTip('服务器忙，请稍候再试。');
			});
		}

   </script>
</html>