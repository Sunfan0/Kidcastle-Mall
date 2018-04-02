<?php
	include "paras.php";
	//$perpage = 50;
	$mode = Get("mode");
	 if(!CheckRights("bgcommodity")){
		echo 123;
		die();
	} 
	switch($mode){
//兑换商品列表
		case "EditGoodsList"://商品列表显示
			$strSql = "Select id, name,type,status from commodity ";
			$data = DBGetDataRows($strSql);
			echo json_encode($data); 
			break; 
		case "ShowEditGoods"://商品详细显示
			$goodsid = (int)(Get("id"));
			$strSql = "Select * from commodity where id=$goodsid ";
			$data = DBGetDataRow($strSql);
			$strSql = "Select * from commoditycodes where commodityid=$goodsid ";
			$code90 = DBGetDataRowsSimple($strSql);
			$data["code90"]=$code90;
			echo json_encode($data);
			break;
		case "UpdateEditGoods":
			$flagid = Get("flagid");//判断是新增还是更新
			$publishid = Get("publishid");//判断是发布还是提交信息//只提交信息0，发布1，撤销-1
			$name = Get("name");
			$picurl = Get("picurl");
			
			$explaintext = Get("explaintext");//兑换说明
			
			$shortdesc = Get("shortdesc");
			$description1 = Get("description1");
			$description2 = Get("description2");
			$description3 = Get("description3");
			$price1 = Get("price1");
			$score1 = Get("score1");
			$price2 = Get("price2");
			$score2 = Get("score2");
			$price3 = Get("price3");
			$score3 = Get("score3");
			$count = Get("count");//兑换数量
			$type = Get("type");//商品类型(10实物商品80不限量虚拟商品90限量虚拟商品)
			$code = Get("code");//兑换码
			$arrFields = array("name","imgurl","explaintext","shortdesc","description1","description2","description3","price1","score1","price2","score2","price3","score3","type","count","status");
			$arrValues = array($name,$picurl,$explaintext,$shortdesc,$description1,$description2,$description3,$price1,$score1,$price2,$score2,$price3,$score3,$type,$count,$publishid);
			DBBeginTrans();
			if($flagid==""){//新增
				$id = DBInsertTableField("commodity" , $arrFields ,$arrValues);
				if($id <= 0)
					AjaxRollBack("-1");
				if($type==90){//限量虚拟商品
					$arr = explode("\n",$code);//分隔兑换码
					$p = 0;
//拆成数组，剔除空行，判断个数（如果个数相同再进行插入操作，否则die）					
					for($i=0;$i<count($arr);$i++){
						if($arr[$i]==""){
							array_splice($arr,$i,1);
						}
					}
					if(count($arr)!=$count){
						die("-99");
					}else{
						for($i=0;$i<count($arr);$i++){
							if($p == 0)
								$strSql = "Insert Into commoditycodes (`commodityid`,`code`,`createtime`,`lastmodifytime`) Values ";
							$p++;
							$strSql .= " ('" . $id . "','".$arr[$i]."',".$DB_FUNCTIONS['now'].",".$DB_FUNCTIONS['now'].")";//拼接插入值

							if($p == count($arr)){
								$result = DBExecute($strSql);//插入操作
								if(!$result)
									AjaxRollBack("2");
							} else {
								$strSql .= " , ";
							}
						}
					}
					
				}
				if($type==80){//不限量虚拟商品的兑换码
					$id = DBUpdateField("commodity" , $id ,array("commoditycode"), array($code));
					if(!$id)
						AjaxRollBack("6");
				}
//兑换码用换行符间隔，php截取字符串转化为数组，进行数据插入和更新						
//用一条insert插入多条values的方法	
			}else{//修改
			
//限量虚拟商品修改功能未完善
				$id = DBUpdateField("commodity" , $flagid ,$arrFields, $arrValues);
				if(!$id)
					AjaxRollBack("3");
				/*if($type==90){//限量虚拟商品
					//更新兑换码
					$arr = explode("\n",$code);//分隔兑换码
					for($i=0;$i<count($arr);$i++){
					//存在问题，逻辑
					//找不到的就是兑换码修改了，找到的是不变
					
						$data1 = DBGetDataRowByField("commoditycodes" , array("commodityid","code"),array($flagid,$arr[$i]));
						$arrFields1 = array("commodityid","code");
						$arrValues1 = array($flagid,$arr[$i]);
						if($data1==null){//新添加的兑换码或者修改了之前的
							$Id = DBInsertTableField("commoditycodes" , $arrFields1 , $arrValues1);
							if($Id<=0)
								AjaxRollBack('4');
						}else{//数据库中已经存在的兑换码
							$id = DBUpdateField("commoditycodes" , $data1["id"] ,$arrFields1, $arrValues1);
							if(!$id)
								AjaxRollBack("5");
						}
					}
				} */
				if($type==80){//不限量虚拟商品的兑换码
					$id = DBUpdateField("commodity" , $flagid,array("commoditycode"), array($code));
					if(!$id)
						AjaxRollBack("7");
				}
				$smarty->clearCache('u.scoremalldetail.tpl',$flagid);//商品详情清除缓存
			}
			DBCommitTrans();
			$smarty->clearCache('u.scoremall.tpl');
			echo 1;
			break;
			
//每个对应商品的兑换一览和领取列表
		case "CurrentEditGoodsGotList":
			$goodsid = (int)(Get("id"));
			$strSql = "Select c.imgurl,c.nickname,c.name,c.mobile,c.isstudent,c.score as custscore, ";
			$strSql.= " e.name as goodsname,e.imgurl as goodsimg,b.price,b.score,b.ordertime,e.type from custcommodityorders b  ";
			$strSql.= " left join custinfo c on b.custid=c.id  ";
			$strSql.= " left join commodity e on b.commodityid=e.id  ";
			$strSql.= " where (b.status=3 or b.status=4 or b.status=5) and  b.commodityid=$goodsid   ";//兑换或者领取
			$data = DBGetDataRowsSimple($strSql);
			echo json_encode($data);
			break;
//商品兑换发放一览
		case "CurrentEditGoodsUsedList":
			$goodsid = (int)(Get("id"));
			$strSql = " Select s.name as salername,s.mobile as salermobile,s.school as salerschool,s.area as salerarea, c.imgurl,c.nickname,c.name,c.mobile,c.isstudent,c.score as custscore, ";
			$strSql.= " e.name as goodsname,e.imgurl as goodsimg,b.price,b.score,b.ordertime,b.scantime,e.type from custcommodityorders b  ";
			$strSql.= " left join custinfo c on b.custid=c.id  ";
			$strSql.= " left join saler s on b.scanerid=s.id  ";
			$strSql.= " left join commodity e on b.commodityid=e.id  ";
			//$strSql.= " where (b.status=5 or b.status=4) and b.commodityid=$goodsid ";//已经领取
			$strSql.= " where b.status=5 and b.commodityid=$goodsid ";//已经领取
			$data = DBGetDataRowsSimple($strSql);
			echo json_encode($data);
			break; 
//商品兑换领取状态查看
	}
?>