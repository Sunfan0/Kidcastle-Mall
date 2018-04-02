<?php
	include "u.header.php";

	$courseinfoid = Get("courseinfoid");
	$noteid = Get("noteid");
	$commodityinfoid = Get("commodityinfoid");
?>
<!--
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<title>吉的堡</title>
		<link href="style/bootstrap.css" rel="stylesheet"/>	
		<link href="style/style.css" rel="stylesheet"/>	
		<link href="js/craftpip/css/jquery-confirm.css" rel="stylesheet"/>		
	</head>
	<body>-->
		<div class="pageTitle">
			<div class="row">
				<div class="col-xs-4">
					<span id="payBackBtn" class="glyphicon glyphicon-chevron-left" style="pading-right:5px;">返回</span>
				</div>
				<div class="col-xs-8">
					<span id="payTitle">在线支付</span>
				</div>
			</div>
		</div>
		<div id="payContainer" class="container hidden">
			<button id="payBtn" type="button" class="btn btn-primary btn-block" style="margin-top:50px;">支付</button>
		</div>
		<div id="exchangeContainer" class="container hidden">
			<button id="exchangeBtn" type="button" class="btn btn-primary btn-block" style="margin-top:50px;">兑换</button>
		</div>
	</body>
	<?php	include "u.footer.php";	?>
	<script type="text/javascript">
		var Settings = {};
		Settings.PayPara = "";
		window.onload = OnLoad;
		var courseinfoid = "<?php echo $courseinfoid; ?>";
		var noteid = "<?php echo $noteid; ?>";
		var commodityinfoid = "<?php echo $commodityinfoid; ?>";
		
		function OnLoad(){
			BindEvents();
		}
		function BindEvents(){
			if(courseinfoid != ""){
				$("#payContainer").removeClass("hidden");
				$("#exchangeContainer").addClass("hidden");
			}
			if(commodityinfoid != ""){
				$("#payContainer").addClass("hidden");
				$("#exchangeContainer").removeClass("hidden");
			}
			
			$("#payBackBtn").click(function(){
				window.location.href = '<?php echo $_SESSION["pageurl"]?>';
			})
			$("#payBtn").mousedown(function(){
				url = "btnajax.php?mode=FinishSign&courseinfoid="+courseinfoid+"&noteid="+noteid;
				$.post(url,function(json,status){
					alert(json);
					json = eval("("+json+")");
					switch(json){
						case -99:
							CommonJustTip("您的积分不足!");
							break;
						case -1:
						case -9:
						case -8:
						case -7:
						case -80:
						case -70:
						case 8:
						case 7:
							CommonJustTip("服务器忙，请稍后再试。");
							break;
						default:
							alert("验证成功，跳转支付中，请稍候......");
							Settings.PayPara = json.data;
							Settings.OrderNo = json.orderno;
							Pay();
							break;
					}		
				});
			})
			$("#exchangeBtn").mousedown(function(){
				url = "btnajax.php?mode=ConfirmExchange&commodityinfoid="+commodityinfoid;
				$.post(url,function(json,status){
					alert(json);
					json = eval("("+json+")");
					switch(json){
						case -999:
							CommonJustTip("您的积分不足!");
							break;
						case -99:
							CommonJustTip("您的积分不足!");
							break;
						case -1:
						case -11:
						case -90:
						case -22:
						case -19:
						case -8:
						case -9:
						case 8:
						case 7:
							CommonJustTip("服务器忙，请稍后再试。");
							break;
						default:
							alert("验证成功，跳转支付中，请稍候......");
							Settings.PayPara = json.data;
							Settings.OrderNo = json.orderno;
							Pay();
							break;
					}			
						
						
						
						
				});
			})
		}
		function Pay(){
			if (typeof WeixinJSBridge == "undefined"){
			    if( document.addEventListener ){
			        document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
			    }else if (document.attachEvent){
			        document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
			        document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
			    }
			}else{
			    jsApiCall();
			}
		}
		
		//调用微信JS api 支付
		function jsApiCall()
		{
alert(Settings.PayPara);
			WeixinJSBridge.invoke(
				'getBrandWCPayRequest',
				eval("("+Settings.PayPara+")"),
				function(res){
					WeixinJSBridge.log(res.err_msg);
alert(res.err_msg);
alert(res.err_code+","+res.err_desc+","+res.err_msg);
					switch(res.err_msg){
						case "get_brand_wcpay_request:cancel":
							CommonJustTip("您取消了支付，请重新支付。");
							break;
						case "get_brand_wcpay_request:ok":
							CommonJustTip("支付成功！");
							//更新数据支付状态
							//$.get("btnajax.php?mode=updatepaystatus&orderno="+Settings.OrderNo);
							//window.location.href = "<?php //echo $returnurl; ?>";
							break;
					}
				}
			);
		}
   </script> 
</html>