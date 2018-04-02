<?php	include "header.php";	?>

		<div id="Maincontainer" class="container" style="margin-top:30px;">
			<nav class="navbar navbar-default" role="navigation">
				<div class="container-fluid">
					<form class="navbar-form navbar-right col-sm-3" role="search">
						<button class="btn btn-primary text-right" onclick="AddInfo(); return false;">+ 新增素材</button>
					</form>
				</div>
			</nav> 
			<div id="spokemanTable">
				<!--<div style="width:350px;height:245px;border:1px solid gray;border-radius:4px;float:left;margin:10px;">
					<div style="width:100%;text-align:center;line-height:30px;">创建时间：2016-08-09 16:00:06</div>
					<div style="width:94%;height:78%;margin:10px;border:1px solid gray;">
						<div onclick="ModifyInfo(1);" style="background: rgba(0,0,0,0.3); position: relative;border: 1px solid black; width: 100%;height: 100%;">
							<img alt="图片" src="" style="width: inherit;height: inherit;">
							<div style="top:151px;width:100%;height:35px;line-height:35px;background: black;opacity: 0.5;padding-left: 10px;position: absolute;color: white;"></div>
						</div>
					</div>
				</div>-->
			</div>
			
			<div class="modal fade" id="spokemanInfo">  
			  <div class="modal-dialog" style="width:900px;">  
				<div class="modal-content message_align">  
				  <div class="modal-header">  
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>  
					<h5 id="addTitle" class="modal-title">修改信息</h5>  
				  </div>  
				  <div class="modal-body text-center" style="font-weight: 600;">  
					<table class="table table-bordered">
						<tr>
							<td>素材内容</td>
							<td>
								<div style="width:350px;height:210px;border:1px solid gray;border-radius:4px;">
									<div style="width:94%;height:91%;margin:10px;border:1px solid gray;">
										<div onclick="EditArticle();" style="background: rgba(0,0,0,0.3); position: relative;border: 1px solid black; width: 100%;height: 100%;">
											<img id="showArticleImg" alt="图片" src="" style="width: inherit;height: inherit;">
											<div id="showArticleTitle" style="top: 150px;width:100%;height:35px;line-height:35px;background: black;opacity: 0.5;padding-left: 10px;position: absolute;color: white;"></div>
										</div>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td>分享信息</td>
							<td style="text-align:left;">
								<div class="row" style="padding: 10px;">
									<label for="shareTitle" class="col-sm-3 control-label">分享给好友的标题</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="shareTitle">
									</div>
								</div>
								<div class="row" style="padding: 10px;">
									<label for="shareDesc" class="col-sm-3 control-label">分享给好友的描述</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="shareDesc">
									</div>
								</div>
								<div class="row" style="padding: 10px;">
									<label for="sharetimeline" class="col-sm-3 control-label">分享朋友圈的标题</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="sharetimeline">
									</div>
								</div>
								<div class="row" style="padding: 10px;">
									<label for="shareImgBtn" class="col-sm-3 control-label">分享头图</label>
									<div class="col-sm-9" style="text-align: left;">
										<input type="file" id="shareImgBtn" type="file" name="shareImgBtn" multiple>
										<img id="shareImg" style="width:100px;">
										<span id="shareText" name="shareText"></span>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td>分享积分</td>
							<td style="text-align:left;">
								<div class="row" style="padding: 10px;">
									<label for="spokemanSharescore" class="col-sm-3 control-label">分享获取积分</label>
									<div class="col-sm-3">
										<input type="number" class="form-control" id="spokemanSharescore">
									</div>
									<label for="spokemanSharenumber" class="col-sm-3 control-label">分享次数限制</label>
									<div class="col-sm-3">
										<input type="number" class="form-control" id="spokemanSharenumber">
									</div>
								</div>
								<div class="row" style="padding: 10px;">
									<label for="spokemanClickscore" class="col-sm-3 control-label">邀请点击积分</label>
									<div class="col-sm-3">
										<input type="number" class="form-control" id="spokemanClickscore">
									</div>
									<label for="spokemanClicknumber" class="col-sm-3 control-label">邀请点击次数限制</label>
									<div class="col-sm-3">
										<input type="number" class="form-control" id="spokemanClicknumber">
									</div>
								</div>
								<div class="row" style="padding: 10px;">
									<label for="spokemanOrderscore" class="col-sm-3 control-label">邀请购买积分</label>
									<div class="col-sm-3">
										<input type="number" class="form-control" id="spokemanOrderscore">
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<div class="row" style="padding: 10px;">
									<label class="col-sm-2 control-label">当前状态</label>
									<div class="col-sm-5">
										<input type="text" class="form-control" id="spokemanStatus" readonly>
									</div>
									<div class="col-sm-2">
										<button class="btn btn-primary text-right" id="spokemanPreview">预览</button>
									</div>
									<div class="checkbox col-sm-3">
										<label>
											<input type="checkbox" id="spokemanRelease"></input><span id="spokemanReleaseText"></span>
										</label>
									</div>
								</div>
							</td>
						</tr>
					</table>
				  </div>  
				  <div class="modal-footer">
					<!--<button id="spokemanDeletInfo" onclick="ShowDeletPrompt()" style="margin-right:680px;" type="button" class="btn btn-danger">删除</button>-->
					 <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>  
					 <a  onclick="SaveInfo()" class="btn btn-success" data-dismiss="modal">保存</a>  
				  </div>  
				</div>
			  </div>
			</div>
			<div class="modal fade" id="spokemanPreviewPage">  
			  <div class="modal-dialog" style="width:375px;margin-top:60px;">  
				<div class="modal-content message_align" style="height:667px;overflow-y:auto;overflow-x:hidden;">  
				  <div class="modal-header">  
					<button onclick="Showmodalopen();" style="margin-top: -10px" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>  
				  </div>  
				  <div class="modal-body" style="padding:0px;">
					<div class="container" style="background-color:white;text-align:left;width:375px;">
						<div style="background-color:#d9edf7;height:150px;margin:0px -15px;">
							<img id="PreviewPageImg" src="" style="width:100%;height:100%;">
						</div>
						<div class="row" style="padding: 7px;">
							<div class="col-xs-7">
								<span id="PreviewPageTitle" style="font-size:16px;display:block;"></span>
								<span id="PreviewPageDescription" style="display:block;padding:3px 0px;color:#767876;font-size:14px;word-break:break-all;">
									
								</span>
							</div>
							<div class="col-xs-5 colRight">
								<span id="PreviewPageCreatetime" style="font-size:10px;color: #607d8b;"></span>
							</div>
						</div>
						<div class="row" style="padding: 0px 25px;color:#767876;font-size:14px;">
							<div id="PreviewPageContent"></div>
						</div>
					</div>
				  </div>   
				</div>
			  </div>
			</div>
			<div class="modal fade" id="editArticle" style="margin-top: 50px;">  
			  <div class="modal-dialog" style="width:700px;">  
				<div class="modal-content message_align">
				  <div class="modal-header">  
					<button onclick="SaveArticle();" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>  
					<h5 class="modal-title">素材编辑</h5>  
				  </div>
				  <div class="modal-body text-center">
					<form class="form-horizontal">
						<div class="form-group">
							<label for="spokemanTitle" class="col-sm-2 control-label">素材标题</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="spokemanTitle">
							</div>
						</div>
						<div class="form-group">
							<label for="spokemanDesc" class="col-sm-2 control-label">素材描述</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="spokemanDesc">
							</div>
						</div>
						<div class="form-group">
							<label for="spokemanImgBtn" class="col-sm-2 control-label">素材图标</label>
							<div class="col-sm-10" style="text-align: left;">
								<input type="file" id="spokemanImgBtn" type="file" name="spokemanImgBtn" multiple>
								<img id="spokemanImg" style="width:100px;">
								<span id="spokemanImgText" name="spokemanImgText"></span>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-4">
								<button class="btn btn-primary" id="insertCourseBtn">插入课程报名</button>
							</div>
						</div>
						<div class="form-group" style="padding:5px;">
							<div id="spokemanArticle" type="text/plain" style="margin-bottom:10px;width:690px;height:500px;"></div>
							<button id="GoArticle" class="btn btn-default  btn-block">︽&nbsp;&nbsp;&nbsp;收起</button>
						</div>
					</form>
				  </div> 
				  <!--
				  <div class="modal-footer">  
					 <button onclick="Showmodalopen();" type="button" class="btn btn-default" data-dismiss="modal">取消</button>  
					 <a onclick="SaveArticle();" class="btn btn-success" data-dismiss="modal">确定</a>  
				  </div> --> 
				</div>
			  </div>
			</div>
			<div class="modal fade" id="InsertPrompt" style="margin-top: 50px;">  
			  <div class="modal-dialog">  
				<div class="modal-content message_align">  
				  <div class="modal-header">  
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>  
					<h5 class="modal-title">选择课程</h5>  
				  </div>  
				  <div class="modal-body text-left">
					<div id="InserCourseList" style="margin:10px;height:400px;overflow-y:auto;overflow-x:hidden;">
						<!--<div class="row radio" style="border-bottom:1px solid #e5e7e5;padding: 5px;">
							<label>
								<div class="col-xs-1">
									<input type="radio" name="SeeCheckbox" class="SeeCheckbox" value="option11" checked>
								</div>
								<div class="col-xs-11">
									<div class="row">
										<div class="col-xs-8">name</div>
										<div class="col-xs-4">2016-11-14</div>
									</div>
									<div style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis;width:100%;">
										简单介绍：谁谁谁水水水水试试事实上事实上事实上事实上nnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnn
									</div>
								</div>
							</label>
						</div>-->
					</div>
					<div class="row" style="margin:20px 0px;">
						<div class="col-xs-2" style="margin-top: 5px;">
							<label for="name" >插入样式</label>
						</div>
						<div class="col-xs-10">
							<select class="form-control" id="InsertStyle">
								<option value="InsertSignupBtn">插入课程报名按钮</option>
								<option value="InsertLessonShortdesc">插入课程简介+报名按钮</option>
								<option value="InsertLessonDescription">插入课程详细介绍+报名按钮</option>
							</select>
						</div>
					</div>
				  </div>  
				  <div class="modal-footer">  
					 <button onclick="Showmodalopen();" type="button" class="btn btn-default" data-dismiss="modal">取消</button>  
					 <a onclick="InsertContent();" class="btn btn-success" data-dismiss="modal">确定</a>  
				  </div>  
				</div>
			  </div>
			</div>
			<div class="modal fade" id="DeletPrompt">  
			  <div class="modal-dialog">  
				<div class="modal-content message_align">  
				  <div class="modal-header">  
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>  
					<h5 class="modal-title">提示信息</h5>  
				  </div>  
				  <div class="modal-body text-center">  
					<h4>您确认要删除吗？</h4>  
				  </div>  
				  <div class="modal-footer">  
					 <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>  
					 <a onclick="DeletInfo();" class="btn btn-success" data-dismiss="modal">确定</a>  
				  </div>  
				</div>
			  </div>
			</div>
		</div>
	</body>
	<?php	include "footer.php";	?>
	<script type="text/javascript">
	
		<?php $timestamp = time();?>
		
	
		var Settings = {};
		Settings.GoArticle = 1;
		Settings.Spokemancreatetime = "<?=$timestamp?>";
	
		window.onload = OnLoad;

		
		
		function OnLoad(){
			BindEvents();
			ShowSpokemanList();
		}
		function BindEvents(){		
			$("#insertCourseBtn").click(function(){
				ShowInsertPrompt();
				return false;
			});
			$("#spokemanPreview").click(function(){
				ShowspokemanPreview();
				return false;
			})		
			
			var ue = UE.getEditor('spokemanArticle');
			$("#GoArticle").click(function(){
				Settings.GoArticle = Settings.GoArticle*(-1);
				GoArticleStatus(Settings.GoArticle);
				return false;
			});
			$('#spokemanImgBtn').uploadify ({ //以下参数均是可选  
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
					$("#spokemanImg").removeClass('hidden');
					$("#spokemanImg").css("display","block");
					$("#spokemanImg").attr("src",'uploadify/upload/'+data);
					// $("#spokemanImgText").text(data);
				}
			});
			$('#shareImgBtn').uploadify ({ //以下参数均是可选  
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
					$("#shareImg").removeClass('hidden');
					$("#shareImg").css("display","block");
					$("#shareImg").attr("src",'uploadify/upload/'+data);
					// $("#shareText").text(data);
				}
			});
		}
		function ShowInsertPrompt(){
			$("#InserCourseList").html("");
			$('#InsertPrompt').modal('toggle');
			url = "spokesman.ajax.php?mode=CourceList";
			$.get(url,function(json,status){
				if(json=="null"){
					CommonJustTip('暂无数据。');
					return;
				}
				json = eval("("+json+")");
				console.log(json);			
				for(var i=0;i<json.length;i++){
					strTbody = '<div class="row radio" style="border-bottom:1px solid #e5e7e5;padding: 5px;"><div class="col-xs-1"><label>';
					strTbody += '<input type="radio" name="SeeCheckbox" class="SeeCheckbox" value="'+json[i].id+'"></label></div><div class="col-xs-11">';
					strTbody += '<div class="row"><div class="col-xs-8">'+json[i].title+'name</div><div class="col-xs-4">2016-11-14</div></div>';
					strTbody += '<div style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis;width:100%;">'+json[i].shortdesc+'</div></div></div>';
				
					$("#InserCourseList").append(strTbody);
				}
			});
			
		}
		
		function InsertContent(){
			var iframeid = $("#InsertStyle").val();
			var insertcourseid = $(".SeeCheckbox:checked").val();

			strBtn = "<iframe id='IframeOnloadId"+insertcourseid+"' name='IframeOnloadId"+insertcourseid+"' onload='IframeOnloadHeight("+insertcourseid+");' frameborder='no'  allowtransparency='yes' src='http://www.wsestar.com/test/Kidcastle-Mall/insertcourse.php?iframeid="+iframeid+"&insertcourseid="+insertcourseid+"&noteid="+Settings.ModifyInfoId+"' seamless></iframe>";
			// strBtn = "<iframe id='IframeOnloadId' name='IframeOnloadId' onload='IframeOnloadHeight("+insertcourseid+");' frameborder='no'  allowtransparency='yes' src='http://www.wsestar.com/test/Kidcastle-Mall/insertcourse.php?iframeid="+iframeid+"&insertcourseid="+insertcourseid+"&noteid="+Settings.ModifyInfoId+"' seamless></iframe>";
			console.log(strBtn);
			UE.getEditor('spokemanArticle').setContent(strBtn, true);
			Showmodalopen();
		}
		
		function IframeOnloadHeight(id){
			var ifreamheight = $("#IframeOnloadId"+id)[0].contentDocument.body.scrollHeight;
			$("#IframeOnloadId"+id).height(ifreamheight);
		} 
		// function IframeOnloadHeight(id){
			// var ifreamheight = IframeOnloadId.document.body.scrollHeight;
			// $("#IframeOnloadId").height(ifreamheight);
		// }
		
		function GoArticleStatus(status){
			switch(status){
				case 1:
					$("#spokemanArticle").css('display',''); 
					$("#GoArticle").html("︽&nbsp;&nbsp;&nbsp;收起");
					break;
				case -1:
					$("#spokemanArticle").css('display','none'); 
					$("#GoArticle").html("︾&nbsp;&nbsp;&nbsp;展开");
					break;
			}
		}
		function ShowSpokemanList(){
			$("#spokemanTable").html("");
			Settings.ListName = "spokeman";

			url = "spokesman.ajax.php?mode=ShareContentList";
			$.post(url,function(json,status){
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
					strTbody = '<div id="'+Settings.ListName+''+(i+1)+'" style="width:350px;height:245px;border:1px solid gray;border-radius:4px;float:left;margin:10px;">';
					strTbody += '<div style="width:100%;text-align:center;line-height:30px;">创建时间：'+json[i].createtime+'</div>';
					strTbody += '<div style="width:94%;height:78%;margin:10px;border:1px solid gray;">';
					strTbody += '<div onclick="ModifyInfo('+json[i].id+');" style="background: rgba(0,0,0,0.3); position: relative;border: 1px solid black; width: 100%;height: 100%;">';
					strTbody += '<img alt="图片" src="'+json[i].picurl+'" style="width: inherit;height: inherit;">';
					strTbody += '<div style="top:151px;width:100%;height:35px;line-height:35px;background: black;opacity: 0.5;padding-left: 10px;position: absolute;color: white;">'+json[i].title+'</div></div></div></div>';
					$("#spokemanTable").append(strTbody);
				}	
			});
		}
		function ShowDeletPrompt(){
			$('#DeletPrompt').modal('toggle');
		}
		function ModifyInfo(id){
			Settings.EditState = "modify";
			Settings.ModifyInfoId = id;
			$('#spokemanInfo').modal({backdrop: 'static', keyboard: false});
			$('#addTitle').text("修改信息");
			$("#spokemanDeletInfo").css('display',''); 
			GoArticleStatus(1);
			$("#shareImg,#spokemanImg").addClass('hidden');
			$("#spokemanRelease").prop("checked", false);
			
			url = "spokesman.ajax.php?mode=ShareContentDetail&noteid="+id;
			$.post(url,function(json,status){
				if(json=="null"){
					return;
				}
				json = eval("("+json+")");
				console.log(json);
				
				Settings.Spokemancreatetime = json.createtime; 				
				Settings.Currentstatus = json.status;
				switch(json.status){
					case "0":
						var status = "未发布";
						$("#spokemanReleaseText").html("发布课程");
						break;
					case "1":
						var status = "已发布";
						$("#spokemanReleaseText").html("撤销发布");
						break;
					case "-1":
						var status = "已撤销发布";
						$("#spokemanReleaseText").html("重新发布");
						break;
				}
				if(json.defaultimgurl != ""){
					$("#shareImg").removeClass('hidden');
				}
				if(json.picurl != ""){
					$("#spokemanImg").removeClass('hidden');
				}		
				
				$("#spokemanStatus").val(status);
				$("#spokemanTitle").val(json.title);
				$("#showArticleTitle").html(json.title);
				$("#spokemanDesc").val(json.description);
				$("#spokemanImg,#showArticleImg").attr("src",json.picurl);
				UE.getEditor('spokemanArticle').setContent(json.content);
				$("#shareTitle").val(json.defaulttitle);
				$("#shareDesc").val(json.defaultdesc);
				$("#sharetimeline").val(json.defaulttimeline);
				$("#shareImg").attr("src",json.defaultimgurl);
				$("#spokemanSharescore").val(json.sharescore);
				$("#spokemanSharenumber").val(json.sharecount);
				$("#spokemanClickscore").val(json.clickscore);
				$("#spokemanClicknumber").val(json.clickcount);
				$("#spokemanOrderscore").val(json.signupscore);
			});
		}
		function AddInfo(){
			Settings.EditState = "add";
			Settings.Currentstatus = "0";
			$('#spokemanInfo').modal({backdrop: 'static', keyboard: false});
			$('#addTitle').text("填写信息");
			$("#spokemanDeletInfo").css('display','none'); 
			$("#spokemanStatus").val("未发布");
			Settings.Spokemanstatus = "0";
			$("#spokemanReleaseText").html("发布素材");
			$("#spokemanRelease").prop("checked", false);
			UE.getEditor('spokemanArticle').setContent("");
			$("#spokemanImg,#shareImg,#showArticleImg").attr("src","");
			$("#spokemanTitle,#spokemanDesc,#shareTitle,#shareDesc,#sharetimeline").val("");
			$("#showArticleTitle").html("");
			$("#shareImg,#spokemanImg").addClass('hidden');
			GoArticleStatus(1);
			
			url = "spokesman.ajax.php?mode=ShowStandardScore";
			$.post(url,function(json,status){
				if(json=="null"){
					return;
				}
				json = eval("("+json+")");
				// console.log(json);
				$("#spokemanSharescore").val(json.sharescore);
				$("#spokemanSharenumber").val(json.sharecount);
				$("#spokemanClickscore").val(json.clickscore);
				$("#spokemanClicknumber").val(json.clickcount);
				$("#spokemanOrderscore").val(json.signupscore);
			});
		}
		function EditArticle(){
			// $('#editArticle').modal('toggle');
			$('#editArticle').modal({backdrop: 'static', keyboard: false});
		}
		function SaveArticle(){
			$("#showArticleTitle").html($("#spokemanTitle").val());
			$("#showArticleImg").attr("src",$("#spokemanImg").attr("src"));
			Showmodalopen();
		}
		// function DeletInfo(){
			// url = "spokesman.ajax.php?mode=DeleteShareContent&noteid="+Settings.ModifyInfoId;
			// $.post(url,function(json,status){
				// if(json=="null"){
					// return;
				// }
				// json = eval("("+json+")");
				// console.log(json);
				// switch (json){
					// case "1":
						// ShowSpokemanList();
						// $('#spokemanInfo').modal('toggle');
						// break;
					// default:
						// CommonWarning('服务器忙，请稍候再试。');
				// }
			// });
		// }
		function ShowspokemanPreview(){
			$("#PreviewPageImg").attr("src",$("#spokemanImg").attr("src"));
			$("#PreviewPageTitle").text($("#spokemanTitle").val());
			$("#PreviewPageDescription").text($("#spokemanDesc").val());
			$("#PreviewPageCreatetime").text(Settings.Spokemancreatetime);
			$("#PreviewPageContent").html(UE.getEditor('spokemanArticle').getContent());
			$('#spokemanPreviewPage').modal('toggle');
		}
		
		function SaveInfo(){
			var data={};
			
			data.flagid = "";	//判断是更新或者新增
			if(Settings.EditState == "modify"){
				data.flagid = Settings.ModifyInfoId;
			}
			
			data.publishid = Settings.Currentstatus;	//提交当前新状态--不做改变
			if($("#spokemanRelease").is(":checked")){
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
		
			data.title = $("#spokemanTitle").val();
			data.description = $("#spokemanDesc").val();
			data.picurl = $("#spokemanImg").attr("src");
			data.content =  UE.getEditor('spokemanArticle').getContent();
			data.defaulttitle = $("#shareTitle").val();
			data.defaultdesc = $("#shareDesc").val();
			data.defaulttimeline = $("#sharetimeline").val();//朋友圈的简述
			data.defaultimgurl = $("#shareImg").attr("src");
			data.sharescore = $("#spokemanSharescore").val();
			data.sharecount = $("#spokemanSharenumber").val();
			data.clickscore = $("#spokemanClickscore").val();
			data.clickcount = $("#spokemanClicknumber").val();
			data.signupscore = $("#spokemanOrderscore").val();

			
			url = "spokesman.ajax.php?mode=UpdateShareContent";
			$.post(url,{
				data : data
			},function(json,status){
				// console.log(json);
				switch (json){
					case "1":
						ShowSpokemanList();
						break;
					default:
						CommonWarning('服务器忙，请稍候再试。');
				}
			});
		}
		function Showmodalopen(){
			setTimeout(function(){
				  $("body").addClass('modal-open');
			},500);
		}
   </script> 
</html>