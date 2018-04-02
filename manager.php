<?php	include "header.php";	?>

		<div id="Maincontainer" class="container" style="margin-top:30px;">
			<nav class="navbar navbar-default" role="navigation">
				<div class="container-fluid">
					<form class="navbar-form navbar-right col-sm-3" role="search">
						<button class="btn btn-primary text-right" onclick="AddInfo(); return false;">+ 新增账号</button>
					</form>
				</div>
			</nav>
			<table id="ContentTable" class="table table-hover table-bordered"></table>
			<div class="modal fade" id="BackgroundInfo">  
			  <div class="modal-dialog">  
				<div class="modal-content message_align">  
				  <div class="modal-header">  
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>  
					<h5 id="addTitle" class="modal-title">修改信息</h5>  
				  </div>  
				  <div class="modal-body text-center"> 
					  <form class="form-horizontal">
						<div class="form-group">
							<label for="BackgroundAccount" class="col-sm-2 control-label">账号</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="BackgroundAccount" placeholder="用户名">
							</div>
						</div>
						<div class="form-group">
							<label for="BackgroundName" class="col-sm-2 control-label">姓名</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="BackgroundName" placeholder="姓名">
							</div>
						</div>
						<div class="form-group">
							<label for="BackgroundSchool" class="col-sm-2 control-label">校区</label>
							<div class="col-sm-10">
								<select class="form-control" id="BackgroundSchool">
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">权限</label>
							<div class="col-sm-10">
								<div class="checkbox" style="text-align:left;">
									<label class="checkbox">
										<input type="checkbox" id="BackgroundPower1" value="管理后台账号">管理后台账号
									</label>
									<label class="checkbox">
										<input type="checkbox" id="BackgroundPower2" value="管理审核人员">管理审核人员
									</label>
									<label class="checkbox">
										<input type="checkbox" id="BackgroundPower3" value="管理课程">管理课程
									</label>
									<label class="checkbox">
										<input type="checkbox" id="BackgroundPower4" value="管理商品">管理商品
									</label>
									<label class="checkbox">
										<input type="checkbox" id="BackgroundPower10" value="查看注册会员">查看注册会员
									</label>
									<label class="checkbox">
										<input type="checkbox" id="BackgroundPower5" value="查看报名学员">查看报名学员
									</label>
									<label class="checkbox">
										<input type="checkbox" id="BackgroundPower6" value="查看商品兑换">查看商品兑换
									</label>
									<label class="checkbox">
										<input type="checkbox" id="BackgroundPower7" value="管理代言人">管理代言人
									</label>
									<label class="checkbox">
										<input type="checkbox" id="BackgroundPower11" value="积分管理">积分管理
									</label>
									<label class="checkbox">
										<input type="checkbox" id="BackgroundPower8" value="管理代言规则">管理代言规则
									</label>
									<label class="checkbox">
										<input type="checkbox" id="BackgroundPower9" value="查看积分详情">查看积分详情
									</label>
									
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="BackgroundPassword1" class="col-sm-2 control-label">密码</label>
							<div class="col-sm-10">
								<input type="password" class="form-control" id="BackgroundPassword1" placeholder="密码">
							</div>
						</div>
						<div class="form-group">
							<label for="BackgroundPassword2" class="col-sm-2 control-label">确认密码</label>
							<div class="col-sm-10">
								<input type="password" class="form-control" id="BackgroundPassword2" placeholder="密码">
							</div>
						</div>
					</form>
				  </div>  
				  <div class="modal-footer">
					<button id="BackgroundDeletInfo" onclick="DeletInfo()" style="margin-right:380px;" type="button" class="btn btn-danger">删除</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>  
					<a  onclick="SaveInfo()" class="btn btn-success">保存</a>  
				  </div>  
				</div>
			  </div>
			</div>
		</div>
	</body>
	<?php	include "footer.php";	?>
	<script type="text/javascript">
		var Settings = {};
	
		window.onload = OnLoad;
		
		function OnLoad(){
			BindEvents();
			ShowSchoolList();
			ShowBackgroundList();
		}
		function BindEvents(){
			
		}

		function ShowBackgroundList(){
			Settings.loginName = new Array();
			$("#ContentTable").html("");
			Settings.ListName = "background";
			strTable = "<thead><tr><th>ID</th><th>账号</th><th>姓名</th><th>学校</th><th>权限</th><th>操作</th></tr></thead><tbody id='contentTbody'></tbody>"	
			$("#ContentTable").append(strTable);
			url = "manager.ajax.php?mode=ShowAllBgmanager";
			$.get(url,function(json,status){
				if(json=="123"){
					CommonNopower();
					$("#Maincontainer").addClass("hidden");
					return;
				}
				if(json=="null"){
					CommonJustTip('暂无数据。');
					return;
				}
				json = eval("("+json+")");
				console.log(json);
				for(var i=0;i<json.length;i++){	
					rights = eval("("+json[i].rights+")");
					var power = "";
					if(rights.bgmanager == "1"){
						power += $("#BackgroundPower1").val()+";"; 
					}
					if(rights.bgsaler == "1"){
						power += $("#BackgroundPower2").val()+";"; 
					}
					if(rights.bgcourse == "1"){
						power += $("#BackgroundPower3").val()+";"; 
					}
					if(rights.bgcommodity == "1"){
						power += $("#BackgroundPower4").val()+";"; 
					}
					if(rights.bgstudent == "1"){
						power += $("#BackgroundPower5").val()+";"; 
					}
					if(rights.viewcommoditygot == "1"){
						power += $("#BackgroundPower6").val()+";"; 
					}
					if(rights.bgspokesman == "1"){
						power += $("#BackgroundPower7").val()+";"; 
					}
					if(rights.bgscorerule == "1"){
						power += $("#BackgroundPower8").val()+";"; 
					}
					if(rights.bgscoredetail == "1"){
						power += $("#BackgroundPower9").val()+";"; 
					}
					if(rights.bgregister == "1"){
						power += $("#BackgroundPower10").val()+";"; 
					}
					if(rights.bgscorechange == "1"){
						power += $("#BackgroundPower11").val()+";"; 
					}

					Settings.loginName.push(json[i].loginname);
					
					var name = json[i].name;
					var school = json[i].school;
					if(json[i].name == "" || json[i].name == null){name = "---";}
					if(json[i].school == "" || json[i].school == null){school = "---";}
					
					strTbody = '<tr id="'+Settings.ListName+''+(i+1)+'" onclick="ModifyInfo('+json[i].id+')"><td>'+(i+1)+'</td><td class="account">'+json[i].loginname+'</td><td>'+name+'</td><td>'+school+'</td><td class="power">'+power+'</td>';
					strTbody += '<td><button class="btn btn-primary btn-sm">编辑</button></td></tr>';
					$("#contentTbody").append(strTbody);
				}
			});
		}
		function ModifyInfo(id){
			Settings.EditState = "modify";
			Settings.ModifyInfoId = id;
			$('#addTitle').text("修改信息");
			$('#BackgroundPassword1,#BackgroundPassword2').attr("placeholder","如果需要修改密码，请填写新密码，否则请留空");
			$('[id^="BackgroundPower"]').prop("checked", false);
			$("#BackgroundAccount,#BackgroundName,#BackgroundSchool,#BackgroundPassword1,#BackgroundPassword2").val("");
			$('#BackgroundInfo').modal({backdrop: 'static', keyboard: false});
			$("#BackgroundAccount").attr("readonly","readonly");
			url = "manager.ajax.php?mode=ShowOneBgmanager&id="+Settings.ModifyInfoId;
			$.get(url,function(json,status){
				json = eval("("+json+")");
				rights = eval("("+json.rights+")");
				console.log(json);
				$("#BackgroundAccount").val(json.loginname);		
				$("#BackgroundName").val(json.name);
				$("#BackgroundSchool").val(json.school);				
				if(rights.bgmanager == "1"){$("#BackgroundPower1").prop("checked", true);}
				if(rights.bgsaler == "1"){$("#BackgroundPower2").prop("checked", true);}
				if(rights.bgcourse == "1"){$("#BackgroundPower3").prop("checked", true);}
				if(rights.bgcommodity == "1"){$("#BackgroundPower4").prop("checked", true);}
				if(rights.bgstudent == "1"){$("#BackgroundPower5").prop("checked", true);}
				if(rights.viewcommoditygot == "1"){$("#BackgroundPower6").prop("checked", true);}
				if(rights.bgspokesman == "1"){$("#BackgroundPower7").prop("checked", true);}
				if(rights.bgscorerule == "1"){$("#BackgroundPower8").prop("checked", true);}
				if(rights.bgscoredetail == "1"){$("#BackgroundPower9").prop("checked", true);}
				if(rights.bgregister == "1"){$("#BackgroundPower10").prop("checked", true);}
				if(rights.bgscorechange == "1"){$("#BackgroundPower11").prop("checked", true);}
			});
			// var power= "1,2,5";
			// var powerData = power.split(",");
			// for(i=0;i<powerData.length;i++){
				// $("#BackgroundPower"+powerData[i]).prop("checked", true);
			// }
			$("#BackgroundDeletInfo").css('display',''); 
		}
		function AddInfo(){
			Settings.EditState = "add";
			$('#addTitle').text("填写信息");
			$('#BackgroundPassword1,#BackgroundPassword2').attr("placeholder","密码");
			$('[id^="BackgroundPower"]').prop("checked", false);
			$("#BackgroundAccount,#BackgroundName,#BackgroundSchool,#BackgroundPassword1,#BackgroundPassword2").val("");
			// $('#BackgroundInfo').modal('toggle');
			$('#BackgroundInfo').modal({backdrop: 'static', keyboard: false});
			$("#BackgroundDeletInfo").css('display','none'); 
			$("#BackgroundAccount").removeAttr("readonly");
		}
		function DeletInfo(){
			$.confirm({
				title: '提示',
				content: '您确定删除该账号？',
				confirmButton: '确定',
				cancelButton: '取消',
				confirm: function(){
					url = "manager.ajax.php?mode=DeleteBgmanager&id="+Settings.ModifyInfoId;
					$.get(url,function(json,status){
						console.log(json);
						switch (json){
							case "1":
								ShowBackgroundList();
								$('#BackgroundInfo').modal('toggle');
								break;
							default:
								CommonWarning("服务器忙，请稍候再试。");
								break;
						}
					});
				},
				cancel: function(){
					return;
				}
			});
		}	
				
		function SaveInfo(){
			var account = $("#BackgroundAccount").val();
			var name = $("#BackgroundName").val();
			var school = $('#BackgroundSchool option:selected') .val();
			var flagid = "";
			var power = "";
			var bgmanager = 0;
			var bgsaler = 0;
			var bgcourse = 0;
			var bgcommodity = 0;
			var bgstudent = 0;
			var viewcommoditygot = 0;
			var bgspokesman = 0;
			var bgscorerule = 0;
			var bgscoredetail = 0;
			var bgregister = 0;
			var bgscorechange = 0;
			
			var password1 = $("#BackgroundPassword1").val();
			var password2 = $("#BackgroundPassword2").val();
			for(i=1;i<=11;i++){
				var powerChecked = $("#BackgroundPower"+i).is(":checked");
				if(powerChecked){
					power += $("#BackgroundPower"+i).val()+";"; 
					switch(i){
						case 1:
							bgmanager = 1;
							break;
						case 2:
							bgsaler = 1;
							break;
						case 3:
							bgcourse = 1;
							break;
						case 4:
							bgcommodity = 1;
							break;
						case 5:
							bgstudent = 1;
							break;
						case 6:
							viewcommoditygot = 1;
							break;
						case 7:
							bgspokesman = 1;
							break;
						case 8:
							bgscorerule = 1;
							break;
						case 9:
							bgscoredetail = 1;
							break;
						case 10:
							bgregister = 1;
							break;
						case 11:
							bgscorechange = 1;
							break;
					}
				}
			}
			if(school == undefined){
				CommonWarning('请选择校区！');
				return;
			}
			if(account == ""){
				CommonWarning('账号不能为空！');
				return;
			}
			if(power == ""){
				CommonWarning('权限不能为空！');
				return;
			}
			if(password1 != password2){
				CommonWarning('请确认两次输入的密码相同！');
				return;
			}
			if(Settings.EditState == "modify"){
				flagid = Settings.ModifyInfoId;
			}else{
				if(password1 == ""){
					CommonWarning('请设置密码！');
					return;
				}
			}
			if(Settings.EditState == "add"){				
				for(var l=0;l<Settings.loginName.length;l++){	
					if(account == Settings.loginName[l]){
						CommonWarning('该账号已被注册。');
						return;
					}
				}
			}
			url = "manager.ajax.php?mode=UpdateBgmanager";
			$.post(url, {
				flagid : flagid ,
				username : account ,
				name : name,
				school : school,
				password : md5(password1),
				bgmanager : bgmanager,
				bgsaler : bgsaler,
				bgcourse : bgcourse,
				bgcommodity : bgcommodity,
				bgstudent : bgstudent,
				viewcommoditygot : viewcommoditygot,
				bgspokesman : bgspokesman,
				bgscorerule : bgscorerule,
				bgscoredetail : bgscoredetail,
				bgregister : bgregister,
				bgscorechange : bgscorechange
			} ,function(json,status){
				switch (json){
					case "1":
						ShowBackgroundList();
						$('#BackgroundInfo').modal('toggle');
						break;
					default:
						CommonWarning("服务器忙，请稍候再试。");
				}
			});
		}
		function ShowSchoolList(){
			url = "manager.ajax.php?mode=ShowSchool";
			$.get(url,function(json,status){
				json = eval("("+json+")");
				console.log(json);
				for(var i=0;i<json.length;i++){			
					strTbody = '<option value="'+json[i].id+'">'+json[i].name+'</option>';
					$("#BackgroundSchool").append(strTbody);
				}
			});
		}
   </script> 
</html>