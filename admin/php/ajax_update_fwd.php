<?php
session_start();
include_once("../lib/common.php");

// print_r($_POST);exit;
//echo '<p>';

    $IDX = $_POST['IDX'];
    $SEQ = $_POST['SEQ'];
    $type = $_POST['type'];
    $value = $_POST['value'];

    if ($type == "forwarder") {
    	$sql = " UPDATE `tbid_spc_fdr` SET  `DISP_YN` = '{$value}', DISP_YMD = NOW() WHERE `IDX` = '{$IDX}'";
    }
    else if ($type == "fare") {
    	$sql = " UPDATE `tcmn_fwd_trf` SET  `DISP_YN` = '{$value}', UPD_YMD = NOW() WHERE `SEQ` = '{$SEQ}'";
    }
    
    // echo $sql . "<br>";
    sql_query($sql);

exit;