<?php
    session_start();
    include_once("../lib/common.php");

    header("Content-Type: application/json");

    $QTN_NO_LIST = $_POST['QTN_NO_LIST'];
    $VALUE_LIST = $_POST['VALUE_LIST'];

    if($QTN_NO_LIST) {
        $qtn_array = json_decode($QTN_NO_LIST);
        $value_array = json_decode($VALUE_LIST);

        $i = 0;
        foreach ($qtn_array as $key => $value) {
            $QTN_NO = $value;
            $VALUE = $value_array[$i];
            
            $sql = "UPDATE tbid_qtn_mst SET OTH_RANK_CD = '{$VALUE}'  WHERE QTN_NO = '{$QTN_NO}'";
            sql_query($sql);

            $i++;
        }

        $msg = "ok|".$i ."건을 처리 하였습니다.";
        $result = json_encode($msg);
        echo $result;        
    } else {
        $msg ="err|처리되지 않았습니다.";
        $result = json_encode($msg);
        echo $result;        
    }
?>