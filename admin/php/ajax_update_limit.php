<?php
    session_start();
    include_once("../lib/common.php");

    header("Content-Type: application/json");

    $COMP_CD = $_POST['COMP_CD'];
    $LIMIT_KND_CD = $_POST['LIMIT_KND_CD'];
    $LIMIT_CD = $_POST['LIMIT_CD'];

    if($COMP_CD) {
        $sql = "UPDATE tcmn_mbr_comp SET LIMIT_KND_CD = '{$LIMIT_KND_CD}', LIMIT_CD = '{$LIMIT_CD}' WHERE COMP_CD = '{$COMP_CD}'";
        sql_query($sql);

        $msg = "ok|수정 완료하였습니다.";
        $result = json_encode($msg);
        echo $result;
    } else {
        $msg ="err|처리되지 않았습니다.";
        $result = json_encode($msg);
        echo $result;        
    }
?>