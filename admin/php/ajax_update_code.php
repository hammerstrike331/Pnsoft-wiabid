<?php
session_start();
include_once("../lib/common.php");

//print_r($_POST);
//exit;

$up_CLSS_IDX = addslashes($_POST['up_CLSS_IDX']);
$up_CLSS_CD = addslashes($_POST['up_CLSS_CD']);
$up_CLSS_NM = addslashes($_POST['up_CLSS_NM']);
$up_CODELEN = addslashes($_POST['up_CODELEN']);

$up_CLSS_IDX2 = addslashes($_POST['up_CLSS_IDX2']);
$up_CLSS_CD2 = addslashes($_POST['up_CLSS_CD2']);
$up_CODE_CD2 = addslashes($_POST['up_CODE_CD2']);
$up_CODE_NM2 = addslashes($_POST['up_CODE_NM2']);


if($up_CLSS_IDX) {
    $sql = "UPDATE  `tcmn_code_mst` 
        SET `CLSS_CD` = '{$up_CLSS_CD}',
            `CLSS_NM` = '{$up_CLSS_NM}',			
            `CODELEN` = '{$up_CODELEN}',							
            `UPD_USR` = 'admin',
            `UPD_DT` = now()
        WHERE `CLSS_IDX` = '{$up_CLSS_IDX}'
           ";
}


if($up_CLSS_IDX2) {
    $sql = "UPDATE  `tcmn_code_dtl` 
        SET `CLSS_CD` = '{$up_CLSS_CD2}',
            `CODE_CD` = '{$up_CODE_CD2}',			
            `CODE_NM` = '{$up_CODE_NM2}',							
            `UPD_USR` = 'admin',
            `UPD_DT` = now()
        WHERE `CLSS_IDX` = '{$up_CLSS_IDX2}'
           ";
}

sql_query($sql);

echo "수정 완료되었습니다.";
//echo $sql;
//exit;

?>