<?php
	if(!defined("APPID"))
		define("APPID","wx7fa6fd4b94f47973");
	if(!defined("APPSECRET"))
		define("APPSECRET","bd7ec0f1b39c565d46f4082c27fb6400");
	if(!defined("APPNAME"))
		define("APPNAME","wsestarservice");
	
	if(!defined("SMARTY_DIR"))
		define('SMARTY_DIR', 'D:\smarty-3.1.30\libs/');
	
	
require_once(SMARTY_DIR . 'Smarty.class.php');
$smarty = new Smarty();

$smarty->setTemplateDir('D:\Pages\test\smarty\templates/');
$smarty->setCompileDir('D:\Pages\test\smarty\templates_c/');
$smarty->setConfigDir('D:\Pages\test\smarty\configs/');
$smarty->setCacheDir('D:\Pages\test\smarty\cache/');


	/* if(!defined("APPID"))
		define("APPID","wxd15f2060944c23ba");
	if(!defined("APPSECRET"))
		define("APPSECRET","743defb56a6a64852961ce1452a1139d");
	if(!defined("APPNAME"))
		define("APPNAME","mzone029service"); */
	
	if(!defined("DB"))
		define("DB"," ");
	if(!defined("URL_BASE"))
		define("URL_BASE","http://www.wsestar.com/test/Kidcastle-Mall/");
	if(!defined("PATH_FUNCTION"))
		//define("PATH_FUNCTION","functions.V4.php");
		define("PATH_FUNCTION","../../common/functions.V3.php");
	if(!defined("PATH_DBACCESS"))
		//define("PATH_DBACCESS","dbaccess.v5.php");
		define("PATH_DBACCESS","../../common/dbaccess.v5.php");
	if(!defined("DEBUG"))
		define("DEBUG",false);
	
	date_default_timezone_set('Asia/Shanghai');

	include PATH_FUNCTION;
	include PATH_DBACCESS;

	
	$dbms='mysql';     //数据库类型
	$host='localhost'; //数据库主机名
	$dbName='kidcastlemall';    //使用的数据库
	$dbUser='root';      //数据库连接用户名
	$dbPass='lim1hou';          //对应的密码
	//$dbPass='root'; 
	function CheckRights($formName = null){
		if(!isset($_SESSION["uname"]))
			return -10;
		
		if($_SESSION["uname"] == "admin")
			return true;

		$managerInfo = DBGetDataRowByField("bgmanager","loginname",$_SESSION["uname"]);
		if($managerInfo == null)
			return -9;
		if($managerInfo["rights"] == "")
			return -7;
		
		if($formName == null)
			return $managerInfo["id"];
			
		$rights = json_decode($managerInfo["rights"],true);
		if(isset($rights[$formName]))
			return $rights[$formName];
		else
			return -7;
	}
	
	
?>