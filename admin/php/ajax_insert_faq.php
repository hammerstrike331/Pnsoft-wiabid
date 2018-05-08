<?php
session_start();
include_once("../lib/common.php");

$FAQ_TYP_CD = $_POST['faq_type'];
$QST_DESC = $_POST['subject'];
$ASK_DESC = $_POST['contents'];
$USE_YN = $_POST['use_yn'];


$sql = "INSERT INTO `tcmn_faq_code`
                 SET FAQ_TYP_CD = '{$FAQ_TYP_CD}',
                 QST_DESC = '{$QST_DESC}',
                 ASK_DESC = '{$ASK_DESC}',
                 USE_YN = '{$USE_YN}',
                 INP_USR = 'admin',
                 INP_DT = now(),
                 UPD_USR = '',
                 UPD_DT = '',
                 TITLE = ''
";

sql_query($sql);

alertMove('FAQ를 추가하였습니다.','../manageFAQ.html');

?>