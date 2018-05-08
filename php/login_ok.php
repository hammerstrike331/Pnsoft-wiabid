<?php
session_start();
include_once ('../admin/lib/common.php');

$mb_id = $_POST['mb_id'];
$mb_pw = $_POST['mb_pw'];

// 전자정부표준프레임 encryptPassword 구현
$hash_out = hash('sha256', $mb_id.$mb_pw,true);
$salt_hash = base64_encode($hash_out);
// =======================================

$sql = "SELECT MBR_NO, MBM_EMAIL_ID, MBR_NM, MNGR_YN  FROM `tcmn_mbr_join` WHERE MBM_EMAIL_ID = '{$mb_id}' AND PSWD_NO = '{$salt_hash}'";
$row = sql_fetch($sql);

//echo $sql;
//exit;

if($row['MBM_EMAIL_ID']) {

    $_SESSION['MBM_EMAIL'] = $row['MBM_EMAIL_ID'];
    $_SESSION['MBM_NM'] = $row['MBR_NM'];
    $_SESSION['MBM_NO'] = $row['MBR_NO'];

    if(strtoupper($row['MNGR_YN']) == 'Y') {
     $_SESSION['MBM_TYPE'] = 'adm';
    }

    $login_proc = '1';
    $sql = "insert into `tbl_login_log` set `login_proc` = '{$login_proc}', `login_ip` = '{$_SERVER['REMOTE_ADDR']}', try_id = '{$mb_id}', try_pwd = '{$mb_pw}', login_date = now() ";
    sql_query($sql);
    move(RT_PATH.'/index.html');
} else {

    $login_proc = '0';
    $sql = "insert into `tbl_login_log` set `login_proc` = '{$login_proc}', `login_ip` = '{$_SERVER['REMOTE_ADDR']}', try_id = '{$mb_id}', try_pwd = '{$mb_pw}', login_date = now() ";
    sql_query($sql);
    alertMove('아이디/비번을 확인해주세요.', RT_PATH."/html/member/login.html");
}

?>