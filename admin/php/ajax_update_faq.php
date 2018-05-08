<?php
session_start();
include_once("../lib/common.php");

$no = $_POST['no'];
$type = $_POST['type'];
$value = $_POST['value'];

if ($type == "permitionUpdate") {
    $sql = " UPDATE `tcmn_faq_code` SET USE_YN = '{$value}' WHERE FAQ_NO = '$no' ";
}
else if ($type == "update") {
    $FAQ_TYP_CD = $_POST['faq_type'];
    $QST_DESC = $_POST['subject'];
    $ASK_DESC = $_POST['contents'];
    $USE_YN = $_POST['use_yn'];

    $sql = "UPDATE `tcmn_faq_code`
                     SET FAQ_TYP_CD = '{$FAQ_TYP_CD}',
                     QST_DESC = '{$QST_DESC}',
                     ASK_DESC = '{$ASK_DESC}',
                     USE_YN = '{$USE_YN}',
                     UPD_USR = '{$_SESSION['MBM_NO']}',
                     UPD_DT = now(),
                     TITLE = ''
                WHERE FAQ_NO = '$no' ";

    sql_query($sql);
    alertMove('FAQ를 수정하였습니다.','../manageFAQ.html');
}
else if ($type == "delete") {
    $sql = "DELETE FROM `tcmn_faq_code` WHERE FAQ_NO = '$no' ";
}

sql_query($sql);
echo "success";
exit;