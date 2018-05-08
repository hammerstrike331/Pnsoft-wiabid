<?php
session_start();
include_once ('../admin/lib/common.php');

ini_set('memory_limit', '64M');


$rtime = mktime();
$rtime2 = mktime()-180;
$cnum = rand(111111,999999);

$ipadr = addslashes($_POST['ipadr']);
$hp = $_POST['hp'];             /// recieve mail address

$sqlqq = " SELECT count(*) as cnt FROM a_hpcheck where ipadr = '$ipadr' and rtime > '$rtime2' order by no desc ";
$rowqq = sql_fetch($sqlqq);
$total_count = $rowqq[cnt];

if($total_count == 0 ) {

    $s_send = "info@wiabid.com";
    // $s_recive = $_POST['sendMails'];    
    $s_subject = "인증번호란에 입력해주세요 ";
    $s_content = $cnum." [국제물류]인증번호\n 인증번호란에 입력해주세요";
    
    $charset = "UTF-8";

    $header = "Content-Type: text/html; charset=utf-8\r\n";
    $header .= "MIME-Version: 1.0\r\n";

    $header .= "Return-Path: <". $s_send .">\r\n";
    $header .= "From: ". $s_send ." <". $s_send .">\r\n";
    $header .= "Reply-To: <". $s_send .">\r\n";

    $result = mail($hp, $s_subject, $s_content, $header, $s_send);

    $sql = "INSERT INTO a_hpcheck SET
            no = '$no',
            hp = '$hp',
            cnum = '$cnum',
            rtime = '$rtime',
            ytime = '$ytime',
            ipadr = '$ipadr',
            yes = '0'  ";
    sql_query($sql);
    
echo 'ok';exit;

} else {
echo "fail";

}

?>