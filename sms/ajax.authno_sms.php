<?php


$mb_hp = $_POST['reg_mb_hp'];
$mb_hp = str_replace("-", "", $mb_hp);

// 랜던 6자리 숫자
$auth_no = str_pad(mt_rand(0,999999),6,'0');



require_once("coolsms.php");

$sms = new coolsms();
$sms->appversion("TEST/1.0");
$sms->charset("utf8");
$sms->setuser("cnst1616", "cnst0090");

if (!$sms->addsms("$mb_hp", "0325641616", "인증번호는 {$auth_no} 충남스틸 휴대폰인증 문자 입니다.")) {
    // 오류처리
    echo $sms->lasterror();
}

if (!$sms->connect()) {
    // 오류처리
    //echo "서버에 접속할 수 없습니다.";
    $result = "error: 서버접속불가";
    exit(1);
}

$nsent = $sms->send();

// 오류검사
if ($sms->errordetected()) {
    //echo "오류가 발생했습니다 : " . $sms->lasterror();
    $result = "error: " . $sms->lasterror();
}

if($nsent[RESULT-CODE] == '00')
{
    $result = "success";
}

$sms->disconnect();

$sms->emptyall();


echo $result."|".$auth_no;

?>