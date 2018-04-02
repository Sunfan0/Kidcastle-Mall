<?php	include "header.php";	?>

		<div id="Maincontainer" class="container" style="margin-top:30px;">
			<!--<nav class="navbar navbar-default" role="navigation">
				<div class="container-fluid">		
					<form class="navbar-form navbar-right col-sm-3" role="search">
						<button class="btn btn-primary text-right" onclick="AddInfo(); return false;">+ 新增课程</button>
					</form>							
				</div>
			</nav>-->
			<table id="ContentTable" class="table table-hover table-bordered"></table>
			<div class="modal fade" id="StudentInfo">  
			  <div class="modal-dialog" style="width:1200px;">  
				<div class="modal-content message_align">  
				  <div class="modal-header">  
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>  
					<h5 class="modal-title" id="courseName">报名学员</h5>  
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
								<th>上课时段</th>
								<th>上课时间</th>
								<th>报名时间</th>
								<th style="background-color:#d9edf7;">费用</th>
								<th style="background-color:#dff0d8;">积分</th>
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
		
		window.onload = OnLoad;

		function OnLoad(){
			BindEvents();
			ShowCourseList();
		}
		function BindEvents(){
			
		}
		
		function ShowCourseList(){
			$("#ContentTable").html("");
			Settings.ListName = "student";
			strTable = "<thead><tr><th>ID</th><th>课程名称</th><th>课程描述</th><th>发布状态</th><th>报名人数</th><th>操作</th></tr></thead><tbody id='contentTbody'></tbody>"	
			$("#ContentTable").append(strTable);
			url = "student.ajax.php?mode=CourceList";
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
					var studentNumber = json[i].cnt;
					if(studentNumber == null){studentNumber = 0;}
					
					strTbody = '<tr id="'+Settings.ListName+''+(i+1)+'" onclick="ShowEnrollStudent('+json[i].id+')"><td>'+(i+1)+'</td><td>'+json[i].title+'</td><td>'+json[i].shortdesc+'</td><td>'+status+'</td><td>'+studentNumber+'</td>';
					strTbody += '<td><button class="btn btn-primary btn-sm">报名学员</button></td></tr>';
					$("#contentTbody").append(strTbody);
				}
			});
		}
		function ShowEnrollStudent(id){
			$("#StudentTable").html("");
			// $('#StudentInfo').modal('toggle');
			Settings.ListName = "courseStudent";
			url = "student.ajax.php?mode=PublishCource&id="+id;
			$.get(url,function(json,status){
				if(json=="null"){
					CommonJustTip('暂无数据。');
					return;
				}
				$('#StudentInfo').modal('toggle');
				json = eval("("+json+")");
				console.log(json);
				$("#courseName").text(json[0].title+"课程报名学员");
				for(var i=0;i<json.length;i++){	
					var span=new Array(); 
					span[0]="10";       
					span[1]="30";
					span[2]="40";

					var CourseSpan = "";
					switch(json[i].span){
						case '10':
							CourseSpan = "2周;";
							break;
						case '20':
							CourseSpan = "1个月;";
							break;
						case '30':
							CourseSpan = "2个月;";
							break;
						case '40':
							CourseSpan = "3个月;";
							break;
						case '50':
							CourseSpan = "6个月;";
							break;
						case '60':
							CourseSpan = "12个月;";
							break;
					}
					
					var timefrom = "";
					var timeto = "";
					if(json[i].timefrom != null){
						timefrom = json[i].timefrom.slice(11,16);
					}
					if(json[i].timeto != null){
						timeto = json[i].timeto.slice(11,16);
					}
					
					strTbody = '<tr id="'+Settings.ListName+''+(i+1)+'"><td>'+(i+1)+'</td>';
					strTbody+= '<td><img style="width:50px;height:50px;" src="'+json[i].imgurl+'"></td><td>'+json[i].nickname+'</td>';
					strTbody+= '<td>'+json[i].name+'</td><td>'+json[i].mobile+'</td><td>'+CourseSpan+'</td><td>'+ timefrom +' - '+ timeto +'</td>';
					strTbody+= '<td>'+json[i].ordertime+'</td><td style="background-color:#d9edf7;">'+json[i].price+'</td><td style="background-color:#dff0d8;">'+json[i].score+'</td></tr>';
					$("#StudentTable").append(strTbody);
				}
			});
		}
	</script> 
</html>