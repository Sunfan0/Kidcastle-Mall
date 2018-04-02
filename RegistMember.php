<?php	include "header.php";	?>

		<div id="Maincontainer" class="container" style="margin-top:30px;">
			<nav class="navbar navbar-default" role="navigation">
				<div class="container-fluid">
					<form class="navbar-form navbar-left" style="margin-right: 50px;" role="search">
						<div class="dropdown">
							<div class="btn-group">
								<button id="AllMember" type="button" class="btn btn-default active">全部</button>
								<button id="OldMember" type="button" class="btn btn-default">已就读</button>
								<button id="NewMember" type="button" class="btn btn-default">未就读</button>
							</div>
						</div>
					</form>
					<form class="navbar-form navbar-center" role="search">
						<div class="input-group">
							<span class="input-group-addon">校区</span>
							
							<!--<input type="text" class="form-control">-->
							<select  class="form-control" id="memberSchool" style="width:193px;">
								<option value="0">全部</option>
							</select>
							<div class="input-group-btn">
								<button onclick="SearchSchoolmember(); return false;" class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-search"></i></button>
							</div>
						</div>
					</form>
					<form class="navbar-form navbar-right" style="margin-top: -40px;" role="search">
						<button class="btn btn-primary text-right" onclick="exportExcel(); return false;">导出Excel文件</button>
					</form>							
				</div>
			</nav>
			<table id="ContentTable" class="table table-hover table-bordered">
				<thead>
					<tr>
						<th>ID</th>
						<th>用户头像</th>
						<th>昵称</th>
						<th>姓名</th>
						<th>电话</th>
						<th id="SchoolType">就读校区</th>
						<th>就读班级</th>
						<th>年龄</th>
						<th>当前积分</th>
					</tr>
				</thead>
				<tbody id='contentTbody'></tbody>
			</table>
			<div id="kkpager"></div>
		</div>
	</body>
	<?php	include "footer.php";	?>
	<script type="text/javascript">
		var Settings = {};
		Settings.Currentisread = "2";
		Settings.Currentschool = "0";
		
		/* $(function(){
			// $("table").tableExport({formats:["xlsx","xls","csv","txt"]});
			$("table").tableExport({formats:["xls"]});
		}) */
		/* $.fn.tableExport.csv = {
			defaultClass: "csv",
			buttonContent: "导出csv文件",
			separator: ",",
			mimeType: "application/csv",
			fileExtension: ".csv"
		}; */
			
		window.onload = OnLoad;
		
		function OnLoad(){
			BindEvents();
			ShowSchoolList();
			ShowMemberList(1);
		}
		function BindEvents(){
			$("#AuditState").click(function(){
				$("#AuditState-menu").dropdown('toggle');
			});
			$("#AllMember").click(function(){
				$("#OldMember,#NewMember").removeClass("active");
				$("#AllMember").addClass("active");
				Settings.Currentisread = "2";
				ShowMemberList(1);
			});
			$("#OldMember").click(function(){
				$("#AllMember,#NewMember").removeClass("active");
				$("#OldMember").addClass("active");
				Settings.Currentisread = "0";
				ShowMemberList(1);
			});
			$("#NewMember").click(function(){
				$("#AllMember,#OldMember").removeClass("active");
				$("#NewMember").addClass("active");
				Settings.Currentisread = "1";
				ShowMemberList(1);
			});
		}
		function ShowSchoolList(){
			url = "RegistMember.ajax.php?mode=ShowSchool";
			$.get(url,function(json,status){
				json = eval("("+json+")");
				console.log(json);
				for(var i=0;i<json.length;i++){			
					strTbody = '<option value="'+json[i].id+'">'+json[i].name+'</option>';
					$("#memberSchool").append(strTbody);
				}
			});
		}
		function SearchSchoolmember(){
			Settings.Currentschool = $('#memberSchool option:selected') .val();
			ShowMemberList(1);
		}
		
		function ShowMemberList(page){
			$("#contentTbody").html("");
			$("#kkpager").html("");
			url = "RegistMember.ajax.php?mode=RegisterList&isread="+Settings.Currentisread+"&school="+Settings.Currentschool+"&currentpage="+page;
			$.get(url,function(json,status){
				if(json=="123"){
					CommonNopower();
					$("#Maincontainer").addClass("hidden");
					return;
				}
				json = eval("("+json+")");
				data = json.data;
				console.log(json);
				
				if(data==null){
					CommonJustTip('暂无数据。');
					return;
				}

				for(var i=0;i<data.length;i++){
					if(data[i].isread == "1"){
						$("#SchoolType").html("就读校区");
					}else
						$("#SchoolType").html("最近校区");
					
					strTbody = '<tr><td>'+data[i].id+'</td><td><img style="width:50px;height:50px;" src="'+data[i].imgurl+'"></td>';
					strTbody += '<td>'+data[i].nickname+'</td></td><td>'+data[i].name+'</td><td>'+data[i].mobile+'</td>';
					strTbody += '<td>'+data[i].schoolname+'</td><td>'+data[i].grade+'</td><td>'+data[i].age+'</td><td>'+data[i].score+'</td>';
					$("#contentTbody").append(strTbody);
				}
				kkpager.generPageHtml({
					pno : page,
					total : json.pagecount,
					totalRecords : json.total,
					mode : 'click',//默认值是link，可选link或者click
					click : function(n){
						ShowMemberList(n);
						return false;
					}
				} , true);
			});
		}
		function exportExcel(){
			window.open("excel.php");
		}
   </script> 
</html>