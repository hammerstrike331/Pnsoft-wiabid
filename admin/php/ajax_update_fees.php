<?php
    session_start();
    include_once("../lib/common.php");

    $up_idx = addslashes($_POST['up_idx']);
    $comp_cd = addslashes($_POST['comp_cd']);    
    $bid_knd = addslashes($_POST['bid_knd']);
    $sa_cls_cd = addslashes($_POST['sa_cls_cd']);
    $fee_value = addslashes($_POST['fee_value']);
    $unit_rate = addslashes($_POST['unit_rate']);    
    $aply_ymd = addslashes($_POST['aply_ymd']);
    $expr_ymd = addslashes($_POST['expr_ymd']);

    $sql1 = "SELECT COMP_NM FROM tcmn_mbr_comp WHERE COMP_CD='{$comp_cd}'";
    $row = sql_fetch($sql1);
    $comp_nm = $row['COMP_NM'];

    $sql2 = "UPDATE `tcmn_fee_rate` SET 
                `COMP_CD` = '{$comp_cd}',
                `COMP_NM` = '{$comp_nm}',
                `BID_CLS_CD` = '{$bid_knd}',            
                `SA_CLS_CD` = '{$sa_cls_cd}',                           
                `FEE_VAL` = '{$fee_value}', 
                `UNIT_RATE` = '{$unit_rate}',
                `APLY_YMD` = '{$aply_ymd}',
                `EXPR_YMD` = '{$expr_ymd}',                
                `UPD_YMD` = now()
                WHERE `CMTSN_RATE_NO` = '{$up_idx}'
            ";
    sql_query($sql2);

    echo "수정 완료되었습니다.";
?>