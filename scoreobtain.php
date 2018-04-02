<?php	include "header.php";	?>

		<div id="Maincontainer" class="container" style="margin-top:30px;">			
			<!--<nav class="navbar navbar-default" role="navigation">
				<div class="container-fluid">	
				</div>
			</nav>-->
			<table id="scoreobtainList" class="table table-hover table-bordered">
				<thead>
					<tr>
						<th>ID</th>
						<th>用户头像</th>
						<th>昵称</th>
						<th>姓名</th>
						<th>电话</th>
						<th>获得积分</th>
						<th>已兑换积分</th>
						<th>当前积分</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
			<div class="modal fade" id="scoreobtainInfo">  
			  <div class="modal-dialog" style="width:1100px;">  
				<div class="modal-content message_align">  
				  <div class="modal-header">  
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>  
					<h5 class="modal-title">代言人积分履历</h5>  
				  </div>  
				  <div class="modal-body text-center">  
					<table class="table table-hover table-bordered">
						<thead>
							<tr>
								<th style="text-align: center;">变更理由</th>
								<th style="text-align: center;">变更前</th>
								<th style="text-align: center;">变更</th>
								<th style="text-align: center;">变更后</th>
								<th style="text-align: center;">好友头像</th>
								<th style="text-align: center;">好友昵称</th>
								<th style="text-align: center;">好友姓名</th>
								<th style="text-align: center;">好友电话</th>
								<th style="text-align: center;">操作员</th>
								<th style="text-align: center;">操作时间</th>
							</tr>
						</thead>
						<tbody id='scoreobtainTable'></tbody>
					</table>
					<div id="kkpager"></div>
				  </div>   
				</div>
			  </div>
			</div>
		</div>
	</body>
	<?php	include "footer.php";	?>
	<script type="text/javascript">

		var GotListTable;
		
		window.onload = OnLoad;

		function OnLoad(){
			BindEvents();
			ShowscoreobtainList();
		}
		
		function BindEvents(){
			$('#scoreobtainList tbody').on( 'click', 'td', function () {
				if ($(this).hasClass('selected') ) {
					$(this).removeClass('selected');
				}
				else {
					GotListTable.$('tr.selected').removeClass('selected');
					$(this).parent().addClass('selected');
					ShowscoreobtainInfo(GotListTable.row('.selected').data().id,1);
				}
			}); 
		}
		
		function ShowscoreobtainList(){
			GotListTable = $('#scoreobtainList').DataTable({
				"ajax": {
					"url":"scoreobtain.ajax.php?mode=SpokesmanScore",
					"type":"POST"
				},
				//"processing": true,//加载效果
				"serverSide": true,//页面在加载时就请求后台，以及每次对 datatable 进行操作时也是请求后台
				"pageLength": 40,//每页显示的数据量
				"columns": [//datatable每一列所对应的数据显示内容
					{ "data": "id"},
					{ "data": "imgurl"},
					{ "data": "nickname"},
					{ "data": "name"},
					{ "data": "mobile"},
					{ "data": "getscore"},
					{ "data": "changescore"},
					{ "data": "afterscore"}
				],	
				// "searching": false,
				"columnDefs":[
					{
						"targets":1,
						"render":function(data,type,full){
							return "<img style='width:50px;height:50px;' src='"+data+"'>";
						}
					}
				],				
				"aaSorting": [[0, "asc"]]//设置排序
				
			} ).on('xhr.dt', function ( e, settings, json, xhr ) {
				// if(json.recordsTotal == 0){
					 // json.aaData = new Array();
				// }
				if(json=="123"){
					CommonNopower();
					$("#Maincontainer").addClass("hidden");
					return;
				}
				if(json==null){
					CommonJustTip('暂无数据。');
					return;
				}
			} );
		}

		function ShowscoreobtainInfo(id,page){
			$("#scoreobtainTable").html("");
			$("#kkpager").html("");
			$('#scoreobtainInfo').modal({backdrop: 'static', keyboard: false});
			url = "scoreobtain.ajax.php?mode=SpokesmanScoreDetail&custid="+id+"&currentpage="+page;;
			$.post(url,function(json,status){
				json = eval("("+json+")");
				data = json.data;
				console.log(data);
				if(data=="null"){
					CommonJustTip('暂无数据。');
					return;
				}
				for(var i=0;i<data.length;i++){	
					var operator = "---";
					if(data[i].nickname != null){
						operator = data[i].nickname;
					}else if(data[i].changeuser != ""){
						operator = data[i].changeuser;
					}
					
					if(data[i].custimg != null){
						var strImg = '<td><img style="width:50px;height:50px;" src="'+data[i].custimg+'"></td>'
					}else{
						var strImg = '<td>---</td>'
					}
					
					var custnickname = data[i].custnickname;
					var custname = data[i].custname;
					var custmobile = data[i].custmobile;
					if(data[i].custnickname == null){custnickname = "---"; }
					if(data[i].custname == null){custname = "---"; }
					if(data[i].custmobile == null){custmobile = "---"; }
					
					var strTbody = '<tr><td>'+data[i].reason+'</td><td>'+data[i].beforescore+'</td>';
					strTbody+= '<td>'+data[i].changescore+'</td><td>'+data[i].afterscore+'</td>';
					strTbody+= strImg;
					strTbody+= '<td>'+custnickname+'</td><td>'+custname+'</td><td>'+custmobile+'</td>';
					strTbody+= '<td>'+operator+'</td><td>'+data[i].operattime+'</td></tr>';
					$("#scoreobtainTable").append(strTbody);
				}
				kkpager.generPageHtml({
					pno : page,
					total : json.pagecount,
					totalRecords : json.total,
					mode : 'click',//默认值是link，可选link或者click
					click : function(n){
						ShowscoreobtainInfo(id,n)
						return false;
					}
				} , true);
			});
		}
   </script> 
</html>