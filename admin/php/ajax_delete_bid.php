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

            $sql1 = "DELETE FROM tbid_ntc_mst WHERE NTC_NO='$k' ";
            sql_query($sql1);
            $sql2 = "DELETE FROM tbid_ntc_crgo WHERE NTC_NO='$k' ";
            sql_query($sql2);
            $sql3 = "DELETE FROM tbid_ntc_crgo_route WHERE NTC_NO='$k' ";
            sql_query($sql3);
            $sql4 = "DELETE FROM tbid_qtn_mst WHERE NTC_NO='$k' ";
            sql_query($sql4);
            $sql5 = "DELETE FROM tbid_qtn_trs WHERE NTC_NO='$k' ";
            sql_query($sql5);

            $i++;
        }

        $msg = "ok|".$i ."건을 삭제 하였습니다.";
        $result = json_encode($msg);
        echo $result;
    } else {
        $msg ="err|처리되지 않았습니다.";
        $result = json_encode($msg);
        echo $result;     
    }
?>