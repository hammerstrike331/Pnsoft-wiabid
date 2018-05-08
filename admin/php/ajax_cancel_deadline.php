<?php
    session_start();
    include_once("../lib/common.php");

    header("Content-Type: application/json");

    $chk = $_POST['chk'];

    if($chk) {
        $chk_array = json_decode($chk);

        $i = 0;
        foreach ($chk_array as $key => $value) {
            $NTC_NO = $value;
            $sql = "UPDATE tbid_ntc_mst SET NTC_STS_CD = '30', CLOSE_TYP_NM = '미마감' WHERE NTC_NO = '{$NTC_NO}'";
            sql_query($sql);
            $i++;
        }

        $msg = "ok|".$i ."건을 마감취소 처리 하였습니다.";
        $result = json_encode($msg);
        echo $result;
    } else {
        $msg ="err|처리되지 않았습니다.";
        $result = json_encode($msg);
        echo $result;        
    }
?>