<?php
session_start();
include_once("../lib/common.php");

$term1 = addslashes($_POST['term1']);
$term2 = addslashes($_POST['term2']);
$term3 = addslashes($_POST['term3']);

$update_sql = "UPDATE `tbl_term` SET term1 = '{$term1}',  term2 = '{$term2}',  term3 = '{$term3}' WHERE idx = '1'";
$result = sql_query($update_sql);
// echo $update_sql . "<br>";

if($result) {
    echo "ok|약관수정 완료";
} else {
    echo "err|약관수정 실패";
}

?>