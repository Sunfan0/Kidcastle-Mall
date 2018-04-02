{include file="file:u.header.tpl"}
{*<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<title>至美教育会员商城</title>
		<link href="style/bootstrap.css" rel="stylesheet"/>	
		<link href="style/style.css" rel="stylesheet"/>		
	</head>
	<body>*}
		<div class="pageTitle">
			<div class="row">
				<div class="col-xs-4">
					<span id="sharecontentBackBtn" class="glyphicon glyphicon-chevron-left" style="pading-right:5px;">返回</span>
				</div>
				<div class="col-xs-8">
					<span id="sharecontentTitle">分享详情</span>
				</div>
			</div>
		</div>
		<div class="container" style="background-color:white;">
			<div>
				<div style="background-color:#d9edf7;height:150px;margin:0px -15px;">
					<img src="{$sharecontentinfo.picurl}" style="width:100%;height:100%;">
				</div>
				<div class="row">
					<div class="col-xs-7">
						<span style="font-size:16px;display:block;">{$sharecontentinfo.title}</span>
						<span style="display:block;padding:3px 0px;color:#767876;font-size:14px;word-break:break-all;">
							{$sharecontentinfo.description}
						</span>
					</div>
					<div class="col-xs-5 colRight">
						<span style="font-size:10px;color: #607d8b;">{$sharecontentinfo.createtime}</span>
					</div>
				</div>
				<div class="row" style="padding: 0px 25px;color:#767876;font-size:14px;">
					<div id="PreviewPageContent">{$sharecontentinfo.content}</div>
				</div>
			</div>
		</div>
	</body>
	{include file="file:u.footer.tpl"}
	<script type="text/javascript">
		var sharecontentid = {$sharecontentinfo.id};
		var inviter = '{$inviter}';
		
		var WXSettings = {};
		WXSettings.defaulttitle='{$sharecontentinfo.defaulttitle}';
		WXSettings.defaultdesc='{$sharecontentinfo.defaultdesc}';
		WXSettings.link='http://www.wsestar.com/test/Kidcastle-Mall/u.sharecontent.php?noteid='+sharecontentid+'&inviter='+inviter;
		WXSettings.defaultimgUrl='http://www.wsestar.com/test/Kidcastle-Mall/{$sharecontentinfo.defaultimgurl}';
		WXSettings.defaulttimeline='{$sharecontentinfo.defaulttimeline}';
	
		window.onload = OnLoad;
		

		function OnLoad(){
			BindEvents();
			BuildShareData();
		}
		function BindEvents(){
			console.log({json_encode($sharecontentinfo)});
			console.log({json_encode($sharecontentinfo)}.title);
			
			$("#sharecontentBackBtn").click(function(){
				window.location.href = "u.sharecontentlist.php";
			})
		}
		
		function IframeOnloadHeight(id){
			var ifreamheight = $("#IframeOnloadId"+id)[0].contentDocument.body.scrollHeight;
			$("#IframeOnloadId"+id).height(ifreamheight);
		} 
		
		function BuildShareData(){
			if(!WXSettings)
				return;
		
			shareDataMessage = {
				title: WXSettings.defaulttitle,
				desc: WXSettings.defaultdesc,
				link: WXSettings.link,
				imgUrl: WXSettings.defaultimgUrl
			};
			shareDataTimeline = {
				title: WXSettings.defaulttimeline,
				desc: WXSettings.defaulttimeline,
				link: WXSettings.link,
				imgUrl: WXSettings.defaultimgUrl
			};
			wx.onMenuShareAppMessage({
				title: WXSettings.defaulttitle,
				desc: WXSettings.defaultdesc,
				link: WXSettings.link,
				imgUrl: WXSettings.defaultimgUrl,
				success: function () {
					$.post("btnajax.php?mode=ShareAddScore&noteid=" + sharecontentid);
				}
			});
			wx.onMenuShareTimeline({
				title: WXSettings.defaulttimeline,
				desc: WXSettings.defaulttimeline,
				link: WXSettings.link,
				imgUrl: WXSettings.defaultimgUrl,
				success: function () {
					$.post("btnajax.php?mode=ShareAddScore&noteid=" + sharecontentid);
				}
			});
			wx.onMenuShareQQ({
				title: WXSettings.defaulttitle,
				desc: WXSettings.defaultdesc,
				link: WXSettings.link,
				imgUrl: WXSettings.defaultimgUrl,
				success: function () {
					$.post("btnajax.php?mode=ShareAddScore&noteid=" + sharecontentid);
				}
			});
		}
		wx.ready(function () {
			BuildShareData();
		});
   </script> 
</html>