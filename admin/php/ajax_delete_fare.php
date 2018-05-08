<?php
session_start();
include_once("../lib/common.php");

header("Content-Type: application/json");

$chk = $_POST['chk'];

if($chk) {
    $chk_array = json_decode($chk);

    $i = 0;
    foreach ($chk_array as $key => $value) {

        // 실제 번호를 넘김
        $k = $value;

        $sql = "DELETE FROM `tcmn_frt_code` WHERE `IDX`='$k' ";
        sql_query($sql);

        $i++;
    }

    $msg = "ok|".$i ."건을 삭제 하였습니다.";
    $result = json_encode($msg);
    echo $result;
    //echo $msg;

} else {

    $msg ="err|처리되지 않았습니다.";
    $result = json_encode($msg);
    echo $result;
    //echo $msg;
}


?>
