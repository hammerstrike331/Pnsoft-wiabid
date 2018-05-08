<?php
session_start();

include_once("../lib/common.php");

$m_id = (string)$_POST['m_id'];
$password = (string)$_POST['m_pw'];

function login($m_id, $password)
{
    $sid = 'admin';
    $spw = 'admin!@#4';

    if ($m_id == $sid && $password == $spw) { // 로그인이 성공한 경우
        // 로그인 성공에 로그인 로그 입력
        $result["ADMIN_ID"] = $m_id;
        $result['ADMIN_GRPCD'] = 0;
        $result['ADMIN_GRPNAME'] = '통합관리자';

        // 세션정보 저장
        $_SESSION['ADMIN_ID'] = $result['ADMIN_ID'];
        $_SESSION['ADMIN_GRPCD'] = $result['ADMIN_GRPCD'];
        $_SESSION['ADMIN_GRPNAME'] = $result['ADMIN_GRPNAME'];
        $_SESSION['ADMIN_LEVEL'] = '1';

        return true;
    } else {
        return 'NOT_ACCESS';
    }

}


if($m_id == "admin") {
    //슈퍼관리자 전용
    $result = login($m_id, $password);
} else {


    $mb_id = $_POST['m_id'];
    $mb_pw = $_POST['m_pw'];

//    alert($mb_id);

    // 전자정부표준프레임 encryptPassword 구현
        $hash_out = hash('sha256', $mb_id.$mb_pw,true);
        $salt_hash = base64_encode($hash_out);
    // =======================================

    $sql = "SELECT MBM_EMAIL_ID, MBR_NM, MNGR_YN  FROM `tcmn_mbr_join` WHERE JOIN_STS_CD = 'JOIN' AND MNGR_YN = 'Y' AND MBM_EMAIL_ID = '{$mb_id}' AND PSWD_NO = '{$salt_hash}'";
    $row = sql_fetch($sql);
    // echo $sql;

    if($row['MBM_EMAIL_ID']) {
        // 세션정보 저장
        $_SESSION['ADMIN_ID'] = $mb_id;
        $_SESSION['ADMIN_GRPCD'] = '0';
        $_SESSION['ADMIN_GRPNAME'] = '관리자';
        $_SESSION['ADMIN_LEVEL'] = '1';
//        return true;

        $result = true;

    } else {
        $result = 'NOT_ACCESS';
    }
}

if ($result !== true) {

    $login_proc = '0';
    $sql = "insert into `tbl_login_log` set `login_proc` = '{$login_proc}', `login_ip` = '{$_SERVER['REMOTE_ADDR']}', try_id = '{$m_id}', try_pwd = '{$password}', login_date = now() ";
    sql_query($sql);

    if ($result === 'NOT_FOUND') {
        alertMove('아이디 또는 비밀번호 오류입니다', '../index.html');
    } elseif ($result === 'NOT_ACCESS') {
        alertMove('승인되지 않아 로그인이 제한됩니다.', '../index.html');
    }
    if ($result === 'NOT_VALID') {
        alertMove('ID 또는 비밀번호를 입력하는 중 오류가 발생했습니다.', '../index.html');
    }

    exit;
} else {
    $login_proc = '1';
    $sql = "insert into `tbl_login_log` set `login_proc` = '{$login_proc}', `login_ip` = '{$_SERVER['REMOTE_ADDR']}', try_id = '{$m_id}', try_pwd = '{$password}', login_date = now() ";
    sql_query($sql);
}

//echo $sql;
////echo "<p>";

//echo $_SESSION['ADMIN_GRPNAME'] . " 로그인 완료";
move('../stats.html');


?>