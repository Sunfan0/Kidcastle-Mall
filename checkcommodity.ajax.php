<?php
	include "paras.php";

	$mode = Get("mode");
	$checktoken = Get("checktoken");//销售人员身份验证
	$checksalerid = Get("checksalerid");//销售人员id
	
	$salerinfo = DBGetDataRowByField("saler","id",$salerid);
	if($salerinfo == null)
		die("1");
	if($salerinfo["status"] != 1)//销售人员审核拒绝
		die("2");

	$checksaleropenid=$salerinfo["openid"];
	$strcheckopenid = substr($checksaleropenid, 0, 10);
	$salerflag=false;
	for($i=0;$i<11;$i++){//10分钟之内
		$strnow = date("YmdHi", time()-60*$i);
		$tokenpara = md5($checksalerid.$strcheckopenid.$strnow);
		if($checktoken==$tokenpara){
			$salerflag = true;
			break;
		}
	}
	if($salerflag!=true){//身份验证出错
		die("3");
	}

//线下领取实物奖品
	//
	switch($mode){	
		//兑换领取数据
		case "showuserinfo"://显示用户信息
			$id = (int)(Get("id"));//兑换明细表中数据id
			$strSql = "	select c.ordertime,c.price,c.score,c.status,c.scantime,s.name as salername,s.mobile as salermobile, ";
			$strSql .= " s.school as salerschool,s.area as salerarea,d.name as custname,d.mobile as custmobile,d.score as custscore, ";
			$strSql .= " p.name as goodsname,p.shortdesc ";
			$strSql .= " FROM `custcommodityorders` c  ";
			$strSql .= " left join saler s on c.scanerid = s.id ";
			$strSql .= " left join custinfo d on c.custid = d.id ";
			$strSql .= " left join commodity p on c.commodityid = p.id ";
			$strSql .= " WHERE c.id=$id ";
			$result = DBGetDataRow($strSql);
			echo json_encode($result);
			break;
			

		case "comfirmsale":	//实物商品确认兑换领取
			$id = Get("id");//兑换明细表中数据id
			$salerid = Get("salerid");//销售人员id
			$Info = DBGetDataRowByField("custcommodityorders","id",$id);
			if($Info==null){
				die("-9");
			}
			$r = DBUpdateField("custcommodityorders" , $id , array("status","scantime","scanerid") ,array(4,$DB_FUNCTIONS["now"],$salerid));
			if(!$r)
				echo -1;
			else
				echo 1;
			break;
			
	}
?>