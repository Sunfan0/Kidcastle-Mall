<?php
	include "paras.php";
	$_SESSION["pageurl"]="u.my.php";
	if(!isset($_SESSION["openid"])){
		Page("u.login.php");
	} 
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<title>至美教育会员商城</title>
		<link href="style/bootstrap.css" rel="stylesheet"/>
		<link href="style/style.css" rel="stylesheet"/>
		<link href="js/craftpip/css/jquery-confirm.css" rel="stylesheet"/>
		<style>
			.menuIcon{
				width:80px;
				height:80px;
				padding:20px;
				font-size:35px;
				color:rgba(0, 0, 0, .5);
				border-radius:20%;
				border:1px solid rgba(0, 0, 0, .5);
				box-shadow: 0 0 1px rgba(0, 0, 0, .5);
			}
			.menuText{
				margin-top:20px;
				color:#555;
			}
			.FooterText{
				height:5px !important; 
				padding:0px !important;
			}
		</style>
	</head>
	<body>
		<div style="background-color:#337ab7;color:white;height:180px;">
			<div style="padding-top:30px;">
				<p style="text-align:center;font-size:20px;"><?php echo $_SESSION["nickname"]?></p>
			</div>
			<div style="text-align:center;margin-top:30px;">
				<div style="width:140px;height:140px;border-radius:50%;background-color:#e5e7e5;display: inline-block;">
					<img src="<?php echo $_SESSION["headimgurl"]?>" style="width:130px;height:130px;border-radius:50%;margin:5px;">
				</div>
			</div>
			<p class="menuItem" id="myinfo" style="text-align:right;font-size:14px;float:right;margin-top:-70px;margin-right:5px;">编辑资料 <span class="glyphicon glyphicon-edit"></span></p>
		</div>
		<div class="container" style="margin-top:70px;">
			<div class="row"  style="text-align: center;">
				<!--<div class="col-xs-4 menuItem" id="myinfo">
					<div class="menuIcon">
						<span class="glyphicon glyphicon-edit"></span>
					</div>
					<p class="menuText">编辑资料</p>					
				</div>-->
				<div class="col-xs-4 menuItem" id="sharecontentlist">
					<div class="menuIcon">
						<span class="glyphicon glyphicon-book"></span>
					</div>
					<p class="menuText">代言人</p>					
				</div>
				<div class="col-xs-4 menuItem" id="mylessons">
					<div class="menuIcon">
						<span class="glyphicon glyphicon-user"></span>
					</div>
					<p class="menuText">我的课程</p>					
				</div>
				<div class="col-xs-4 menuItem" id="lessonlist">
					<div class="menuIcon">
						<span class="glyphicon glyphicon-bell"></span>
					</div>
					<p class="menuText">在线选课</p>					
				</div>
			</div>
			<div class="row"  style="text-align: center;">
				<div class="col-xs-4 menuItem" id="myscore">
					<div class="menuIcon">
						<span class="glyphicon glyphicon-star"></span>
					</div>
					<p class="menuText">个人积分</p>					
				</div>
				<div class="col-xs-4 menuItem" id="scoremall">
					<div class="menuIcon">
						<span class="glyphicon glyphicon-shopping-cart"></span>
					</div>
					<p class="menuText">积分商城</p>					
				</div>
				<div class="col-xs-4 menuItem" id="mychangehis">
					<div class="menuIcon">
						<span class="glyphicon glyphicon-lock"></span>
					</div>
					<p class="menuText">兑换履历</p>					
				</div>
			</div>
		</div>
		<!--<div class="container" style="margin-top:40px;">
			<div class="row menuItem"  style="background-color:white;margin-top:15px;line-height:20px;" id="myinfo">
				<div class="col-xs-8">编辑资料</div>
				<div class="col-xs-4 colRight">
					<span  class="glyphicon glyphicon-chevron-right"></span>
				</div>	 
			</div>
			<div class="row menuItem"  style="background-color:white;margin-top:5px;line-height: 20px;" id="mylessons">
				<div class="col-xs-8">我的课程</div>
				<div class="col-xs-4 colRight">
					<span  class="glyphicon glyphicon-chevron-right"></span>
				</div>	 
			</div>
			<div class="row menuItem"  style="background-color:white;margin-top:5px;line-height: 20px;" id="lessonlist">
				<div class="col-xs-8">在线选课</div>
				<div class="col-xs-4 colRight">
					<span  class="glyphicon glyphicon-chevron-right"></span>
				</div>
			</div>
			<div class="row menuItem"  style="background-color:white;margin-top:5px;line-height: 20px;" id="myscore">
				<div class="col-xs-8">个人积分</div>
				<div class="col-xs-4 colRight">
					<span  class="glyphicon glyphicon-chevron-right"></span>
				</div>
			</div>
			<div class="row menuItem"  style="background-color:white;margin-top:5px;line-height: 20px;" id="scoremall">
				<div class="col-xs-8">积分商城</div>
				<div class="col-xs-4 colRight">
					<span  class="glyphicon glyphicon-chevron-right"></span>
				</div>
			</div>
			<div class="row menuItem"  style="background-color:white;margin-top:5px;line-height: 20px;" id="mychangehis">
				<div class="col-xs-8">兑换履历</div>
				<div class="col-xs-4 colRight">
					<span  class="glyphicon glyphicon-chevron-right"></span>
				</div>
			</div>
		</div>-->
	</body>
	<?php	include "u.footer.php";	?>
	<script type="text/javascript">
		// var WXSettings = {};
		// WXSettings.defaulttitle="吉的堡my";
		// WXSettings.defaultdesc="吉的堡my";
		// WXSettings.link='http://www.wsestar.com/test/Kidcastle-Mall/u.my.php';
		// WXSettings.defaultimgUrl='http://www.wsestar.com/test/Kidcastle-Mall/image/a.jpg';
		// WXSettings.defaulttimeline="吉的堡会员积分商城";
	
		window.onload = OnLoad;

		function OnLoad(){
			BindEvents();
		}
		function BindEvents(){
			$(".menuItem").each(function(){
				$(this).click(function(){
					var id = $(this).attr("id");
					switch(id){
						case "myinfo":
							window.location.href = "u." + id + ".php";
							break;
						case "mylessons":
							JudgeInfo(id);
							break;
						case "lessonlist":
							window.location.href = "u." + id + ".php";
							break;
						case "myscore":
							JudgeInfo(id);
							break;
						case "scoremall":
							JudgeInfo(id);
							break;
						case "mychangehis":
							JudgeInfo(id);
							break;
						case "sharecontentlist":
							JudgeInfo(id);
							break;
					}
				})
			})
			
			// json = eval('(' + '<?php echo GetWXConfigData(); ?>' + ')')
// json.debug=true;
			// wx.config(json);
			// wx.error(function (res) {
				// alert(res.errMsg);
				// alert(res);
			// });
			// BuildShareData();
		}

		
		function JudgeInfo(id){
			url = "u.myinfo.ajax.php?mode=ShowInfo";
			$.get(url,function(json,status){
				json = eval("("+json+")");
				console.log(json);
				if(json.name == "" && json.mobile == "" && json.school == ""){
					CommonJustTip('您还未填写个人信息！');
					return;
				}
				window.location.href = "u." + id + ".php";
			});
		}
		
		/* function BuildShareData(){
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
					alert("ok");
				}
			});
			wx.onMenuShareTimeline({
				title: WXSettings.defaulttimeline,
				desc: WXSettings.defaulttimeline,
				link: WXSettings.link,
				imgUrl: WXSettings.defaultimgUrl,
				success: function () {
					alert("ok");
				}
			});
			wx.onMenuShareQQ({
				title: WXSettings.defaulttitle,
				desc: WXSettings.defaultdesc,
				link: WXSettings.link,
				imgUrl: WXSettings.defaultimgUrl,
				success: function () {
					alert("ok");
				}
			});
		}
		wx.ready(function () {
			BuildShareData();
		}); */
   </script> 
</html>