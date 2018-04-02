<?php
	include "u.header.php";
	$_SESSION["pageurl"]="u.myscorehis.php";
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
					<span id="myScorehisBackBtn" class="glyphicon glyphicon-chevron-left" style="pading-right:5px;">返回</span>
				</div>
				<div class="col-xs-8">
					<span id="myScorehisTitle">积分履历</span>
				</div>
			</div>
		</div>
		<div class="container" style="background-color:white;" id="myScoreContent">
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
	</body>
	<?php	include "u.footer.php";	?>
	<script type="text/javascript">
		var Settings = {};
	
		window.onload = OnLoad;
		
		function OnLoad(){
			BindEvents();
			ShowScorehisList(1);
		}
		function BindEvents(){
			$("#myScorehisBackBtn").click(function(){
				window.location.href = "u.myscore.php";
			})
		}
		function ShowScorehisList(page){
			url = "u.myscorehis.ajax.php?mode=ScoreDetail&currentpage="+page;
			$.post(url,function(json,status){
				if(json == ""){
					CommonJustTip('您的积分履历暂时为空！');
					return;
				}
				json = eval("("+json+")");
				data = json.data;
				console.log(data);
				
				for(var i=0;i<data.length;i++){	
					var changetype = "获取";
					var colortype = "#387EF5";
					if(data[i].changetype == -1){
						changetype = "消费";
						colortype = "#EF473A";
					}
					
					strmyScore = "<div id='myScoreList"+i+"' style='margin-top:10px;border-bottom-style: solid;border-width: 1px;border-color: #e5e7e5;background-color:white;'>";
					strmyScore+= "<div class='row' style='padding: 0px 10px;'><div class='col-xs-6'><p style='color:"+colortype+";font-size:16px;'>"+ changetype + data[i].changescore +"积分</p></div>";
					strmyScore+= "<div class='col-xs-6 colRight'><p style='color:#607d8b;font-size:14px;'>"+data[i].operattime+"</p></div></div>";
					strmyScore+= "<div class='row' style='padding: 0px 25px;color:#767876;font-size:14px;background-color:white;'>";
					strmyScore+= "<p style='white-space:nowrap;overflow:hidden;text-overflow:ellipsis;width:100%;'>"+data[i].reason+"</p></div></div>";
					$("#myScoreContent").append(strmyScore);
				}
				kkpager.generPageHtml({
					pno : page,
					total : json.pagecount,
					totalRecords : json.total,
					mode : 'click',//默认值是link，可选link或者click
					click : function(n){
						ShowScorehisList(n);
						return false;
					}
				} , true);
			});
		}
   </script> 
</html>