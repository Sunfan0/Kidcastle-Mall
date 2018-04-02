<?php
	include "u.header.php";
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
					<span id="myScoreBackBtn" class="glyphicon glyphicon-chevron-left" style="pading-right:5px;">返回</span>
				</div>
				<div class="col-xs-8">
					<span id="myScoreTitle">个人积分</span>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row" style="background-color:white;padding-top:15px;">
				<div class="col-xs-4">
					<p style="font-size:14px;">当前积分：</p>
				</div>
				<div class="col-xs-4">
					<p style="font-size:16px;" id="currentScore">0</p>
				</div>
				<div class="col-xs-4">
					<a href="u.myscorehis.php">积分履历<span class="glyphicon glyphicon-chevron-right" style="pading-left:5px;"></span></a>
				</div>
			</div>
		</div>
	</body>
	<?php	include "u.footer.php";	?>
	<script type="text/javascript">
		var Settings = {};
	
		window.onload = OnLoad;
		
		function OnLoad(){
			BindEvents();
		}
		function BindEvents(){
			url = "u.myscore.ajax.php?mode=MyScore";
			$.post(url,function(json,status){
				console.log(json);
				if(json == ""){json = 0;}
				$("#currentScore").text(json);
			});
			
			$("#myScoreBackBtn").click(function(){
				window.location.href = "u.my.php";
			})
		}
   </script> 
</html>