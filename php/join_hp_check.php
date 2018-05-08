<?php
session_start();
include_once ('../admin/lib/common.php');

ini_set('memory_limit', '64M');

$rtime = mktime();
$rtime2 = mktime()-5000;

$ipadr = $_POST['ipadr'];
$hp = $_POST['hp'];
$cnum = $_POST['cnum'];

$sqlqq = " SELECT count(*) as cnt FROM a_hpcheck where hp = '$hp' and cnum = '$cnum' and ipadr = '$ipadr' and rtime > '$rtime2' order by no desc ";
$rowqq = sql_fetch($sqlqq);
$total_count = $rowqq[cnt];

if($total_count > 0 ){
	
	$sql = "update a_hpcheck SET
			ytime = '$rtime',
			yes = '1' where hp = '$hp' and cnum = '$cnum' and ipadr = '$ipadr' and rtime > '$rtime2' ";
    sql_query($sql);

echo "ok";

}else{
  echo "fail";

}

?>