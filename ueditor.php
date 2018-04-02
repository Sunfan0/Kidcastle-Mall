<?php
	include "paras.php";
	// include "header.php";
	
	if(CheckRights() < 0)
		Page("login.php");
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<title>吉的堡后台管理</title>
	</head>
	<body>
		<div class="container" style="margin-top:30px;">
			<div id="editor" type="text/plain" style="width:550px;height:550px;"></div>
		</div>
	</body>
	<script src="js/ueditor/ueditor.config.js" charset="utf-8"></script>
	<script src="js/ueditor/ueditor.all.js" charset="utf-8"></script>
	<script type="text/javascript">
		var Settings = {};
	
		window.onload = OnLoad;

		function OnLoad(){
			BindEvents();
		}
		function BindEvents(){
			var ue = UE.getEditor('editor');
		}
   </script> 
</html>