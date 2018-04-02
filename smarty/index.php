<?php

	include "paras.php";

	switch(Get("wang")){
		case "1":
			$smarty->assign('name','Ned');
			break;
		case "2":
			$smarty->assign('name','Ned2');
			break;
		default:
			$smarty->assign('name',"no name!!!!");
			break;
	}
	//单个变量
	
	
	$smarty->assign('arr1',array("id"=>10,"name"=>"test name"));
	$arr2 = array();
	$arr2["id"] = "20";
	$arr2["name"] = "test name 2";
	$smarty->assign("arr2",$arr2);
	
	
	$arrFor = array();
	array_push($arrFor,array("id"=>10,"name"=>"name10"));
	array_push($arrFor,array("id"=>20,"name"=>"name20"));
	array_push($arrFor,array("id"=>30,"name"=>"name30"));
	array_push($arrFor,array("id"=>40,"name"=>"name40"));
	array_push($arrFor,array("id"=>50,"name"=>"name50"));
	
	$arrFor2 = array();
	
	$smarty->assign("arrFor",$arrFor);
	$smarty->assign("arrFor2",$arrFor2);

	$smarty->setCaching(Smarty::CACHING_LIFETIME_CURRENT);
	//$smarty->display('index.tpl',Get("wang"));
	$smarty->display('index.tpl',Get("wang"));
	
?>