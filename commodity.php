<?php	include "header.php";	?>

		<div id="Maincontainer" class="container" style="margin-top:30px;">
			<nav class="navbar navbar-default" role="navigation">
				<div class="container-fluid">
					<!--<form class="navbar-form navbar-left" role="search">
						<button class="btn btn-primary text-left" onclick="ShowCommodityChange();return false;">查看商品兑换列表</button>&nbsp;&nbsp;&nbsp;
						<button class="btn btn-primary text-left" onclick="ShowCommoditySend();return false;">查看商品兑换并领取列表</button>
					</form>		-->
					<form class="navbar-form navbar-right" role="search">
						<button class="btn btn-primary text-right" onclick="AddInfo(); return false;">+ 新增商品</button>
					</form>							
				</div>
			</nav>
			<table id="ContentTable" class="table table-hover table-bordered"></table>
			<div class="modal fade" id="CommodityInfo">  
			  <div class="modal-dialog" style="width:700px;">  
				<div class="modal-content message_align">  
				  <div class="modal-header">  
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>  
					<h5 id="CommodityTitle" class="modal-title">修改信息</h5>  
				  </div>  
				  <div class="modal-body text-center">  
					<form class="form-horizontal">
						<div class="form-group">
							<label for="CommodityImgBtn" class="col-sm-2 control-label">商品头图</label>
							<div class="col-sm-10" style="text-align: left;">
								<input type="file" id="CommodityImgBtn" type="file" name="CommodityImgBtn" multiple>
								<img id="CommodityImg" style="width:100px;">
								<span id="CommodityText" name="CommodityText"></span>
							</div>
						</div>
						<div class="form-group">
							<label for="CommodityName" class="col-sm-2 control-label">商品名称</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="CommodityName">
							</div>
						</div>
						<div class="form-group">
							<label for="CommodityDescribe" class="col-sm-2 control-label">简单描述</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="CommodityDescribe">
							</div>
						</div>
						<div class="form-group">
							<label for="CommodityDescription1" class="col-sm-2 control-label">详细描述1</label>
							<div class="col-sm-10">
								<button id="GoDescription1" class="btn btn-default  btn-block">︾&nbsp;&nbsp;&nbsp;展开</button>
								<div id="CommodityDescription1" type="text/plain" style="margin-top:30px;width:550px;height:550px;display:none;"></div>
							</div>
						</div>
						<div class="form-group">
							<label for="CommodityDescription2" class="col-sm-2 control-label">详细描述2</label>
							<div class="col-sm-10">
								<button id="GoDescription2" class="btn btn-default  btn-block">︾&nbsp;&nbsp;&nbsp;展开</button>
								<div id="CommodityDescription2" type="text/plain" style="margin-top:30px;width:550px;height:550px;display:none;"></div>
							</div>
						</div>
						<div class="form-group">
							<label for="CommodityDescription3" class="col-sm-2 control-label">详细描述3</label>
							<div class="col-sm-10">
								<button id="GoDescription3" class="btn btn-default  btn-block">︾&nbsp;&nbsp;&nbsp;展开</button>
								<div id="CommodityDescription3" type="text/plain" style="margin-top:30px;width:550px;height:550px;display:none;"></div>
							</div>
						</div>
						<div class="form-group">
							<label for="CommodityPrice1" class="col-sm-3 control-label">正常价格</label>
							<div class="col-sm-3">
								<input type="number" class="form-control" id="CommodityPrice1">
							</div>
							<label for="CommodityScore1" class="col-sm-3 control-label">正常积分</label>
							<div class="col-sm-3">
								<input type="number" class="form-control" id="CommodityScore1">
							</div>
						</div>
						<!--
						<div class="form-group">
							<label for="CommodityPrice2" class="col-sm-3 control-label">续费折扣价格</label>
							<div class="col-sm-3">
								<input type="number" class="form-control" id="CommodityPrice2">
							</div>
							<label for="CommodityScore2" class="col-sm-3 control-label">续费折扣积分</label>
							<div class="col-sm-3">
								<input type="number" class="form-control" id="CommodityScore2">
							</div>
						</div>
						<div class="form-group">
							<label for="CommodityPrice3" class="col-sm-3 control-label">积分抵扣价格</label>
							<div class="col-sm-3">
								<input type="number" class="form-control" id="CommodityPrice3">
							</div>
							<label for="CommodityScore3" class="col-sm-3 control-label">积分抵扣积分</label>
							<div class="col-sm-3">
								<input type="number" class="form-control" id="CommodityScore3">
							</div>
						</div>-->
						<div class="form-group">
							<label class="col-sm-2 control-label">商品类型</label>
							<div class="col-sm-7" style="margin-top:7px;" onclick="ModifyType();">
								<select class="form-control" id="CommodityType">
									<option value="10">实物商品</option>
									<option value="80">不限量虚拟商品</option>
									<option value="90">限量虚拟商品</option>
								</select>
							</div>
							<div class="checkbox col-sm-3">
								<input type="number" class="form-control" id="CommodityTypeNumber" placeholder="请输入限制数量">
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<input type="text" class="form-control" id="CommodityTypeInput">
								<textarea id="CommodityTypeTextarea"  class="form-control" rows="3" style="display:none;" ></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="CommodityExplain" class="col-sm-2 control-label">商品说明</label>
							<div class="col-sm-10">
								<textarea id="CommodityExplain"  class="form-control" rows="3"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">当前状态</label>
							<div class="col-sm-5">
								<input type="text" class="form-control" id="CommodityStatus" readonly>
							</div>
							<div class="col-sm-2">
								<button class="btn btn-primary text-right" id="CommodityPreview">预览</button>
							</div>
							<div class="checkbox col-sm-3">
								<label>
									<input type="checkbox" id="CommodityRelease"></input><span id="CommodityReleaseText">发布商品</span>
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
			<div class="modal fade" id="CommodityChange">  
			  <div class="modal-dialog" style="width:1000px;">  
				<div class="modal-content message_align">  
				  <div class="modal-header">  
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>  
					<h5 id="CommodityChangeTitle" class="modal-title">商品兑换列表</h5>  
				  </div>  
				  <div class="modal-body text-center">  
					<table class="table table-hover table-bordered">
						<thead>
							<tr>
								<th>ID</th>
								<th>用户头像</th>
								<th>昵称</th>
								<th>姓名</th>
								<th>电话</th>
								<th>兑换商品名称</th>
								<th>商品类型</th>
								<th>兑换时间</th>
								<th>所需积分</th>
								<th id="grantName">发放人员姓名</th>
								<th id="grantPhone">发放人员姓名</th>
								<th id="useTime">使用时间</th>
							</tr>
						</thead>
						<tbody id='CommodityTable'></tbody>
					</table>	
				  </div>   
				</div>
			  </div>
			</div>
			<div class="modal fade" id="CommodityPreviewPage">  
			  <div class="modal-dialog" style="width:375px;margin-top:60px;">  
				<div class="modal-content message_align" style="height:667px;overflow-y:auto;overflow-x:hidden;">  
				  <div class="modal-header">  
					<button  style="margin-top: -10px" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>  
				  </div>  
				  <div class="modal-body" style="padding:0px;">
					<div class="container" style="background-color:white;text-align:left;width:375px;">
						<div class="PreviewRow">
							<div class="row" style="background-color:#d9edf7;height:180px;padding:0px;">
								<img id="PreviewPageImg" src="" style="width:100%;height:100%;">
							</div>
							<div class="row">
								<div class="col-xs-8">
									<p id="PreviewPageTitle" style="font-size:16px;"></p>
								</div>
								<div class="col-xs-4 colRight">
									<button type="button" class="btn btn-primary btn-sm" id="PreviewPageBtn">兑换</button>
								</div>
							</div>
							<div class="row" style="padding: 0px 25px;color:#767876;font-size:14px;">
								<p id="PreviewPageshortdesc" style="word-break:break-all;"></p>
							</div>
							<div class="row" style="padding:0px;">
								<div id="PreviewPagedescription1" class="row" style="margin:10px;padding: 10px 20px;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;background-color:white;">
									
								</div>
								<div id="PreviewPagedescription2" class="row" style="margin:10px;padding: 10px 20px;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;background-color:white;">
									
								</div>
								<div id="PreviewPagedescription3" class="row" style="margin:10px;padding: 10px 20px;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;background-color:white;">
									
								</div>
								<div class="row" style="margin:10px;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;background-color:white;">
									<div class="col-xs-5" style="color:#404340;">商品库存</div>
									<div id="PreviewPagecount" class="col-xs-7"></div>
								</div>
								<div class="row" style="margin:10px;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;background-color:white;">
									<div class="col-xs-5" style="color:#404340;">正常价格</div>
									<div id="PreviewPageprice1" class="col-xs-7"></div>
								</div>
								<div class="row" style="margin:10px;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;background-color:white;">
									<div class="col-xs-5" style="color:#404340;">正常积分</div>
									<div id="PreviewPagescore1" class="col-xs-7"></div>
								</div>
								<!--
								<div class="row" style="margin:10px;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;background-color:white;">
									<div class="col-xs-5" style="color:#404340;">续费折扣价格</div>
									<div id="PreviewPageprice2" class="col-xs-7"></div>
								</div>
								<div class="row" style="margin:10px;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;background-color:white;">
									<div class="col-xs-5" style="color:#404340;">续费折扣积分</div>
									<div id="PreviewPagescore2" class="col-xs-7"></div>
								</div>
								<div class="row" style="margin:10px;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;background-color:white;">
									<div class="col-xs-5" style="color:#404340;">积分抵扣价格</div>
									<div id="PreviewPageprice3" class="col-xs-7"></div>
								</div>
								<div class="row" style="margin:10px;">
									<div class="col-xs-5" style="color:#404340;">积分抵扣积分</div>
									<div id="PreviewPagescore3" class="col-xs-7"></div>
								</div>-->
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

		window.onload = OnLoad;

		<?php $timestamp = time();?>
		
		function OnLoad(){
			BindEvents();
			ShowCommodityList();
		}
		function BindEvents(){
			var ue = UE.getEditor('CommodityDescription1');
			var ue = UE.getEditor('CommodityDescription2');
			var ue = UE.getEditor('CommodityDescription3');
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
			
			$("#CommodityPreview").click(function(){
				ShowCommodityPreview();
				return false;
			})	
			
			$('#CommodityImgBtn').uploadify ({ //以下参数均是可选  
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
					$("#CommodityImg").removeClass('hidden');
					$("#CommodityImg").css("display","block");
					$("#CommodityImg").attr("src",'uploadify/upload/'+data);
					// $("#CommodityText").text(data);
				}
			});
		}
		function GoDescriptionStatus(id,status){
			switch(status){
				case 1:
					$("#CommodityDescription"+id).css('display',''); 
					$("#GoDescription"+id).html("︽&nbsp;&nbsp;&nbsp;收起");
					break;
				case -1:
					$("#CommodityDescription"+id).css('display','none'); 
					$("#GoDescription"+id).html("︾&nbsp;&nbsp;&nbsp;展开");
					break;
			}
		}
		

		function ShowCommodityList(){
			$("#ContentTable").html("");
			Settings.ListName = "commodity";
			strTable = "<thead><tr><th>ID</th><th>商品名称</th><th>商品类型</th><th>发布状态</th><th>操作</th></tr></thead><tbody id='contentTbody'></tbody>"	
			$("#ContentTable").append(strTable);
			url = "commodity.ajax.php?mode=EditGoodsList";
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
					switch(json[i].type){
						case "10":
							var type = "实物商品";
							break;
						case "80":
							var type = "不限量虚拟商品";
							break;
						case "90":
							var type = "限量虚拟商品";
							break;
					}
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
					strTbody = '<tr id="'+Settings.ListName+''+(i+1)+'"><td>'+(i+1)+'</td><td>'+json[i].name+'</td><td>'+type+'</td><td>'+status+'</td>';
					strTbody += '<td><button class="btn btn-primary btn-sm" onclick="ModifyInfo('+json[i].id+')">编辑</button>&nbsp;&nbsp;&nbsp;';
					strTbody += '<button class="btn btn-primary btn-sm" onclick="ShowOnecommodityChange('+json[i].id+')">查看兑换列表</button>&nbsp;&nbsp;&nbsp;';
					strTbody += '<button class="btn btn-primary btn-sm" onclick="ShowOnecommoditySend('+json[i].id+')">查看兑换并领取列表</button></td></tr>';
					$("#contentTbody").append(strTbody);
				}
			});
		}
		function ShowOnecommodityChange(id){
			$("#CommodityTable").html("");
			$('#CommodityChangeTitle').text("商品兑换列表");
			Settings.ListName = "commodityChange";
			$("#grantName").css('display','none');
			$("#grantPhone").css('display','none');
			$("#useTime").css('display','none');
			url = "commodity.ajax.php?mode=CurrentEditGoodsGotList&id="+id;
			$.get(url,function(json,status){
				if(json=="null"){
					CommonJustTip('暂无数据。');
					return;
				}
				$('#CommodityChange').modal('toggle');
				json = eval("("+json+")");
				console.log(json);
				for(var i=0;i<json.length;i++){	
					switch(json[i].type){
						case "10":
							var type = "实物商品";
							break;
						case "80":
							var type = "不限量虚拟商品";
							break;
						case "90":
							var type = "限量虚拟商品";
							break;
					}
					
					strTbody = '<tr id="'+Settings.ListName+''+i+'"><td>'+i+'</td>';
					strTbody+= '<td><img style="width:50px;height:50px;" src="'+json[i].imgurl+'"></td><td>'+json[i].nickname+'</td>';
					strTbody+= '<td>'+json[i].name+'</td><td>'+json[i].mobile+'</td><td>'+json[i].goodsname+'</td><td>'+type+'</td>';
					strTbody+= '<td>'+json[i].ordertime+'</td><td>'+json[i].score+'</td>';
					$("#CommodityTable").append(strTbody);
				}
			});
		}
		function ShowOnecommoditySend(id){
			$("#CommodityTable").html("");
			$('#CommodityChangeTitle').text("商品兑换并领取列表");
			Settings.ListName = "commoditySend";
			$("#grantName").css('display','');
			$("#grantPhone").css('display','');
			$("#useTime").css('display','');
			url = "commodity.ajax.php?mode=CurrentEditGoodsUsedList&id="+id;
			$.get(url,function(json,status){
				if(json=="null"){
					CommonJustTip('暂无数据。');
					return;
				}
				$('#CommodityChange').modal('toggle');
				json = eval("("+json+")");
				console.log(json);
				for(var i=0;i<json.length;i++){	
					switch(json[i].type){
						case "10":
							var type = "实物商品";
							break;
						case "80":
							var type = "不限量虚拟商品";
							break;
						case "90":
							var type = "限量虚拟商品";
							break;
					}
					
					strTbody = '<tr id="'+Settings.ListName+''+i+'"><td>'+i+'</td>';
					strTbody+= '<td><img style="width:50px;height:50px;" src="'+json[i].imgurl+'"></td><td>'+json[i].nickname+'</td>';
					strTbody+= '<td>'+json[i].name+'</td><td>'+json[i].mobile+'</td><td>'+json[i].goodsname+'</td><td>'+type+'</td>';
					strTbody+= '<td>'+json[i].ordertime+'</td><td>'+json[i].score+'</td><td>'+json[i].salername+'</td>';
					strTbody+= '<td>'+json[i].salermobile+'</td><td>'+json[i].scantime+'</td>';
					$("#CommodityTable").append(strTbody);
				}
			});
		}
		
		function ModifyType(e){
			var type = e;
			if(type == undefined){
				type = $("#CommodityType").val(); 
			}
			switch(type){
				case "10":
					$("#CommodityTypeInput").css('display','none'); 
					$("#CommodityTypeTextarea").css('display','none'); 
					break;
				case "80":
					$("#CommodityTypeInput").css('display',''); 
					$("#CommodityTypeTextarea").css('display','none'); 
					break;
				case "90":
					$("#CommodityTypeInput").css('display','none'); 
					$("#CommodityTypeTextarea").css('display',''); 
					break;
			}
		}
		
		function ModifyInfo(id){
			Settings.EditState = "modify";
			Settings.ModifyInfoId = id;
			$('#CommodityInfo').modal({backdrop: 'static', keyboard: false});
			$('#CommodityTitle').text("修改信息");
			$("#CommodityRelease").prop("checked", false);
			$("#CommodityTypeNumber,#CommodityTypeInput,#CommodityTypeTextarea").val("");
			$('[id^="CommodityDescription"]').css('display','none'); 
			$('[id^="GoDescription"]').html("︾&nbsp;&nbsp;&nbsp;展开");
			$("#CommodityTypeTextarea").attr("readonly","readonly");
			$("#CommodityImg").addClass('hidden');
			
			url = "commodity.ajax.php?mode=ShowEditGoods&id="+Settings.ModifyInfoId;
			$.get(url,function(json){
				json = eval("("+json+")");
				console.log(json);
				Settings.Currentstatus = json.status;
				switch(json.status){
					case "0":
						var status = "未发布";
						$("#CommodityReleaseText").html("发布商品");
						break;
					case "1":
						var status = "已发布";
						$("#CommodityReleaseText").html("撤销发布");
						break;
					case "-1":
						var status = "已撤销发布";
						$("#CommodityReleaseText").html("重新发布");
						break;
				}
				
				if(json.imgurl != ""){
					$("#CommodityImg").removeClass('hidden');
				}
				
				$("#CommodityImg").attr("src",json.imgurl);
				
				$("#CommodityType").val(json.type);
				$("#CommodityTypeNumber").val(json.count);
				$("#CommodityTypeInput").val(json.commoditycode);
				var strTextarea ="";
				if(json.code90 != null){
					for(a=0;a<json.code90.length;a++){
						strTextarea += json.code90[a].code + "\r\n";
					}
				}
				$("#CommodityTypeTextarea").val(strTextarea);
				$("#CommodityStatus").val(status);
				$("#CommodityName").val(json.name);
				$("#CommodityExplain").val(json.explaintext);
				$("#CommodityDescribe").val(json.shortdesc);
				UE.getEditor('CommodityDescription1').setContent(json.description1);
				UE.getEditor('CommodityDescription2').setContent(json.description2);
				UE.getEditor('CommodityDescription3').setContent(json.description3);
				$("#CommodityPrice1").val(json.price1);
				$("#CommodityPrice2").val(json.price2);
				$("#CommodityPrice3").val(json.price3);
				$("#CommodityScore1").val(json.score1);
				$("#CommodityScore2").val(json.score2);
				$("#CommodityScore3").val(json.score3);
				ModifyType();
			});
		}
		function AddInfo(){
			Settings.EditState = "add";
			Settings.Currentstatus = "0";
			$('#CommodityInfo').modal({backdrop: 'static', keyboard: false});
			$('#CommodityTitle').text("填写信息");
			$("#CommodityStatus").val("未发布");
			$("#CommodityReleaseText").html("发布课程");
			$("#CommodityRelease").prop("checked", false);
			$("#CommodityName,#CommodityExplain,#CommodityDescribe,#CommodityTypeNumber,#CommodityTypeInput,#CommodityTypeTextarea").val("");
			UE.getEditor('CommodityDescription1').setContent("");
			UE.getEditor('CommodityDescription2').setContent("");
			UE.getEditor('CommodityDescription3').setContent("");
			$('[id^="CommodityPrice"]').val("");
			$('[id^="CommodityScore"]').val("");
			$('[id^="CommodityDescription"]').css('display','none'); 
			$('[id^="GoDescription"]').html("︾&nbsp;&nbsp;&nbsp;展开");
			$("#CommodityTypeTextarea").removeAttr("readonly");
			$("#CommodityType").val("10");
			$("#CommodityImg").addClass('hidden');
			$("#CommodityImg").attr("src","");
			ModifyType("10");
		}
		function SaveInfo(){
			var flagid = "";
			if(Settings.EditState == "modify"){
				flagid = Settings.ModifyInfoId;
			}
			var publishid = Settings.Currentstatus;	//提交当前新状态--不做改变
			if($("#CommodityRelease").is(":checked")){
				switch(Settings.Currentstatus){
					case "0":
						publishid = "1";	//未发布-->发布
						break;
					case "1":
						publishid = "-1";	//已发布-->撤销发布
						break;
					case "-1":
						publishid = "1";	//已撤销发布-->发布
						break;
				}
			}
			var picurl = $("#CommodityImg").attr("src");
			var name = $("#CommodityName").val();
			var explaintext = $("#CommodityExplain").val();
			var shortdesc = $("#CommodityDescribe").val();
			var description1 = UE.getEditor('CommodityDescription1').getContent();
			var description2 = UE.getEditor('CommodityDescription2').getContent();
			var description3 = UE.getEditor('CommodityDescription3').getContent();
			var price1 = $("#CommodityPrice1").val();
			var price2 = $("#CommodityPrice2").val();
			var price3 = $("#CommodityPrice3").val();
			var score1 = $("#CommodityScore1").val();
			var score2 = $("#CommodityScore2").val();
			var score3 = $("#CommodityScore3").val();
			var type = $("#CommodityType").val();
			var count = $("#CommodityTypeNumber").val();
			var code = $("#CommodityTypeInput").val();
			/* switch(type){
				case "10":
					code = "";
					break;
				case "80":
					code = $("#CommodityTypeInput").val();
					break;
				case "90":
					count = $("#CommodityTypeNumber").val();
					code = $("#CommodityTypeTextarea").val();
					var newcount = 0;
					var newcode = "";
					var oldcode= new Array();
					oldcode = $("#CommodityTypeTextarea").val().split(/[\r\n]/g);
					for (i=0;i<oldcode.length;i++ ){
						if(oldcode[i] == ""){
							continue;
						}
						if(i == oldcode.length){
							newcode += oldcode[i];
						}else{
							newcode += oldcode[i]+"\r\n";
						}
						newcount++;
					}
					console.log(newcode);
					if(newcount != count){
						CommonWarning('请确保您限制数量与输入兑换码的数量一致！');
						return;
					} 
					break;
			}*/
			
			if(price1 == "" || price1 == undefined){price1 = 0;}
			if(price2 == "" || price2 == undefined){price2 = 0;}
			if(price3 == "" || price3 == undefined){price3 = 0;}
			if(score1 == "" || score1 == undefined){score1 = 0;}
			if(score2 == "" || score2 == undefined){score2 = 0;}
			if(score3 == "" || score3 == undefined){score3 = 0;}
			if(count == ""){count = 0;}

			if($("#CommodityName").val() == ""){
				CommonWarning('商品名称不能为空！');
				return;
			}
			
			if($("#CommodityDescribe").val() == ""){
				CommonWarning('简单描述不能为空！');
				return;
			}

			url = "commodity.ajax.php?mode=UpdateEditGoods";
			$.post(url, {
				flagid : flagid,
				publishid : publishid,		//判断是发布还是提交信息//只提交信息0，发布1，撤销-1
				name : name,
				picurl : picurl,
				explaintext : explaintext,
				shortdesc : shortdesc,
				description1 : description1,
				description2 : description2,
				description3 : description3,
				price1 : price1,
				price2 : price2,
				price3 : price3,
				score1 : score1,
				score2 : score2,
				score3 : score3,
				count : count,
				type : type,	//商品类型(10实物商品80不限量虚拟商品90限量虚拟商品)
				code : code				
			} ,function(json,status){
				// console.log(json);
				switch (json){
					case "1":
						ShowCommodityList();
						$('#CommodityInfo').modal('toggle');
						break;
					case "-99":
						CommonWarning('请确保您限制数量与输入兑换码的数量一致！');
						break;
					default:
						CommonWarning('服务器忙，请稍候再试。');
				}
			});
		}
		function ShowCommodityPreview(){
			var price1 = $("#CommodityPrice1").val();
			var price2 = $("#CommodityPrice2").val();
			var price3 = $("#CommodityPrice3").val();
			var score1 = $("#CommodityScore1").val();
			var score2 = $("#CommodityScore2").val();
			var score3 = $("#CommodityScore3").val();
			var count = $("#CommodityTypeNumber").val();
		
			if(price1 == "" || price1 == undefined){price1 = 0;}
			if(price2 == "" || price2 == undefined){price2 = 0;}
			if(price3 == "" || price3 == undefined){price3 = 0;}
			if(score1 == "" || score1 == undefined){score1 = 0;}
			if(score2 == "" || score2 == undefined){score2 = 0;}
			if(score3 == "" || score3 == undefined){score3 = 0;}
			if(count == ""){count = 0;}
		
			$("#PreviewPageImg").attr("src",$("#CommodityImg").attr("src"));
			$("#PreviewPageTitle").text($("#CommodityName").val());
			if(count <= 0){
				$("#PreviewPageBtn").attr("disabled", true);
			}
			$("#PreviewPageshortdesc").text($("#CommodityDescribe").val());
			
			$("#PreviewPagedescription1").html(UE.getEditor('CommodityDescription1').getContent());
			$("#PreviewPagedescription2").html(UE.getEditor('CommodityDescription2').getContent());
			$("#PreviewPagedescription3").html(UE.getEditor('CommodityDescription3').getContent());
			if(UE.getEditor('CommodityDescription1').getContent() == ""){
				$("#PreviewPagedescription1").addClass("hidden");
			}
			if(UE.getEditor('CommodityDescription2').getContent() == ""){
				$("#PreviewPagedescription2").addClass("hidden");
			}
			if(UE.getEditor('CommodityDescription3').getContent() == ""){
				$("#PreviewPagedescription3").addClass("hidden");
			}
			
			$("#PreviewPagecount").html(count);
			$("#PreviewPageprice1").html(price1);
			$("#PreviewPageprice2").html(price2);
			$("#PreviewPageprice3").html(price3);
			$("#PreviewPagescore1").html(score1);
			$("#PreviewPagescore2").html(score2);
			$("#PreviewPagescore3").html(score3);
			$('#CommodityPreviewPage').modal('toggle');
		}
   </script> 
</html>