
	<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/craftpip/js/jquery-confirm.js"></script>
	<script type="text/javascript" src="http://cdn.staticfile.org/jquery.qrcode/1.0/jquery.qrcode.min.js"></script>
	<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
	<script src="js/kkpager-master/src/kkpager.min.js" charset="utf-8"></script>
	<script type="text/javascript">
		strFooterText = '<div class="FooterText" style="height:40px;padding:10px;text-align: center;">';
		strFooterText+= '<a style="color: gray;" href="http://wsestar.com/" target="_blank">技术支持：西安传睿</a></div>';
		$("body").append(strFooterText);
		
		/* $(".navBtn").each(function(){
			$(this).click(function(){
				window.location.href = $(this).attr("id") + ".php";
				$(".navBtn").each(function(){
					$(this).removeClass("active");
				});
				$(this).addClass("active");
			})
		})
		
		var  filename=location.href;
		filename=filename.substr(filename.lastIndexOf('/')+1);
		filename=filename.substr(0,filename.lastIndexOf('.'));
		$("#"+filename).addClass("active"); */
		
		
		// $.alert('Content here', 'Title here');
		// $.confirm('A message', 'Title is optional');
		// $.dialog('Just to let you know');
		
		// $.confirm({
			// confirmButton: '确定',
			// cancelButton: '取消',
			// confirmButtonClass: 'btn-info',
			// cancelButtonClass: 'btn-danger'
		// });
		
		// CommonJustTip('暂无数据。');
		// CommonWarning('服务器忙，请稍候再试。');
		// CommonConfirm('您确定？','提示');
		
		
		
		function CommonJustTip(content,title){
			if(title == undefined){
				title = "";
			}
			$.confirm({
				title: title,
				content: content,
				cancelButton: false,
				confirmButton: false,
				backgroundDismiss: true,
				closeIcon: false
			});
		}
		
		function CommonWarning(content,title){
			if(title == undefined){
				title = "";
			}
			$.confirm({
				icon: 'fa fa-warning',
				closeIcon: true,
				title: title,
				content: content,
				confirmButton: '确定',
				cancelButton: '取消'
			});
		}
		
		function CommonConfirm(content,title){
			if(title == undefined){
				title = "";
			}
			$.confirm({
				// icon: 'glyphicon glyphicon-heart',
				title: title,
				content: content,
				confirmButton: '确定',
				cancelButton: '取消'
			});
		}
   </script> 