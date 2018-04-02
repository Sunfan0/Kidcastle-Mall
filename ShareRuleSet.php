<?php	include "header.php";	?>

		<div id="Maincontainer" class="container" style="margin-top:50px;width:600px;">
			<form class="form-horizontal">
				<div class="form-group">
					<label class="col-sm-6 control-label">分享获得积分</label>
					<div class="col-sm-6">
						<input type="hidden" id="shareid" class="form-control">
						<input type="text" id="sharescore" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-6 control-label">每日分享获得积分上限次数</label>
					<div class="col-sm-6">
						<input type="text" id="sharescorenum" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-6 control-label">邀请点击获得积分</label>
					<div class="col-sm-6">
						<input type="text" id="clickscore" class="form-control"> 
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-6 control-label">每日邀请点击获得积分上限次数</label>
					<div class="col-sm-6">
						<input type="text" id="clickscorenum" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-6 control-label">邀请购买获得积分</label>
					<div class="col-sm-6">
						<input type="text" id="signupscore" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-6"></div>
					<div class="col-sm-6">
						<button id="btnUpdate" type="button" class="btn btn-primary">更新</button>  
					</div>
				</div>
			</form>
		</div>
		<!--
		<div  class="float fullScreen" style="overflow:hidden;">
			<table width="80%" class="pure-table pure-table-bordered" align="center">
	
					<tr>
						<td colspan="2" align="center">
							积分类别设置
						</td>
					</tr>
				<tr>
					<td>分享获得积分</td>
					<td>
						<input type="hidden" id="shareid">
						<input type="text" id="sharescore">
					</td>
				</tr>
				<tr>
					<td>每日分享获得积分上限次数</td>
					<td>
						<input type="text" id="sharescorenum">
					</td>
				</tr>
				<tr>
					<td>邀请点击获得积分</td>
					<td>
						<input type="text" id="clickscore">
					</td>
				</tr>
				<tr>
					<td>每日邀请点击获得积分上限次数</td>
					<td>
						<input type="text" id="clickscorenum">
					</td>
				</tr>
				<tr>
					<td>邀请购买获得积分</td>
					<td>
						<input type="text" id="signupscore">
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<input type="button" id="btnUpdate" class="pure-button pure-button-primary " value="更新">
					</td>
				</tr>
			</table>
		</div>-->
	</body>
	<?php	include "footer.php";	?>
	<SCRIPT type="text/javascript">
		window.onload = function(){
			BindEvents();
			ShowList();
		}
	
		function BindEvents(){
			$("#btnUpdate").click(function(){
				UpdateScoreType();
			});
		}
		function ShowList(){
			url = "ShareRuleSet.ajax.php?mode=ShowStandardScore";
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
				var data=eval("("+json+")");
				$("#shareid").val(data.id);
				$("#sharescore").val(data.sharescore);
				$("#sharescorenum").val(data.sharecount);
				$("#clickscore").val(data.clickscore);
				$("#clickscorenum").val(data.clickcount);
				$("#signupscore").val(data.signupscore);
			});
		}
		function UpdateScoreType(){
			shareid=$("#shareid").val();
			sharescore=$("#sharescore").val();
			sharescorenum=$("#sharescorenum").val();
			clickscore=$("#clickscore").val();
			clickscorenum=$("#clickscorenum").val();
			signupscore=$("#signupscore").val();
			url = "ShareRuleSet.ajax.php?";
			url += "mode=UpdateStandardScore";
			url += "&id=" + shareid;
			url += "&sharescore=" + sharescore;
			url += "&sharecount=" + sharescorenum;
			url += "&clickscore=" + clickscore;
			url += "&clickcount=" + clickscorenum;
			$.get(url,function(json,status){
				switch(json){
					case "1":
						Message("更新成功！");
						ShowList();
						break;
					case "-1":
						Message("系统繁忙！请稍后重试");
						break;
				}
			});

		}
	</script>
</html>