<?php	include "header.php";	?>

		<div id="Maincontainer" class="container" style="margin-top:30px;">			
			<nav class="navbar navbar-default" role="navigation">
				<div class="container-fluid">
					<form class="navbar-form navbar-left" role="search">
						<!--<button id="ChangeBtn" class="btn btn-primary text-left" onclick="ShowCommodityChange();return false;">查看商品兑换列表</button>&nbsp;&nbsp;&nbsp;
						<button id="SendBtn" class="btn btn-default text-left" onclick="ShowCommoditySend();return false;">查看商品兑换并领取列表</button>
						-->
						<div class="radio" style="margin-right:20px;">
							<label>
								<input type="radio" name="SeeCheckbox" class="SeeCheckbox" value="EditGoodsGotList" checked="checked"> 查看全部
							</label>
						</div>
						<div class="radio" style="margin-right:20px;">
							<label>
								<input type="radio" name="SeeCheckbox" class="SeeCheckbox" value="EditGoodsNoUsedList"> 仅查看未领取
							</label>
						</div>
						<div class="radio" style="margin-right:20px;">
							<label>
								<input type="radio" name="SeeCheckbox" class="SeeCheckbox" value="EditGoodsUsedList"> 仅查看已领取
							</label>
						</div>
						<!--<div class="input-group" style="margin-right:120px;">
							<span class="input-group-addon">商品名称</span>
							<input id="SearchInput" type="text" class="form-control"/>
							<span id="SearchBtn" class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
						</div>-->
					</form>	
					<!--
					<form class="navbar-form navbar-right" role="search">
						<button type="button" class="btn btn-primary dropdown-toggle" id="dropdownMenu2" data-toggle="dropdown">
							<span>排序方式</span><span class="caret"></span>
						</button>
						<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
							<li role="presentation">
								<a id="sortId" role="menuitem" tabindex="-1" href="#">按照商品Id排序</a>
							</li>
							<li role="presentation">
								<a id="sortName" role="menuitem" tabindex="-1" href="#">按照商品名称排序</a>
							</li>
						</ul>
					</form>	-->		
				</div>
			</nav>
			<table id="CommodityChange" class="table table-hover table-bordered">
				<thead>
					<tr>
						<th>ID</th>
						<th>商品名称</th>
						<th>用户头像</th>
						<th>昵称</th>
						<th>姓名</th>
						<th>电话</th>
						<th>兑换时间</th>
						<th>所需积分</th>
						<th id="grantName">发放人员姓名</th>
						<th id="grantPhone">发放人员电话</th>
						<th id="useTime">使用时间</th>
					</tr>
				</thead>
				<tbody id='CommodityTable'></tbody>
			</table>
		</div>
	</body>
	<?php	include "footer.php";	?>
	<script type="text/javascript">

		var GotListTable;
		
		window.onload = OnLoad;

		function OnLoad(){
			BindEvents();
			ShowGoodsGotList("EditGoodsGotList");
		}
		
		function BindEvents(){
			$(".SeeCheckbox").each(function(){
				$(this).click(function(){
					GotListTable.destroy();	//销毁当前上下文中的datatables实例
					ShowGoodsGotList($(this).val());
				});
			});
			// $("#sortId").click(function(){
				// ShowCommoditySend("id");
			// })
			// $("#sortName").click(function(){
				// ShowCommoditySend("name");
			// })
		}
		
		function ShowGoodsGotList(mode){
			GotListTable = $('#CommodityChange').DataTable({
				"ajax": {
					"url":"commoditygot.ajax.php?mode="+mode,
					"type":"POST"
				},
				//"processing": true,//加载效果
				"serverSide": true,//页面在加载时就请求后台，以及每次对 datatable 进行操作时也是请求后台
				"pageLength": 40,//每页显示的数据量
				"columns": [//datatable每一列所对应的数据显示内容
					{ "data": "id"},
					{ "data": "goodsname"},
					{ "data": "imgurl"},
					{ "data": "nickname"},
					{ "data": "name"},
					{ "data": "mobile"},
					{ "data": "ordertime"},
					{ "data": "score"},
					{ "data": "salername"},
					{ "data": "salermobile"},
					{ "data": "scantime"}
				],	
				// "searching": false,
				"columnDefs":[
					{
						"targets":2,
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
		



		// function ShowCommoditySend(e){
			// $("#CommodityTable").html("");
			// Settings.ListName = "commoditySend";
			// $("#grantName").css('display','');
			// $("#grantPhone").css('display','');
			// $("#useTime").css('display','');
			// var commodityname = $("#SearchInput").val();
			
			// url = "commoditygot.ajax.php?mode=EditGoodsUsedList";
			// if(e == "name"){
				// url = "commoditygot.ajax.php?mode=SearchNameGotUsed&commodityname="+commodityname;
			// }
			// $.get(url,function(json,status){
				// if(json=="null"){
					// CommonJustTip('暂无数据。');
					// return;
				// }
				// json = eval("("+json+")");
				// console.log(json);
				// for(var i=0;i<json.length;i++){	
					// strTbody = '<tr id="'+Settings.ListName+''+(i+1)+'"><td>'+(i+1)+'</td><td>'+json[i].goodsname+'</td>';
					// strTbody+= '<td><img style="width:50px;height:50px;" src="'+json[i].imgurl+'"></td><td>'+json[i].nickname+'</td>';
					// strTbody+= '<td>'+json[i].name+'</td><td>'+json[i].mobile+'</td><td>'+json[i].ordertime+'</td><td>'+json[i].score+'</td>';
					// strTbody+= '<td>'+json[i].salername+'</td><td>'+json[i].salermobile+'</td><td>'+json[i].scantime+'</td>';
					// $("#CommodityTable").append(strTbody);
				// }
			// });
		// }
   </script> 
</html>