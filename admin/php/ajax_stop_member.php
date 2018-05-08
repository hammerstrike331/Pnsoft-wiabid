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

        //   탈퇴 0, 사용중 1, 사용중지 2
        $sql = " update  `tcmn_mbr_join` SET `JOIN_STS_CD` = 'SCDE'  where `MBR_NO` = '$k' ";
        sql_query($sql);

        $i++;
    }

    $msg = "ok|".$i ."건을 사용정지(탈퇴) 처리 하였습니다.";
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