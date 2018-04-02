<?php	include "header.php";	?>

		<div id="Maincontainer" class="container" style="margin-top:30px;">
			<nav class="navbar navbar-default" role="navigation">
				<div class="container-fluid">
					<form class="navbar-form navbar-left" style="margin-right: 50px;" role="search">
						<div class="input-group">
							<span class="input-group-addon">校区</span>
							<select  class="form-control" id="screenSchool" style="width:193px;">
								<option value="0">全部</option>
							</select>
							<span class="input-group-addon">课程类型</span>
							<select  class="form-control" id="screenType" style="width:120px;">
								<option value="0">全部</option>
							</select>
							<div class="input-group-btn">
								<button onclick="ShowSearchCourse(); return false;" class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-search"></i></button>
							</div>
						</div>
					</form>
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
							<label for="CourseImgBtn" class="col-sm-2 control-label">课程头图</label>
							<div class="col-sm-10" style="text-align: left;">
								<input type="file" id="CourseImgBtn" type="file" name="CourseImgBtn" multiple>
								<img id="CourseImg" style="width:100px;">
								<span id="CourseImgText" name="CourseImgText"></span>
							</div>				
						</div>
						<div class="form-group">
							<label for="CourseName" class="col-sm-2 control-label">课程名称</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="CourseName">
							</div>		
						</div>
						<div class="form-group">
							<label for="CourseSchool" class="col-sm-2 control-label">课程校区</label>
							<div class="col-sm-10" style="text-align: left;">
								<select class="form-control" id="CourseSchool"></select>
							</div>			
						</div>
						<div class="form-group">
							<label for="CourseType" class="col-sm-2 control-label">课程类型</label>
							<div class="col-sm-10" style="text-align: left;">
								<select class="form-control" id="CourseType"></select>
							</div>		
						</div>
						<div class="form-group">
							<label for="CourseNumber" class="col-sm-2 control-label">报名人数</label>
							<div class="col-sm-10">
								<input type="number" class="form-control" id="CourseNumber">
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
									<!--<select id="CourseStartTime" name="CourseStartTime" class="selectpicker show-tick form-control" multiple data-live-search="false">
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
									</select>-->
									<!--<input type="text" class="form-control" id="CourseTimeText">-->
									<textarea id="CourseTimeText"  class="form-control" rows="3"></textarea>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">当前状态</label>
							<div class="col-sm-5">
								<input type="text" class="form-control" id="CourseStatus" readonly>
							</div>
							<div class="col-sm-2">
								<button class="btn btn-primary text-right" id="CoursePreview">预览</button>
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
			<div class="modal fade" id="ShowCoursePreview">  
			  <div class="modal-dialog" style="width:375px;margin-top:60px;">  
				<div class="modal-content message_align" style="height:667px;overflow-y:auto;overflow-x:hidden;">  
				  <div class="modal-header">  
					<button style="margin-top: -10px" onclick="Showmodalopen();" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>  
				  </div>  
				  <div class="modal-body" style="padding:0px;">
					<div class="container" style="background-color:white;text-align:left;width:375px;">
						<div class="PreviewRow">
							<div style="background-color:#d9edf7;height:180px;margin:0px -15px;">
								<img id="LessonImg" src="" style="width:100%;height:100%;">
							</div>
							<div class="row">
								<div class="col-xs-8">
									<p style="font-size:16px;" id="LessonName"></p>
								</div>
								<div class="col-xs-4" style="text-align:right;">
									<button type="button" class="btn btn-primary btn-sm">报名</button>
								</div>
							</div>
							<div class="row" style="padding: 0px 25px;color:#767876;font-size:14px;">
								<p style="word-break:break-all;" id="LessonDescribe">LessonDescribe</p>
							</div>
							<div class="row" style="padding:0px;">
								<div class="row" id="RowLessonDescribe1" style="margin:10px;padding: 10px 25px;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;background-color:white;">
									<div id="LessonDescribe1"></div>
								</div>
								<div class="row" id="RowLessonDescribe2" style="margin:10px;padding: 10px 25px;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;background-color:white;">
									<div id="LessonDescribe2"></div>
								</div>
								<div class="row" id="RowLessonDescribe3" style="margin:10px;padding: 10px 25px;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;background-color:white;">
									<div id="LessonDescribe3"></div>
								</div>
								<div class="row" id="RowLessonNumber" style="margin:10px;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;background-color:white;">
									<div class="col-xs-5" style="color:#404340;">报名人数</div>
									<div class="col-xs-7" id="LessonNumber"></div>
								</div>
								<div class="row" id="RowLessonSchool" style="margin:10px;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;background-color:white;">
									<div class="col-xs-5" style="color:#404340;">课程校区</div>
									<div class="col-xs-7" id="LessonSchool"></div>
								</div>
								<div class="row" id="RowLessonType" style="margin:10px;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;background-color:white;">
									<div class="col-xs-5" style="color:#404340;">课程类型</div>
									<div class="col-xs-7" id="LessonType"></div>
								</div>
								<div class="row" id="RowlessonOrderspan" style="margin:10px;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;background-color:white;">
									<div class="col-xs-5" style="color:#404340;">上课时段</div>
									<div class="col-xs-7">
										<div class="radio hidden" id="lessonOrderspan10">
											<label>
												<input type="radio" name="lessonOrderspan" value="10">2周
											</label>
										</div>
										<div class="radio hidden" id="lessonOrderspan20">
											<label>
												<input type="radio" name="lessonOrderspan" value="20">1个月
											</label>
										</div>
										<div class="radio hidden" id="lessonOrderspan30">
											<label>
												<input type="radio" name="lessonOrderspan" value="30">2个月
											</label>
										</div>
										<div class="radio hidden" id="lessonOrderspan40">
											<label>
												<input type="radio" name="lessonOrderspan" value="40">3个月
											</label>
										</div>
										<div class="radio hidden" id="lessonOrderspan50">
											<label>
												<input type="radio" name="lessonOrderspan" value="50">6个月
											</label>
										</div>
										<div class="radio hidden" id="lessonOrderspan60">
											<label>
												<input type="radio" name="lessonOrderspan" value="60">12个月
											</label>
										</div>
									</div>
								</div>
								<div class="row" id="RowlessonTimespan" style="margin:10px;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;background-color:white;">
									<div class="col-xs-5" style="color:#404340;">上课时间</div>
									<!--<div class="col-xs-7" id="lessonTimespanContent"></div>-->
									<div class="col-xs-7" id="lessonTimeTextContent"></div>
								</div>
								<div class="row" id="RowLessonprice1" style="margin:10px;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;background-color:white;">
									<div class="col-xs-5" style="color:#404340;">正常价格</div>
									<div class="col-xs-7" id="Lessonprice1">price1</div>
								</div>
								<div class="row" id="RowLessonscore1" style="margin:10px;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;background-color:white;">
									<div class="col-xs-5" style="color:#404340;">正常积分</div>
									<div class="col-xs-7" id="Lessonscore1">score1</div>
								</div>
								<div class="row" id="RowLessonprice2" style="margin:10px;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;background-color:white;">
									<div class="col-xs-5" style="color:#404340;">续费折扣价格</div>
									<div class="col-xs-7" id="Lessonprice2">price2</div>
								</div>
								<div class="row" id="RowLessonscore2" style="margin:10px;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;background-color:white;">
									<div class="col-xs-5" style="color:#404340;">续费折扣积分</div>
									<div class="col-xs-7" id="Lessonscore2">score2</div>
								</div>
								<div class="row" id="RowLessonprice3" style="margin:10px;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;background-color:white;">
									<div class="col-xs-5" style="color:#404340;">积分抵扣价格</div>
									<div class="col-xs-7" id="Lessonprice3">price3</div>
								</div>
								<div class="row" id="RowLessonscore3" style="margin:10px;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;background-color:white;">
									<div class="col-xs-5" style="color:#404340;">积分抵扣积分</div>
									<div class="col-xs-7" id="Lessonscore3">score3</div>
								</div>
							</div>
						</div>
					</div>
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
		Settings.Currentschool = "0";
		Settings.Currenttype = "0";
		
		window.onload = OnLoad;

		<?php $timestamp = time();?>
		
		function OnLoad(){
			BindEvents();
			ShowSchoolList();
			ShowSchoolType();
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
			$("#CoursePreview").click(function(){
				ShowPreview();
				return false;
			})
			$('#CourseImgBtn').uploadify ({ //以下参数均是可选  
				'formData'     : {
					'timestamp' : '<?php echo $timestamp;?>',
					'token'     : '<?php echo md5('unique_salt' . $timestamp);?>'
				},
				'swf'		: 'uploadify/uploadify.swf',   //指定上传控件的主体文件，默认‘uploader.swf’  
				'uploader'	: 'uploadify/uploadify.php',       //指定服务器端上传处理文件，默认‘upload.php’  
				'auto'		: true,               //选定文件后是否自动上传，默认false  
				'folder'	: 'uploadify/upload',         //要上传到的服务器路径，默认‘/’  
				'multi'		: false,               //是否允许同时上传多文件，默认false  
				'fileTypeDesc' : 'Image Files',
				'fileTypeExts' : '*.gif; *.jpg; *.png',  
				'fileSizeLimit' : '200KB',
				'onUploadSuccess' : function(file, data, response) {
					$("#CourseImg").removeClass('hidden');
					$("#CourseImg").css("display","block");
					$("#CourseImg").attr("src",'uploadify/upload/'+data);
					// $("#CourseImgText").text(data);
				}
			});
		}
		function ShowSchoolList(){
			url = "course.ajax.php?mode=ShowSchool";
			$.get(url,function(json,status){
				json = eval("("+json+")");
				// console.log(json);
				for(var i=0;i<json.length;i++){		
					strTbody = '<option value="'+json[i].id+'">'+json[i].name+'</option>';
					$("#CourseSchool").append(strTbody);
					$("#screenSchool").append(strTbody);
				}
			});
		}
		function ShowSchoolType(){
			url = "course.ajax.php?mode=ShowCourseType";
			$.get(url,function(json,status){
				json = eval("("+json+")");
				// console.log(json);
				for(var i=0;i<json.length;i++){		
					strTbody = '<option value="'+json[i].id+'">'+json[i].name+'</option>';
					$("#CourseType").append(strTbody);
					$("#screenType").append(strTbody);
				}
			});
		}
		function ShowSearchCourse(){
			Settings.Currentschool = $('#screenSchool option:selected') .val();
			Settings.Currenttype = $('#screenType option:selected') .val();
			ShowCourseList();
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
			strTable = "<thead><tr><th>ID</th><th>课程名称</th><th>课程校区</th><th>课程类型</th><th>课程描述</th><th>发布状态</th><th>操作</th></tr></thead><tbody id='contentTbody'></tbody>"	
			$("#ContentTable").append(strTable);
			url = "course.ajax.php?mode=CourceList&school=" + Settings.Currentschool + "&coursetype=" + Settings.Currenttype;
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
					var school = json[i].school;
					var typename = json[i].typename;
					if(json[i].school == null){school = "";}
					if(json[i].typename == null){typename = "";}
						
					strTbody = '<tr id="'+Settings.ListName+''+(i+1)+'" onclick="ModifyInfo('+json[i].id+')"><td>'+(i+1)+'</td><td>'+json[i].title+'</td>';
					strTbody += '<td>'+school+'</td><td>'+typename+'</td><td>'+json[i].shortdesc+'</td><td>'+status+'</td>';
					strTbody += '<td><button class="btn btn-primary btn-sm">编辑</button></td></tr>';
					$("#contentTbody").append(strTbody);
				}
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
			$("#CourseImg").addClass('hidden');
					
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
				if(json.titleimage != ""){
					$("#CourseImg").removeClass('hidden');
				}
				
				$("#CourseStatus").val(status);
				$("#CourseImg").attr("src",json.titleimage);
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
				$("#CourseSchool").val(json.school);
				$("#CourseType").val(json.coursetype);
				$("#CourseNumber").val(json.count);
				$("#CourseTimeText").val(json.timerinfo);
	
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
			$("#CourseName,#CourseDescribe,#CourseSharescore,#CourseClickscore,#CourseOrderscore,#CourseNumber,#CourseTimeText").val("");
			UE.getEditor('CourseDescription1').setContent("");
			UE.getEditor('CourseDescription2').setContent("");
			UE.getEditor('CourseDescription3').setContent("");
			$('[id^="CoursePrice"]').val("");
			$('[id^="CourseScore"]').val("");
			$('#CourseSpan').selectpicker('val','');
			$('#CourseStartTime').selectpicker('val','');
			$('[id^="CourseDescription"]').css('display','none'); 
			$('[id^="GoDescription"]').html("︾&nbsp;&nbsp;&nbsp;展开");
			$("#CourseImg").addClass('hidden');
			$("#CourseImg").attr("src","");
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
			data.titleimage = $("#CourseImg").attr("src");
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
			data.school = $("#CourseSchool option:selected").val();
			data.coursetype = $("#CourseType option:selected").val();
			data.count = $("#CourseNumber").val();
			data.timerinfo = $("#CourseTimeText").val();
			
			
			if($("#CoursePrice1").val() == ""){data.price1 = 0;}
			if($("#CoursePrice2").val() == ""){data.price2 = 0;}
			if($("#CoursePrice3").val() == ""){data.price3 = 0;}
			if($("#CourseScore1").val() == ""){data.score1 = 0;}
			if($("#CourseScore2").val() == ""){data.score2 = 0;}
			if($("#CourseScore3").val() == ""){data.score3 = 0;}
			if($("#CourseSharescore").val() == ""){data.sharescore = 0;}
			if($("#CourseClickscore").val() == ""){data.clickscore = 0;}
			if($("#CourseOrderscore").val() == ""){data.orderscore = 0;}
			if($("#CourseNumber").val() == ""){data.count = 0;}
			
			if($("#CourseName").val() == ""){
				CommonWarning('课程名称不能为空！');
				return;
			}
			
			if($("#CourseDescribe").val() == ""){
				CommonWarning('简单描述不能为空！');
				return;
			}
			if($("#CourseSchool").val() == null){
				CommonWarning('课程校区不能为空！');
				return;
			}
			if($("#CourseType").val() == null){
				CommonWarning('课程类型不能为空！');
				return;
			}
			
			if($("#CoursePrice1").val() == "" || $("#CoursePrice1").val() == '0'){
				CommonWarning('课程正常价格不能为空或0！');
				return;
			}
			
			if($("#CourseNumber").val() == "" || $("#CourseNumber").val() == '0'){
				CommonWarning('报名人数不能为空或0！');
				return;
			}
			
			data.orderspan =  new Array();	
			var span = $("#CourseSpan").val();
			if(span == null){
				CommonWarning('上课时段不能为空！');
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

			// data.timespan =  new Array();
			// var timefrom = $("#CourseStartTime").val();
			// if(timefrom == null){
				// CommonWarning('上课时间不能为空！');
				// return;
			// }
			// for(j=0;j<timefrom.length;j++){
				// var t={};
				// t.timefrom = timefrom[j]+":00";
				// t.timeto = (parseInt(timefrom[j])+1)+":00";
				// if(timefrom[j]==8){
					// t.timeto = "0"+(parseInt(timefrom[j])+1)+":00";
				// }
				// data.timespan.push(t);
			// }
			
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
						CommonWarning('服务器忙，请稍候再试。');
				}
			});
		}
		function ShowPreview(){
			if(UE.getEditor('CourseDescription1').getContent() == ""){$("#RowLessonDescribe1").addClass("hidden");}
			if(UE.getEditor('CourseDescription2').getContent() == ""){$("#RowLessonDescribe2").addClass("hidden");}
			if(UE.getEditor('CourseDescription3').getContent() == ""){$("#RowLessonDescribe3").addClass("hidden");}
			if($("#CoursePrice1").val() == "" || $("#CoursePrice1").val() == '0'){$("#RowLessonprice1").addClass("hidden");}
			if($("#CoursePrice2").val() == "" || $("#CoursePrice2").val() == '0'){$("#RowLessonprice2").addClass("hidden");}
			if($("#CoursePrice3").val() == "" || $("#CoursePrice3").val() == '0'){$("#RowLessonprice3").addClass("hidden");}
			if($("#CourseScore1").val() == "" || $("#CourseScore1").val() == '0'){$("#RowLessonscore1").addClass("hidden");}
			if($("#CourseScore2").val() == "" || $("#CourseScore2").val() == '0'){$("#RowLessonscore2").addClass("hidden");}
			if($("#CourseScore3").val() == "" || $("#CourseScore3").val() == '0'){$("#RowLessonscore3").addClass("hidden");}
			
			var span = $("#CourseSpan").val();
			if(span == null){
				$("#RowlessonOrderspan").addClass("hidden");
			}else{
				for(i=0;i<span.length;i++){
					$("#lessonOrderspan"+span[i]).removeClass("hidden");
				}
			}
			
			$("#lessonTimeTextContent").text($("#CourseTimeText").val());
			
			// $("#lessonTimespanContent").html("");
			// var timespan = $("#CourseStartTime").val();
			// if(timespan == null){
				// $("#RowlessonTimespan").addClass("hidden");
			// }else{
				// for(j=0;j<timespan.length;j++){
					// var timefrom = timespan[j]+":00:00";
					// var timeto = (parseInt(timespan[j])+1)+":00:00";
					// if(timespan[j]==8){
						// var timeto = "0"+(parseInt(timespan[j])+1)+":00:00";
					// }
					// strTimespan = '<div class="radio"><label><input type="radio" name="lessonTimespan" value="'+timespan[j]+'">'+timefrom+' - '+timeto+'</label></div>';
					// $("#lessonTimespanContent").append(strTimespan);
				// }
			// }
			
			
			
			$("#LessonImg").attr("src",$("#CourseImg").attr("src"));
			$("#LessonName").text($("#CourseName").val());
			$("#LessonNumber").text($("#CourseNumber").val());
			$("#LessonSchool").text($("#CourseSchool option:selected").text());
			$("#LessonType").text($("#CourseType option:selected").text());
			$("#LessonDescribe").text($("#CourseDescribe").val());
			$("#LessonDescribe1").html(UE.getEditor('CourseDescription1').getContent());
			$("#LessonDescribe2").html(UE.getEditor('CourseDescription2').getContent());
			$("#LessonDescribe3").html(UE.getEditor('CourseDescription3').getContent());
			$("#Lessonprice1").text($("#CoursePrice1").val());
			$("#Lessonprice2").text($("#CoursePrice2").val());
			$("#Lessonprice3").text($("#CoursePrice3").val());
			$("#Lessonscore1").text($("#CourseScore1").val());
			$("#Lessonscore2").text($("#CourseScore2").val());
			$("#Lessonscore3").text($("#CourseScore3").val());
			// $('#ShowCoursePreview').modal('toggle');
			$('#ShowCoursePreview').modal({backdrop: 'static', keyboard: false});
		}
		function Showmodalopen(){
			setTimeout(function(){
				  $("body").addClass('modal-open');
			},500);
		}
   </script> 
</html>