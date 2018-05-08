<?php
    session_start();
    include_once("../lib/common.php");

    header("Content-Type: application/json");

    $chk = $_POST['chk'];
    $INV_YYMM = $_POST['INV_YYMM'];
    $INV_YYMM = str_replace('-', '', $INV_YYMM);

    if($chk) {
        $chk_array = json_decode($chk);

        $i = 0;
        foreach ($chk_array as $key => $value) {
            $INV_NO = $value;
            $sql = "UPDATE tbid_inv_mst SET INV_STS_CD = '정산', INV_YYMM = '{$INV_YYMM}' WHERE INV_NO = '{$INV_NO}'";
            sql_query($sql);
            $i++;
        }

        $msg = "ok|".$i ."건을 정산 처리 하였습니다.";
        $result = json_encode($msg);
        echo $result;
    } else {
        $msg ="err|처리되지 않았습니다.";
        $result = json_encode($msg);
        echo $result;        
    }
?>