<?php
	// include "paras.php";
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-7">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<title>至美教育会员商城系统</title>
		<link href="style/bootstrap.css" rel="stylesheet"/>
		<link href="style/style.css" rel="stylesheet"/>
		<link href="js/craftpip/css/jquery-confirm.css" rel="stylesheet"/>
	</head>
	<body>
		<div class="row" style="background-color:#337ab7;color:white;font-size:24px;text-align:center;line-height:50px;">
			至美教育会员账号注册
		</div>
		<div class="container" style="margin-top:50px;">
			<div class="text-right">
				<div class="form-group">
					<label for="registUser" class="col-xs-5 control-label">姓名:</label>
					<div class="col-xs-7">
						<input type="text" class="form-control" id="registUser">
					</div>
				</div></br></br></br>
				<div class="form-group">
					<label for="registMobile" class="col-xs-5 control-label">手机号:</label>
					<div class="col-xs-7">
						<input type="number" class="form-control" id="registMobile">
					</div>
				</div></br></br>
				<div class="form-group">
					<label for="registArea" class="col-xs-5 control-label">是否就读</label>
					<div class="col-xs-7">
						<select class="form-control" id="registStudent">
							<option value="1">孩子在吉的堡就读</option>
							<option value="0">孩子不在吉的堡就读</option>
						</select>
					</div>
				</div></br></br>
				<div class="form-group">
					<label id="registSchoolLable" for="registSchool" class="col-xs-5 control-label">就读校区:</label>
					<div class="col-xs-7">
						<select class="form-control" id="registSchool"></select>
					</div>
				</div></br></br>
				<div class="form-group">
					<label for="registClass" class="col-xs-5 control-label">就读吉的堡班级:</label>
					<div class="col-xs-7">
						<input type="text" class="form-control" id="registClass">
					</div>
				</div></br></br>
				<div class="form-group">
					<label for="registAge" class="col-xs-5 control-label">孩子年龄:</label>
					<div class="col-xs-7">
						<select class="form-control" id="registAge">
							<option value="3">小于3岁</option>
							<option value="4">4岁</option>
							<option value="5">5岁</option>
							<option value="6">6岁</option>
							<option value="7">7岁</option>
							<option value="8">8岁</option>
							<option value="9">9岁</option>
							<option value="10">10岁</option>
							<option value="11">11岁</option>
							<option value="12">12岁</option>
							<option value="13">13岁</option>
							<option value="14">14岁</option>
							<option value="15">大于15岁</option>
						</select>
					</div>
				</div></br></br>
				<!--<div class="form-group">
					<label for="registArea" class="col-xs-5 control-label">区域:</label>
					<div class="col-xs-7">
						<select class="form-control" id="registArea"></select>
					</div>
				</div></br></br>-->
				<div class="form-group" style="margin-top:40px;">
					<button id="registBtn"  class="btn btn-primary btn-block">注册</button>
				</div>
			</div>
		</div>
	</body>
	<?php	include "u.footer.php";	?>
	<script type="text/javascript">
		var Settings = {};
	
		window.onload = OnLoad;
		
		function OnLoad(){
			BindEvents();
			// ShowAreaList();
			ShowSchoolList();
		}
		function BindEvents(){
			$("#registStudent").click(function(){
				var Isstudent = $("#registStudent").val();
				if(Isstudent == "1"){
                    $("#registSchoolLable").html("就读校区:");
                    $("#registClass").removeAttr("disabled");
				}else{
					$("#registSchoolLable").html("最近校区:");
					$("#registClass").attr("disabled","disabled");
					$("#registClass").val("");
				}
			})
			
			// $("#registBtn").click(function(){
			$("#registBtn").mousedown(function(){
				name = $("#registUser").val();
				mobile = $("#registMobile").val();
				isread = $("#registStudent").val();
				// area = $("#registArea").val();
				school = $("#registSchool").val();
				grade = $("#registClass").val();
				age = $("#registAge").val();
				
				if(name == ""){
					CommonJustTip('姓名不能为空！');
					return;
				}
				if(mobile == ""){
					CommonJustTip('手机号不能为空！');
					return;
				}
				if(!(/^1[3|4|5|7|8]\d{9}$/.test(mobile))){
					CommonJustTip('手机号码格式有误。');
					return;
				}
				
				url = "u.regist.ajax.php?mode=RegistInfo";
				$.post(url,{
					name : name,
					mobile : mobile,
					isread : isread,
					school : school,
					grade : grade,
					age : age
				},function(json,status){
					console.log(json);
					switch(json){
						case "1":
							window.location.href = "u.my.php";
							break;
						case "-9":
							CommonJustTip('该手机号已经注册会员了。');
							break;
						default:
							CommonJustTip('服务器忙，请稍候再试。');
							break;
					}
				});
				// window.location.href = "manager.php";
			});
		}
		function ShowSchoolList(){
			url = "u.regist.ajax.php?mode=ShowSchool";
			$.get(url,function(json,status){
				json = eval("("+json+")");
				console.log(json);
				for(var i=0;i<json.length;i++){		
					strTbody = '<option value="'+json[i].id+'">'+json[i].name+'</option>';
					$("#registSchool").append(strTbody);
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
					$("#registArea").append(strTbody);
				}
			});
		}
   </script> 
</html>