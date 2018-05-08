<?php
session_start();
include_once("../lib/common.php");

//print_r($_POST);
//exit;

$u_CLSS_IDX = addslashes($_POST['u_CLSS_IDX']);
$u_CLSS_IDX2 = addslashes($_POST['u_CLSS_IDX2']);

if($u_CLSS_IDX) {
    $sql = "DELETE FROM  `tcmn_code_mst` WHERE `CLSS_IDX` = '{$u_CLSS_IDX}'";
}
if($u_CLSS_IDX2) {
    $sql = "DELETE FROM   `tcmn_code_dtl`  WHERE `CLSS_IDX` = '{$u_CLSS_IDX2}'";
}
sql_query($sql);

echo "수정 완료되었습니다.";
//echo $sql;
//exit;

?>