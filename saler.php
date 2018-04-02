<?php	include "header.php";	?>

		<div id="Maincontainer" class="container" style="margin-top:30px;">
			<nav class="navbar navbar-default" role="navigation">
				<div class="container-fluid">
					<form class="navbar-form navbar-left" role="search">
						<div class="dropdown">
							<!--<button type="button" class="btn btn-primary dropdown-toggle" id="dropdownMenu2" data-toggle="dropdown">
								<span id="AuditStateText">待审核</span><span class="caret"></span>
							</button>
							<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
								<li role="presentation">
									<a id="GoAudit" role="menuitem" tabindex="-1" href="#">待审核</a>
								</li>
								<li role="presentation">
									<a id="YesAudit" role="menuitem" tabindex="-1" href="#">审核通过</a>
								</li>
								<li role="presentation">
									<a id="NoAudit" role="menuitem" tabindex="-1" href="#">审核不通过</a>
								</li>
							</ul>-->
							<div class="btn-group">
								<button id="GoAudit" type="button" class="btn btn-default active">待审核</button>
								<button id="YesAudit" type="button" class="btn btn-default">审核通过</button>
								<button id="NoAudit" type="button" class="btn btn-default">审核不通过</button>
							</div>
						</div>
						<!--<div class="input-group">
							<span class="input-group-addon">电话</span>
							<input type="text" class="form-control">
							<div class="input-group-btn">
								<button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-search"></i></button>
							</div>
						</div>-->
					</form>					
				</div>
			</nav>
			<table id="ContentTable" class="table table-hover table-bordered"></table>
			<div id="kkpager"></div>
		</div>
	</body>
	<?php	include "footer.php";	?>
	<script type="text/javascript">
		var Settings = {};
	
		window.onload = OnLoad;
		
		function OnLoad(){
			BindEvents();
			ShowSaleList("0",1);
		}
		function BindEvents(){
			$("#AuditState").click(function(){
				$("#AuditState-menu").dropdown('toggle');
			});
			$("#GoAudit").click(function(){
				// $("#AuditStateText").html("待审核");
				$("#YesAudit,#NoAudit").removeClass("active");
				$("#GoAudit").addClass("active");
				ShowSaleList("0",1);
			});
			$("#YesAudit").click(function(){
				// $("#AuditStateText").html("审核通过");
				$("#GoAudit,#NoAudit").removeClass("active");
				$("#YesAudit").addClass("active");
				ShowSaleList("1",1);
			});
			$("#NoAudit").click(function(){
				// $("#AuditStateText").html("审核不通过");
				$("#GoAudit,#YesAudit").removeClass("active");
				$("#NoAudit").addClass("active");
				ShowSaleList("-1",1);
			});
		}

		function ShowSaleList(type,page){
			$("#ContentTable").html("");
			$("#kkpager").html("");
			Settings.ListType = type;
			Settings.ListPage = page;
			Settings.ListName = "sale";
			// strTable = "<thead><tr><th>ID</th><th>微信头像</th><th>昵称</th><th>姓名</th><th>电话</th><th>区域</th><th>学校</th><th>操作</th></tr></thead><tbody id='contentTbody'></tbody>"	
			strTable = "<thead><tr><th>ID</th><th>微信头像</th><th>昵称</th><th>姓名</th><th>电话</th><th>学校</th><th>操作</th></tr></thead><tbody id='contentTbody'></tbody>"	
			$("#ContentTable").append(strTable);
			url = "saler.ajax.php?mode=GetStaffinfo&type="+type+"&currentpage="+page;
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
					switch(type){
						case "0":
							strTbodyBtn = '<td><button class="btn btn-primary btn-sm" onclick="AuditOperate(\'1\','+json[i].id+')">通过</button>&nbsp;&nbsp;&nbsp;<button class="btn btn-primary btn-sm" onclick="AuditOperate(\'-1\','+json[i].id+')">拒绝</button></td></tr>';
							break;
						case "1":
							strTbodyBtn = '<td><button class="btn btn-primary btn-sm" onclick="AuditOperate(\'0\','+json[i].id+')">重新审核</button></td></tr>';
							break;
						case "-1":
							strTbodyBtn = '<td><button class="btn btn-primary btn-sm" onclick="AuditOperate(\'0\','+json[i].id+')">重新审核</button></td></tr>';
							break;
					}
					// strTbody = '<tr id="'+Settings.ListName+''+(i+1)+'"><td>'+(i+1)+'</td><td><img style="width:50px;height:50px;" src="'+json[i].imgurl+'"></td><td>'+json[i].nickname+'</td></td><td>'+json[i].name+'</td><td>'+json[i].mobile+'</td><td>'+json[i].area+'</td><td>'+json[i].school+'</td>';
					strTbody = '<tr id="'+Settings.ListName+''+(i+1)+'"><td>'+(i+1)+'</td><td><img style="width:50px;height:50px;" src="'+json[i].imgurl+'"></td><td>'+json[i].nickname+'</td></td><td>'+json[i].name+'</td><td>'+json[i].mobile+'</td><td>'+json[i].school+'</td>';
					strTbody += strTbodyBtn;
					$("#contentTbody").append(strTbody);
				}
				kkpager.generPageHtml({
					pno : page,
					total : json[0].pagecount,
					totalRecords : json[0].total,
					mode : 'click',//默认值是link，可选link或者click
					click : function(n){
						ShowSaleList(Settings.ListType,n);
						return false;
					}
				} , true);
			});
			
			// for(var i=1;i<10;i++){
				// strTbody = '<tr id="'+Settings.ListName+''+i+'"><td class="no">'+i+'</td><td class="head">'+i+'Tanmay</td><td class="name">'+i+'Bangalore</td><td class="phone">'+i+'xxxxxx</td><td class="info">'+i+'xxxxxx</td>';
				// strTbody += strTbodyBtn;
				// $("#contentTbody").append(strTbody);
			// }
		}
		function AuditOperate(type,id){
			url = "saler.ajax.php?mode=UpdateStaff&id="+id+"&type="+type;
			$.get(url,function(json,status){
				switch (json){
					case "1":
						ShowSaleList(Settings.ListType,Settings.ListPage);
						break;
					default:
						CommonWarning('服务器忙，请稍候再试。');
						break;
				}
			});
		}
   </script> 
</html>