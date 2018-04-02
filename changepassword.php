<?php include "header.php";?>

		<div class="container" style="margin-top:50px;width:600px;">
			<form class="form-horizontal">
				<div class="form-group">
					<label class="col-sm-2 control-label">当前账号</label>
					<div class="col-sm-10"><?=$_SESSION["uname"]?></div>
				</div>
				<div class="form-group">
					<label for="currentPassword" class="col-sm-2 control-label">原密码</label>
					<div class="col-sm-10">
						<input type="password" class="form-control" id="currentPassword" placeholder="请输入原密码">
					</div>
				</div>
				<div class="form-group">
					<label for="changePassword1" class="col-sm-2 control-label">新密码</label>
					<div class="col-sm-10">
						<input type="password" class="form-control" id="changePassword1" placeholder="请输入新密码">
					</div>
				</div>
				<div class="form-group">
					<label for="changePassword2" class="col-sm-2 control-label">确认密码</label>
					<div class="col-sm-10">
						<input type="password" class="form-control" id="changePassword2" placeholder="请再次输入新密码">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-2"></div>
					<div class="col-sm-10">
						<button onclick="SaveInfo()" type="button" class="btn btn-primary">确定</button>  
					</div>
				</div>
			</form>
		</div>
	</body>
	<?php	include "footer.php";	?>
	<script type="text/javascript">
		var Settings = {};
	
		window.onload = OnLoad;
		
		function OnLoad(){
			BindEvents();
		}
		function BindEvents(){
			$('#ChangePrompt').modal({backdrop: 'static', keyboard: false});
		}

		function SaveInfo(){
			if($("#currentPassword").val() == ""){
				CommonWarning('原始密码不能为空。');
				return;
			}
			if($("#changePassword1").val() == ""){
				CommonWarning('新密码不能为空。');
				return;
			}
			if($("#changePassword1").val() != $("#changePassword2").val()){
				CommonWarning('两次输入的新密码不一致。');
				return;
			}
			
			$.post("changepassword.php?mode=ChangePassword&oldPassword="+md5($("#currentPassword").val())+"&newPassword="+md5($("#changePassword1").val()),function(json){
				console.log(json);
				switch(json){
					case "1":
						CommonJustTip('密码修改成功。');
						break;
					case "-9":
						CommonWarning('原密码错误。');
						break;
					case "-8":
						CommonWarning('登陆信息丢失，请重新登陆。');
						window.location.href = "login.php";
						break;
					default:
						CommonWarning('更新失败。');
						break;
				}
			})
		}
   </script> 
</html>