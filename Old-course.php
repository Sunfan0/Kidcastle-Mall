<?php	include "header.php";	?>

		<div class="container" style="margin-top:30px;">
			<nav class="navbar navbar-default" role="navigation">
				<div class="container-fluid">		
					<form class="navbar-form navbar-right col-sm-3" role="search">
						<button class="btn btn-primary text-right" onclick="AddInfo(); return false;">+ 新增课程</button>
					</form>							
				</div>
			</nav>
			<table id="ContentTable" class="table table-hover table-bordered"></table>
			<div class="modal fade" id="CourseInfo">  
			  <div class="modal-dialog" style="width:700px;">  
				<div class="modal-content message_align">  
				  <div class="modal-header">  
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>  
					<h5 id="addTitle" class="modal-title">修改信息</h5>  
				  </div>  
				  <div class="modal-body text-center">  
					<form class="form-horizontal">
						<div class="form-group">
							<label for="CourseName" class="col-sm-2 control-label">课程名称</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="CourseName">
							</div>
						</div>
						<div class="form-group">
							<label for="CourseDescribe" class="col-sm-2 control-label">简单描述</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="CourseDescribe">
							</div>
						</div>
						<div class="form-group">
							<label for="CourseDescription1" class="col-sm-2 control-label">详细描述1</label>
							<div class="col-sm-10">
								<!--<textarea id="CourseDescription1"  class="form-control" rows="3"></textarea>-->
								<button id="GoDescription1" class="btn btn-default  btn-block">︾&nbsp;&nbsp;&nbsp;展开</button>
								<div id="CourseDescription1" type="text/plain" style="margin-top:30px;width:550px;height:550px;display:none;"></div>
							</div>
						</div>
						<div class="form-group">
							<label for="CourseDescription2" class="col-sm-2 control-label">详细描述2</label>
							<div class="col-sm-10">
								<button id="GoDescription2" class="btn btn-default  btn-block">︾&nbsp;&nbsp;&nbsp;展开</button>
								<div id="CourseDescription2" type="text/plain" style="margin-top:30px;width:550px;height:550px;display:none;"></div>
							</div>
						</div>
						<div class="form-group">
							<label for="CourseDescription3" class="col-sm-2 control-label">详细描述3</label>
							<div class="col-sm-10">
								<button id="GoDescription3" class="btn btn-default  btn-block">︾&nbsp;&nbsp;&nbsp;展开</button>
								<div id="CourseDescription3" type="text/plain" style="margin-top:30px;width:550px;height:550px;display:none;"></div>
							</div>
						</div>
						<div class="form-group">
							<label for="CoursePrice1" class="col-sm-3 control-label">正常价格</label>
							<div class="col-sm-3">
								<input type="number" class="form-control" id="CoursePrice1">
							</div>
							<label for="CourseScore1" class="col-sm-3 control-label">正常积分</label>
							<div class="col-sm-3">
								<input type="number" class="form-control" id="CourseScore1">
							</div>
						</div>
						<div class="form-group">
							<label for="CoursePrice2" class="col-sm-3 control-label">续费折扣价格</label>
							<div class="col-sm-3">
								<input type="number" class="form-control" id="CoursePrice2">
							</div>
							<label for="CourseScore2" class="col-sm-3 control-label">续费折扣积分</label>
							<div class="col-sm-3">
								<input type="number" class="form-control" id="CourseScore2">
							</div>
						</div>
						<div class="form-group">
							<label for="CoursePrice3" class="col-sm-3 control-label">积分抵扣价格</label>
							<div class="col-sm-3">
								<input type="number" class="form-control" id="CoursePrice3">
							</div>
							<label for="CourseScore3" class="col-sm-3 control-label">积分抵扣积分</label>
							<div class="col-sm-3">
								<input type="number" class="form-control" id="CourseScore3">
							</div>
						</div>
						<div class="form-group">
							<label for="CourseSharescore" class="col-sm-5 control-label">成功分享链接获得积分</label>
							<div class="col-sm-7">
								<input type="number" class="form-control" id="CourseSharescore">
							</div>
						</div>
						<div class="form-group">
							<label for="CourseClickscore" class="col-sm-5 control-label">引导好友点击链接获得积分</label>
							<div class="col-sm-7">
								<input type="number" class="form-control" id="CourseClickscore">
							</div>
						</div>
						<div class="form-group">
							<label for="CourseOrderscore" class="col-sm-5 control-label">引导好友报名获得积分</label>
							<div class="col-sm-7">
								<input type="number" class="form-control" id="CourseOrderscore">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">上课时段</label>
							<div class="col-sm-10">
								<div class="checkbox" style="text-align:left;">
									<select id="CourseSpan" name="CourseSpan" class="selectpicker show-tick form-control" multiple data-live-search="false">
										<option value="10">2周</option>
                                        <option value="20">1个月</option>
                                        <option value="30">2个月</option>
                                        <option value="40">3个月</option>
                                        <option value="50">6个月</option>
                                        <option value="60">12个月</option>
									</select>
								</div>
							</div>
							<!--<div class="col-sm-3">
								<button onclick="" type="button" class="btn btn-primary" style="margin-top:7px;">编辑上课时段</button>
							</div>-->
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">上课时间</label>
							<div class="col-sm-10">
								<div class="checkbox" style="text-align:left;">
									<select id="CourseStartTime" name="CourseStartTime" class="selectpicker show-tick form-control" multiple data-live-search="false">
                                        <optgroup label="上午">
											<option value="08">08:00 - 09:00</option>
											<option value="09">09:00 - 10:00</option>
											<option value="10">10:00 - 11:00</option>
											<option value="11">11:00 - 12:00</option>
										</optgroup>
										<optgroup label="中午">
											<option value="12">12:00 - 13:00</option>
										</optgroup>
										<optgroup label="下午">
											<option value="13">13:00 - 14:00</option>
											<option value="14">14:00 - 15:00</option>
											<option value="15">15:00 - 16:00</option>
											<option value="16">16:00 - 17:00</option>
											<option value="17">17:00 - 18:00</option>
											<option value="18">18:00 - 19:00</option>
											<option value="19">19:00 - 20:00</option>
											<option value="20">20:00 - 21:00</option>
											<option value="21">21:00 - 22:00</option>
										</optgroup>
									</select>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">当前状态</label>
							<div class="col-sm-7">
								<input type="text" class="form-control" id="CourseStatus" readonly>
							</div>
							<div class="checkbox col-sm-3">
								<label>
									<input type="checkbox" id="CourseRelease"></input><span id="CourseReleaseText"></span>
								</label>
							</div>
						</div>
					</form>
				  </div>  
				  <div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>  
					<a  onclick="SaveInfo()" class="btn btn-success">保存</a>  
				  </div>  
				</div>
			  </div>
			</div>
			<div class="modal fade" id="StudentInfo">  
			  <div class="modal-dialog" style="width:800px;">  
				<div class="modal-content message_align">  
				  <div class="modal-header">  
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>  
					<h5 class="modal-title">报名学员</h5>  
				  </div>  
				  <div class="modal-body text-center">  
					<table class="table table-hover table-bordered">
						<thead>
							<tr>
								<th>ID</th>
								<th>微信头像</th>
								<th>昵称</th>
								<th>姓名</th>
								<th>电话</th>
								<th>课程名称</th>
								<th>上课时段</th>
								<th>课程价格</th>
								<th>课程需要积分</th>
								<th>报名时间</th>
							</tr>
						</thead>
						<tbody id='StudentTable'></tbody>
					</table>	
				  </div>   
				</div>
			  </div>
			</div>
		</div>
	</body>
	<?php	include "footer.php";	?>
	<script type="text/javascript">
		var Settings = {};
		Settings.GoDescription1 = -1;
		Settings.GoDescription2 = -1;
		Settings.GoDescription3 = -1;
		
		window.onload = OnLoad;

		function OnLoad(){
			BindEvents();
			ShowCourseList();
		}
		function BindEvents(){
			var ue = UE.getEditor('CourseDescription1');
			var ue = UE.getEditor('CourseDescription2');
			var ue = UE.getEditor('CourseDescription3');
			$("#GoDescription1").click(function(){
				Settings.GoDescription1 = Settings.GoDescription1*(-1);
				GoDescriptionStatus(1,Settings.GoDescription1);
				return false;
			})
			$("#GoDescription2").click(function(){
				Settings.GoDescription2 = Settings.GoDescription2*(-1);
				GoDescriptionStatus(2,Settings.GoDescription2);
				return false;
			})
			$("#GoDescription3").click(function(){
				Settings.GoDescription3 = Settings.GoDescription3*(-1);
				GoDescriptionStatus(3,Settings.GoDescription3);
				return false;
			})
		}
		function GoDescriptionStatus(id,status){
			switch(status){
				case 1:
					$("#CourseDescription"+id).css('display',''); 
					$("#GoDescription"+id).html("︽&nbsp;&nbsp;&nbsp;收起");
					break;
				case -1:
					$("#CourseDescription"+id).css('display','none'); 
					$("#GoDescription"+id).html("︾&nbsp;&nbsp;&nbsp;展开");
					break;
			}
		}
		
		function ShowCourseList(){
			$("#ContentTable").html("");
			Settings.ListName = "course";
			strTable = "<thead><tr><th>ID</th><th>课程名称</th><th>课程描述</th><th>发布状态</th><th>操作</th></tr></thead><tbody id='contentTbody'></tbody>"	
			$("#ContentTable").append(strTable);
			url = "course.ajax.php?mode=CourceList";
			$.get(url,function(json,status){
				if(json=="null"){
					strPrompt = '<h4 id="EmptyPrompt" style="margin:100px 40%;">暂无数据。<h4>';
					$("#ContentTable").after(strPrompt);
					setTimeout(function(){
						$("#EmptyPrompt").animate({opacity:0},500);
					},500)
					setTimeout(function(){
						$("#EmptyPrompt").remove();
					},1000)
					return;
				}
				json = eval("("+json+")");
				console.log(json);			
				for(var i=0;i<json.length;i++){	
					switch(json[i].status){
						case "0":
							var status = "未发布";
							break;
						case "1":
							var status = "已发布";
							break;
						case "-1":
							var status = "已撤销发布";
							break;
					}
					strTbody = '<tr id="'+Settings.ListName+''+(i+1)+'"><td>'+(i+1)+'</td><td>'+json[i].title+'</td><td>'+json[i].shortdesc+'</td><td>'+status+'</td>';
					strTbody += '<td><button class="btn btn-primary btn-sm" onclick="ModifyInfo('+json[i].id+')">编辑</button>&nbsp;&nbsp;&nbsp;';
					strTbody += '<button class="btn btn-primary btn-sm" onclick="ShowEnrollStudent()">报名学员</button></td></tr>';
					$("#contentTbody").append(strTbody);
				}
			});
		}
		function ShowEnrollStudent(){
			$("#StudentTable").html("");
			$('#StudentInfo').modal('toggle');
			Settings.ListName = "courseStudent";
			url = "course.ajax.php?mode=PublishCource&id="+Settings.ModifyInfoId;
			$.get(url,function(json,status){
				json = eval("("+json+")");
				console.log(json);			
				// for(var i=0;i<json.length;i++){	
					// strTbody = '<tr id="'+Settings.ListName+''+i+'"><td>'+i+'</td>';
					// strTbody+= '<td><img style="width:50px;height:50px;" src="'+json[i].imgurl+'"></td><td>'+json[i].title+'</td><td>'+json[i].shortdesc+'</td>';
					// strTbody+= '<td>'+json[i].shortdesc+'</td><td>'+json[i].title+'</td><td>'+json[i].shortdesc+'</td>';
					// strTbody+= '<td>'+json[i].shortdesc+'</td><td>'+json[i].title+'</td><td>'+json[i].shortdesc+'</td></tr>';
					// $("#contentTbody").append(strTbody);
				// }
			});
		}
		function ModifyInfo(id){
			Settings.EditState = "modify";
			Settings.ModifyInfoId = id;
			$('#CourseInfo').modal({backdrop: 'static', keyboard: false});
			$('#addTitle').text("修改信息");
			$("#CourseRelease").prop("checked", false);
			$('[id^="CourseDescription"]').css('display','none'); 
			$('[id^="GoDescription"]').html("︾&nbsp;&nbsp;&nbsp;展开");
					
			url = "course.ajax.php?mode=ShowCource&id="+Settings.ModifyInfoId;
			$.get(url,function(json){
				json = eval("("+json+")");
				console.log(json);
				Settings.Currentstatus = json.status;
				switch(json.status){
					case "0":
						var status = "未发布";
						$("#CourseReleaseText").html("发布课程");
						break;
					case "1":
						var status = "已发布";
						$("#CourseReleaseText").html("撤销发布");
						break;
					case "-1":
						var status = "已撤销发布";
						$("#CourseReleaseText").html("重新发布");
						break;
				}
				$("#CourseStatus").val(status);
				$("#CourseName").val(json.title);
				$("#CourseDescribe").val(json.shortdesc);
				UE.getEditor('CourseDescription1').setContent(json.description1);
				UE.getEditor('CourseDescription2').setContent(json.description2);
				UE.getEditor('CourseDescription3').setContent(json.description3);
				$("#CoursePrice1").val(json.price1);
				$("#CoursePrice2").val(json.price2);
				$("#CoursePrice3").val(json.price3);
				$("#CourseScore1").val(json.score1);
				$("#CourseScore2").val(json.score2);
				$("#CourseScore3").val(json.score3);
				$("#CourseSharescore").val(json.sharescore);
				$("#CourseClickscore").val(json.clickscore);
				$("#CourseOrderscore").val(json.orderscore);
	
				var dataInterval = new Array();
				var orderspan = json.orderspan;
				if(orderspan == null){
					$('#CourseSpan').selectpicker('val', dataInterval);
				}else{
					for(i=0;i<orderspan.length;i++){		
						dataInterval.push(orderspan[i].span);
						$('#CourseSpan').selectpicker('val', dataInterval);
					}
				}
				
				var dataSpan = new Array();
				var timespan = json.timespan;
				if(timespan == null){
					$('#CourseStartTime').selectpicker('val', dataSpan);
				}else{
					for(i=0;i<timespan.length;i++){		
						var spanVal = timespan[i].timefrom.slice(11,13);
						dataSpan.push(spanVal);
						$('#CourseStartTime').selectpicker('val', dataSpan);
					}
				}
			});
		}
		function AddInfo(){
			Settings.EditState = "add";
			$('#CourseInfo').modal({backdrop: 'static', keyboard: false});
			$('#addTitle').text("填写信息");
			$("#CourseStatus").val("未发布");
			Settings.Currentstatus = "0";
			$("#CourseReleaseText").html("发布课程");
			$("#CourseRelease").prop("checked", false);
			$("#CourseName,#CourseDescribe,#CourseSharescore,#CourseClickscore,#CourseOrderscore").val("");
			UE.getEditor('CourseDescription1').setContent("");
			UE.getEditor('CourseDescription2').setContent("");
			UE.getEditor('CourseDescription3').setContent("");
			$('[id^="CoursePrice"]').val("");
			$('[id^="CourseScore"]').val("");
			$('#CourseSpan').selectpicker('val','');
			$('#CourseStartTime').selectpicker('val','');
			$('[id^="CourseDescription"]').css('display','none'); 
			$('[id^="GoDescription"]').html("︾&nbsp;&nbsp;&nbsp;展开");
		}
		function SaveInfo(){
			var data={};
			data.flagid = "";	//判断是更新或者新增
			if(Settings.EditState == "modify"){
				data.flagid = Settings.ModifyInfoId;
			}
			data.publishid = Settings.Currentstatus;	//提交当前新状态--不做改变
			if($("#CourseRelease").is(":checked")){
				switch(Settings.Currentstatus){
					case "0":
						data.publishid = "1";	//未发布-->发布
						break;
					case "1":
						data.publishid = "-1";	//已发布-->撤销发布
						break;
					case "-1":
						data.publishid = "1";	//已撤销发布-->发布
						break;
				}
			}
			data.title = $("#CourseName").val();
			data.shortdesc = $("#CourseDescribe").val();
			data.description1 = UE.getEditor('CourseDescription1').getContent();
			data.description2 = UE.getEditor('CourseDescription2').getContent();
			data.description3 = UE.getEditor('CourseDescription3').getContent();
			data.price1 = $("#CoursePrice1").val();
			data.price2 = $("#CoursePrice2").val();
			data.price3 = $("#CoursePrice3").val();
			data.score1 = $("#CourseScore1").val();
			data.score2 = $("#CourseScore2").val();
			data.score3 = $("#CourseScore3").val();
			data.sharescore = $("#CourseSharescore").val();
			data.clickscore = $("#CourseClickscore").val();
			data.orderscore = $("#CourseOrderscore").val();
			
			if($("#CoursePrice1").val() == ""){data.price1 = 0;}
			if($("#CoursePrice2").val() == ""){data.price2 = 0;}
			if($("#CoursePrice3").val() == ""){data.price3 = 0;}
			if($("#CourseScore1").val() == ""){data.score1 = 0;}
			if($("#CourseScore2").val() == ""){data.score2 = 0;}
			if($("#CourseScore3").val() == ""){data.score3 = 0;}
			if($("#CourseSharescore").val() == ""){data.sharescore = 0;}
			if($("#CourseClickscore").val() == ""){data.clickscore = 0;}
			if($("#CourseOrderscore").val() == ""){data.orderscore = 0;}
			
			if($("#CourseName").val() == ""){
				$.dialog("课程名称不能为空！");
				return;
			}
			
			if($("#CourseDescribe").val() == ""){
				$.dialog("简单描述不能为空！");
				return;
			}
			
			data.orderspan =  new Array();	
			var span = $("#CourseSpan").val();
			if(span == null){
				$.dialog("上课时段不能为空！");
				return;
			}
			for(i=0;i<span.length;i++){
				var d={};
				d.span = span[i];
				// d.spantype = '20';	//10天，20周，30月
				// d.spancount = '3';
				// d.status = '0';
				data.orderspan.push(d);
			}

			data.timespan =  new Array();
			var timefrom = $("#CourseStartTime").val();
			if(timefrom == null){
				$.dialog("上课时间不能为空！");
				return;
			}
			for(j=0;j<timefrom.length;j++){
				var t={};
				t.timefrom = timefrom[j]+":00";
				t.timeto = (parseInt(timefrom[j])+1)+":00";
				if(timefrom[j]==8){
					t.timeto = "0"+(parseInt(timefrom[j])+1)+":00";
				}
				data.timespan.push(t);
			}
			
			url = "course.ajax.php?mode=UpdateCource";
			$.post(url, {
				data : JSON.stringify(data)
			} ,function(json,status){
				console.log(json);
				switch (json){
					case "1":
						ShowCourseList();
						$('#CourseInfo').modal('toggle');
						break;
					default:
						$.dialog("服务器忙，请稍候再试。");
				}
			});
		}
   </script> 
</html>