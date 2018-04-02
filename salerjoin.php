<?php
  	include "paras.php";
	
// $openId ="44";
// $nickname='昵称';
// $imgurl="image/a.png";
	$openId = Get("wang");
	$userInfo=null;
	if($openId == ""){
		$arrInfo = InitCustInfoV3();
		$openId = $arrInfo["openid"];
		$nickname=$arrInfo["nickname"];
		$imgurl=$arrInfo["headimgurl"];
	} else{
		$userInfo = DBGetDataRowByField("saler","openid",$openId);
		$nickname=$userInfo["nickname"];
		$imgurl=$userInfo["imgurl"];
	}
	if($userInfo == null){//没有进行查找
		$userInfo = DBGetDataRowByField("saler","openid",$openId);
	} 

	if($userInfo == null){//查找数据为空
		$userId = DBInsertTableField("saler",array("openid","nickname","imgurl","status"), array($openId,$nickname,$imgurl,-9));
		$hasReg = 0;
		$status = -9;
	} else {
		$userId = $userInfo["id"];
		$status = $userInfo["status"];
		if($userInfo["name"] == "")
			$hasReg = 0;
		else
			$hasReg = 1;
	}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<title>至美教育工作人员申请</title>
		<link href="style/bootstrap.css" rel="stylesheet"/>
		<link href="style/style.css" rel="stylesheet"/>
		<style>
			.row{
				margin-bottom: 0px !important;
				color: #777;
				padding: 20px !important;
			}
		</style>
	<body>
		<div style="background-color:#337ab7;color:white;font-size:24px;text-align:center;line-height:40px;padding:5px;">
			至美教育工作人员申请
		</div>
		<div class="container text-center" style="margin-top:20px;">
			<div class="text-center">
				<div class="form-group form-group-sm row">
					<label for="applyUser" class="col-xs-4 control-label colRight">姓名:</label>
					<div class="col-xs-8 colLeft">
						<input type="text" class="form-control" id="applyUser">
					</div>
				</div>
				<div class="form-group form-group-sm row">
					<label for="applyMobile" class="col-xs-4 control-label colRight">手机号:</label>
					<div class="col-xs-8">
						<input type="number" class="form-control" id="applyMobile">
					</div>
				</div>
				<!--<div class="form-group form-group-sm row">
					<label for="applyArea" class="col-xs-4 control-label colRight">区域:</label>
					<div class="col-xs-8">
						<select class="form-control" id="applyArea"></select>
					</div>
				</div>-->
				<div class="form-group form-group-sm row">
					<label for="applySchool" class="col-xs-4 control-label colRight">学校:</label>
					<div class="col-xs-8">
						<select class="form-control" id="applySchool"></select>
					</div>
				</div>
				<div class="form-group form-group-sm" style="margin-top:25px;">
					<button id="ApplyBtn"  class="btn btn-primary  btn-block">申请</button>
				</div>
			</div>
		</div>
	</body>
	<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
	<script src="js/jquery.common.js" charset="utf-8"></script>
	<script src="js/script.js" charset="utf-8"></script>
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript">
		var Settings = {};
		
		var openId = "<?php echo $openId; ?>";
		var userId = "<?php echo $userId; ?>";
		var status = "<?php echo $status; ?>";
		var hasReg = "<?php echo $hasReg; ?>";
	
		window.onload = OnLoad;
		function OnLoad(){
			BindEvents();
			ShowSchoolList();
			ShowAreaList();
		}
		function BindEvents(){
			if(hasReg != "0"){
				switch(status){
					case "-1":
						Message("您的申请已被驳回，您可以修改信息后重新提交申请。");
						break;
					case "0":
						MessageFix("您已经提交过申请，请等待审核。");
						break;
					case "1":
						MessageFix("您的申请已经通过。");
						break;
				}				
			}
			
			$("#ApplyBtn").click(function(){
				SubmitApply();
			})
		}
		
		function ShowSchoolList(){
			url = "u.regist.ajax.php?mode=ShowSchool";
			$.get(url,function(json,status){
				json = eval("("+json+")");
				console.log(json);
				for(var i=0;i<json.length;i++){		
					strTbody = '<option value="'+json[i].id+'">'+json[i].name+'</option>';
					$("#applySchool").append(strTbody);
				}
			});
		}
		function ShowAreaList(){
			url = "u.regist.ajax.php?mode=ShowArea";
			$.get(url,function(json,status){
				json = eval("("+json+")");
				console.log(json);
				for(var i=0;i<json.length;i++){			
					strTbody = '<option value="'+json[i].id+'">'+json[i].name+'</option>';
					$("#applyArea").append(strTbody);
				}
			});
		}
			
		function SubmitApply(){
			var name = $("#applyUser").val();
			var mobile = $("#applyMobile").val();
			var area = $("#applyArea").val();
			var school = $("#applySchool").val();
			if(name == ""){
				Message("姓名不能为空！");
				return;
			}
			if(mobile == ""){
				Message("手机号不能为空！");
				return;
			}
			if(!(/^1[3|4|5|7|8]\d{9}$/.test(mobile))){  
				Message("手机号码格式有误。");
				return;
			}
			if($("#applySchool").val() == null){
				Message('学校不能为空！');
				return;
			}
			url = "salerjoin.ajax.php?mode=applysaler";
			$.post(url,{
				openid : openId ,
				name : name,
				mobile : mobile,
				area : area,
				school : school
			},function(json,status){
				console.log(json);
				switch (json){
					case "1":
						Message("您已成功提交申请，请等待审核。");
						break;
					default:
						Message("服务器忙，请稍候再试。");
						break;
				}
			});
		}

   </script>
</html>