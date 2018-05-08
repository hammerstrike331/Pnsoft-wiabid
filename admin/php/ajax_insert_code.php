<?php
session_start();
include_once("../lib/common.php");

$u_CLSS_CD = addslashes($_POST['u_CLSS_CD']);
$u_CLSS_NM = addslashes($_POST['u_CLSS_NM']);
$u_CODELEN = addslashes($_POST['u_CODELEN']);


$u_CLSS_CD2 = addslashes($_POST['u_CLSS_CD2']);
$u_CODE_CD2 = addslashes($_POST['u_CODE_CD2']);
$u_CODE_NM2 = addslashes($_POST['u_CODE_NM2']);


if($u_CLSS_CD) {
    $sql = "INSERT INTO  `tcmn_code_mst` 
            SET `CLSS_CD` = '{$u_CLSS_CD}',
                `CLSS_NM` = '{$u_CLSS_NM}',			
                `CODELEN` = '{$u_CODELEN}',							
                `INP_USR` = 'admin',
                `INP_DT` = now()
           ";
}


if($u_CLSS_CD2) {
    $sql = "INSERT INTO  `tcmn_code_dtl` 
            SET `CLSS_CD` = '{$u_CLSS_CD2}',
                `CODE_CD` = '{$u_CODE_CD2}',			
                `CODE_NM` = '{$u_CODE_NM2}',							
                `INP_USR` = 'admin',
                `INP_DT` = now()
           ";
}
sql_query($sql);

echo " 입력 완료되었습니다.";
//echo $sql;
//exit;

?>