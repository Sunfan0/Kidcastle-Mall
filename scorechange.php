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
			  <div class="modal-dialog" style="width:900px;">  
				<div class="modal-content message_align">  
				  <div class="modal-header">  
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>  
				  </div>  
				  <div class="modal-body text-center">  
					<table class="table  table-bordered">
						<thead>
							<tr>
								<th colspan='2' style='text-align:center'>用户积分调整</th>
							</tr>
						</thead>
						<tr>
							<td>用户</td>
							<td>
								<img id="userimg" style='width:50px;height:50px;' src=''>
								<span id="username"></span>
							</td>
						</tr>
						<tr>
							<td>当前可用积分</td>
							<td>
								<span id="userscore"></span>
							</td>
						</tr>
						<tr>
							<td colspan='2'>
								<button type="button" class="btn btn-primary " id="changescore">调整</button>
							</td>
						</tr>
						<tr>
							<td>积分履历</td>
							<td>
								<table class="table table-bordered">
									<thead>
										<tr>
											<th style="text-align: center;">变更理由</th>
											<th style="text-align: center;">变更前</th>
											<th style="text-align: center;">变更</th>
											<th style="text-align: center;">变更后</th>
											<th style="text-align: center;">操作员</th>
											<th style="text-align: center;">操作时间</th>
										</tr>
									</thead>
									<tbody id='scoreobtainTable'></tbody>
								</table>	
							</td>
						</tr>
					</table>	
				  </div>   
				</div>
			  </div>
			</div>
			
			<div class="modal fade" id="scorechangeinfo" >  
			  <div class="modal-dialog" style="width:900px;">  
				<div class="modal-content message_align">  
				  <div class="modal-header">  
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>  
				  </div>  
				  <div class="modal-body text-center">  
					<table class="table table-bordered">
						<thead>
							<tr>
								<th colspan='2' style='text-align:center'>用户积分调整</th>
							</tr>
						</thead>
						<tr>
							<td>用户</td>
							<td>
								<img id="userimg1" style='width:50px;height:50px;' src=''>
								<span id="username1"></span>
							</td>
						</tr>
						<tr>
							<td>当前可用积分</td>
							<td>
								<span id="userscore1"></span>
							</td>
						</tr>
						<tr>
							<td>调整</td>
							<td>
								<table class="table  table-bordered">
									<tr>
										<td>
											<label><input type="radio" name="changeCheckbox" class="changeCheckbox" value="1">增加</label>
											<label><input type="radio" name="changeCheckbox"  class="changeCheckbox" value="-1">扣除</label>
										</td>
									</tr>
									<tr>
										<td><input type="text" id="changenum" placeholder="调整积分数值" /></td>
									</tr>
									<tr>
										<td><input type="text" id="changereason" placeholder="调整理由" /></td>
									</tr>
								</table>	
							</td>
						</tr>
						<tr>
							<td colspan='2'>
								<button type="button" class="btn btn-primary " id="updatescore">更新</button>
							</td>
						</tr>
						
					</table>	
				  </div>   
				</div>
			  </div>
			</div>
		</div>
	</body>
	<?php	include "footer.php";	?>
	<script type="text/javascript">

		var GotListTable;
		var setid;
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
					$('#scoreobtainInfo').modal('toggle');
					ShowUserInfo(GotListTable.row('.selected').data().id);
				}
			}); 
			$("#changescore").click(function(){
				$("#changenum").val('');
				$("#changereason").val('');
				$('#scorechangeinfo').modal('toggle');
				url = "scorechange.ajax.php?mode=ShowUserInfo&custid="+setid;
				$.post(url,function(json,status){
					data = eval("("+json+")");
					$("#userimg1").attr('src',data.imgurl);
					$("#username1").html(data.nickname);
					$("#userscore1").html(data.score);
				});
			})
			$("#updatescore").click(function(){
				changetype = $(".changeCheckbox:checked").val();
				changenum=$("#changenum").val();
				changereason=$("#changereason").val();
				url = "scorechange.ajax.php?mode=UpdateUserScore&custid="+setid;
				url+="&type="+changetype;
				url+="&scorenum="+changenum;
				url+="&scorereason="+changereason;
				$.post(url,function(json,status){
					data = eval("("+json+")");
					switch(data){
						case -1:
						case -2:
							CommonJustTip('操作失败，请重试！');
							break;
						case 1:
							CommonJustTip('操作成功！');
							$('#scorechangeinfo').modal('toggle');
							ShowUserInfo(setid);
							//ShowscoreobtainInfo(setid);//数据更新
							break;
					}
				});
			})
		}
		
		function ShowscoreobtainList(){
			GotListTable = $('#scoreobtainList').DataTable({
				"ajax": {
					"url":"scorechange.ajax.php?mode=SpokesmanScore",
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
				if(json.recordsTotal == 0){
					 json.aaData = new Array();
				}
				if(json=="123"){
					CommonNopower();
					$("#Maincontainer").addClass("hidden");
					return;
				}
			} );
		}
		function ShowUserInfo(id){
			
			url = "scorechange.ajax.php?mode=ShowUserInfo&custid="+id;
			$.post(url,function(json,status){
				data = eval("("+json+")");
				$("#userimg").attr('src',data.imgurl);
				$("#username").html(data.nickname);
				$("#userscore").html(data.score);
				ShowscoreobtainInfo(id);
			});
			setid=id;
		}
		function ShowscoreobtainInfo(id){
			$("#scoreobtainTable").html("");
			url = "scorechange.ajax.php?mode=SpokesmanScoreDetail&custid="+id;
			$.post(url,function(json,status){
				if(json=="null"){
					CommonJustTip('暂无数据。');
					return;
				}
				json = eval("("+json+")");
				for(var i=0;i<json.length;i++){	
					var operator = json[i].changeuser;
					if(operator==null){
						operator = "---";
					}
					strTbody = '<tr><td>'+json[i].reason+'</td><td>'+json[i].beforescore+'</td>';
					strTbody+= '<td>'+json[i].changescore+'</td><td>'+json[i].afterscore+'</td>';
					strTbody+= '<td>'+operator+'</td><td>'+json[i].operattime+'</td></tr>';
					$("#scoreobtainTable").append(strTbody);
				}
			});
		}
   </script> 
</html>