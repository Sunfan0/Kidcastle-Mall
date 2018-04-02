<?php
	include "u.header.php";
	
	$stropenid = substr($_SESSION["openid"], 0, 10);
	$strdate = date("YmdHi", time());
	$BarCodePara = md5($_SESSION["userid"].$stropenid.$strdate);//二维码参数
	$BarCodePara = substr($BarCodePara, 0, 10);


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
		<div id="ShowCode" class="hidden"  style="z-index:999;position:fixed;padding: 40% 20%;top:0;left:0;right:0;bottom:0;overflow-y:auto;background-color:rgba(255, 255, 255, 0.56);"></div>
		<div class="pageTitle">
			<div class="row">
				<div class="col-xs-4">
					<span id="myChangehisBackBtn" class="glyphicon glyphicon-chevron-left" style="pading-right:5px;">返回</span>
				</div>
				<div class="col-xs-8">
					<span id="myChangehisTitle">兑换履历</span>
				</div>
			</div>
		</div>
		<div class="container" style="background-color:white;" id="myChangehisContent">
			<!--<div id="myScoreList1" style="margin-top:10px;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;background-color:white;">
				<div class="row" style="padding: 0px 10px;">
					<div class="col-xs-8">
						<p style="font-size:16px;">+150</p>
					</div>
					<div class="col-xs-4 colRight">
						<p style="color:#607d8b;font-size:14px;">获取时间</p>
					</div>
				</div>
				<div class="row" style="padding: 0px 20px;color:#767876;font-size:14px;background-color:white;">
					<p style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis;width:100%;">获取方式xxxxxxxxxxxxxxxxxx</p>
				</div>
			</div>-->
		</div>
		<div id="kkpager"></div>
		<a id="MyChangehisNull" class="hidden" style="font-size: 17px;" href="u.lessonlist.php">
			<p style="padding-top: 50px;text-align:center;">马上去兑换 ></p>
		</a>		
	</body>
	<?php	include "u.footer.php";	?>
	<script type="text/javascript">
		var Settings = {};
	
		window.onload = OnLoad;
		
		function OnLoad(){
			BindEvents();
			ShowChangeList(1);
		}
		function BindEvents(){
			$("#ShowCode").mousedown(function(){
				$("#ShowCode").addClass("hidden");
				$("#ShowCode").html("");
			})
			
			$("#myChangehisBackBtn").click(function(){
				window.location.href = "u.my.php";
			})
		}
		function ShowChangeList(page){
			url = "u.mychangehis.ajax.php?mode=ShowGotCommodity&currentpage="+page;
			$.post(url,function(json,status){
				if(json == ""){
					CommonJustTip('您的兑换暂时为空！');
					$("#MyChangehisNull").removeClass("hidden");
					return;
				}
				json = eval("("+json+")");
				data = json.data;
				console.log(data);
				for(var i=0;i<data.length;i++){				
					var id = data[i].id;
					if(data[i].type == "10"){
						id = data[i].infoid;
					}
					
					strmyChangehis = "<div id='strmyChangehis"+i+"' style='margin-top:10px;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;background-color:white;'>";
					strmyChangehis+= "<div class='row' style='padding: 0px 10px;'><div class='col-xs-5'><p style='font-size:19px;'>"+data[i].name+"</p></div>";
					strmyChangehis+= "<div class='col-xs-7 colRight'><p style='color:#607d8b;font-size:15px;'>"+data[i].ordertime+"</p></div></div>";
					strmyChangehis+= "<div class='row' style='padding: 0px 10px;'><div class='col-xs-8 colLeft'><p style='color:#767876;font-size:16px;'>价格: "+data[i].price+"&nbsp;&nbsp;&nbsp;积分: "+data[i].score+"</p></div>";
					
					switch(data[i].status){
						case "3":
							// strmyChangehis+= "<div class='col-xs-4 colRight' style='color:#EF473A;'>去支付</div></div>";
							strmyChangehis+= "<div class='col-xs-4 colRight'><button type='button' class='btn btn-link btn-sm' onclick='GoPaypage("+data[i].id+");'>去支付</button></div></div>";
							break;
						case "4":
							strmyChangehis+= "<div class='col-xs-4 colRight'><button type='button' class='btn btn-primary btn-sm' onclick='ShowChangeCode("+id+","+data[i].type+");'>领取码</button></div></div>";
							break;
						case "5":
							// strmyChangehis+= "<div class='col-xs-4 colRight' style='color:#EF473A;'>已发放</div></div>";
							strmyChangehis+= "<div class='col-xs-4 colRight'><button type='button' class='btn btn-danger btn-sm' onclick='ShowReceivedTime("+data[i].infoid+");'>已发放</button></div></div>";
							break;
					}
					strmyChangehis+= "<div class='row' style='padding: 0px 25px;color:#767876;font-size:16px;background-color:white;'>";
					strmyChangehis+= "<p style='white-space:nowrap;overflow:hidden;text-overflow:ellipsis;width:100%;'>"+data[i].shortdesc+"</p></div></div>";
					$("#myChangehisContent").append(strmyChangehis);
				} 
				kkpager.generPageHtml({
					pno : page,
					total : json.pagecount,
					totalRecords : json.total,
					mode : 'click',//默认值是link，可选link或者click
					click : function(n){
						ShowChangeList(n);
						return false;
					}
				} , true);
			});
		}
		function GoPaypage(id){
			window.location.href = "u.scoremalldetail.php?commodityid="+id;
		}
		
		function ShowChangeCode(id,type){
			if(type == "10"){
				strCodeImg = 'http://www.wsestar.com/test/Kidcastle-Mall/checkcommodity.php?id='+id+'&p=<?php echo $BarCodePara; ?>';
				$("#ShowCode").qrcode({
					render:"canvas",
					width:220,
					height:220,
					text:strCodeImg
				});
				$("#ShowCode").removeClass("hidden");
			}else{
				url = "u.mychangehis.ajax.php?mode=ShowGotCode&commodityid="+id;
				$.post(url,function(json,status){
					json = eval("("+json+")");
					console.log(json);
					strreceive = "<h4>领取信息</h4><p>领取码："+json.code+"</P>";
					// strreceive = "<h4>领取信息</h4><span>领取码：</span><span id='receivecode'>"+json.code+"</span>&nbsp;&nbsp;&nbsp;<button id='codecopyBtn' class='btn btn-default btn-xs'>复制</button>";
					if(json.explain != ""){
						strreceive+= "<p>兑换说明："+json.explain+"</P>";
					}
					$.dialog(strreceive);						
				});
			}
		}
		function ShowReceivedTime(id){
			url = "u.mychangehis.ajax.php?mode=GotCommodityDetail&commodityinfoid="+id;
			$.post(url,function(json,status){
				json = eval("("+json+")");
				console.log(json);
				// strinfo = "<h4>发放信息</h4><img style='width:50px;height:50px;margin:0px 10px 10px 0px;' src='"+json.imgurl+"'><span>"+json.nickname+"</span><p>联系电话："+json.mobile+"</P><p>领取时间："+json.scantime+"</P>";
				strinfo = "<h4>发放信息</h4><img style='width:50px;height:50px;margin:0px 10px 10px 0px;' src='"+json.imgurl+"'><span>"+json.nickname+"</span><p>领取时间："+json.scantime+"</P>";
				$.dialog(strinfo);			
			});
		}		
   </script> 
</html>
