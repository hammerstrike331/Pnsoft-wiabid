<?php
session_start();
include_once ('../admin/lib/common.php');

//print_r($_POST);
$mb_id = $_SESSION['MBM_EMAIL'];
$mb_pw = $_POST['PASSWD_OLD'];

$PASSWD1 = addslashes($_POST['PASSWD1']);
$PASSWD2 = addslashes($_POST['PASSWD2']);

if($PASSWD1 == $PASSWD2) {

    // 전자정부표준프레임 encryptPassword 구현
    $hash_out = hash('sha256', $mb_id.$mb_pw,true);
    $salt_hash = base64_encode($hash_out);
    // =======================================

    $sql = "SELECT MBR_NO, MBM_EMAIL_ID, MBR_NM, MNGR_YN  FROM `tcmn_mbr_join` WHERE MBM_EMAIL_ID = '{$mb_id}' AND PSWD_NO = '{$salt_hash}'";
    $row = sql_fetch($sql);

    if($row['MBM_EMAIL_ID']) {
        //echo "비번이 맞습니다.<p>";

        // 전자정부표준프레임 encryptPassword 구현
        $hash_out2 = hash('sha256', $mb_id.$PASSWD2,true);
        $salt_hash2 = base64_encode($hash_out2);
        // =======================================

        $sql1 = "UPDATE `tcmn_mbr_join` SET PSWD_NO = '{$salt_hash2}' WHERE MBM_EMAIL_ID = '{$mb_id}'";
        sql_query($sql1);
        alertMove('수정되었습니다. 다음 로그인부터 적용됩니다.', RT_PATH.'/html/my/my_edit.html');
    } else {
        alertMove('이전 비밀번호가 다릅니다. 확인해주세요~', RT_PATH.'/html/my/my_edit.html');
    }

} else {
    alertMove('변경 비밀번호가 다릅니다. 확인해주세요~', RT_PATH.'/html/my/my_edit.html');
}

