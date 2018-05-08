<?php
session_start();
include_once ('../admin/lib/common.php');

// 임시비번을 보내기 위한 아이디
$find_pw = clean_xss_tags($_POST['mb_id']);

if ($find_pw) {

    $sql = "SELECT MBM_EMAIL_ID  FROM `tcmn_mbr_join` WHERE MBM_EMAIL_ID = '{$find_pw}'";
    $row = sql_fetch($sql);
    $mb_id = $row['MBM_EMAIL_ID'];

    if ($row['MBM_EMAIL_ID'])
    {

        function random_char($length)
        {
            //  임시 비밀번호 6자리
            $str = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $max = strlen($str) - 1;
            $chr = '';
            $len = abs($length);

            for ($i = 0; $i < $len; $i++) {
                $chr .= $str[mt_rand(0, $max)];
            }
            return $chr;
        }

        // 신규 비번 6자리
        $temp_pw = random_char(6);



        // 전자정부표준프레임 encryptPassword 구현
        $hash_out = hash('sha256', $mb_id.$temp_pw,true);
        $salt_hash = base64_encode($hash_out);
        // =======================================


        $sql = " UPDATE `tcmn_mbr_join`  SET  `PSWD_NO` = '{$salt_hash}' WHERE MBM_EMAIL_ID = '{$mb_id}' ";
        $result = sql_query($sql);

        if ($result) {

            //메일 보내기 ##############################

            // 보내는 메일 이메일 형식 테스트
            $s_send = "info@wiabid.com";
            $s_send = preg_replace("/\s+/", "", $s_send);

            // 받는 메일 체크

            $s_recive = preg_replace("/\s+/", "", $mb_id);
            $s_recive = str_replace(",", ";", $s_recive);

            $charset = "UTF-8";

            $header = "Content-Type: text/html; charset=utf-8\r\n";
            $header .= "MIME-Version: 1.0\r\n";
            $header .= "Return-Path: <" . $s_send . ">\r\n";
            $header .= "From: " . $s_send . " <" . $s_send . ">\r\n";
            $header .= "Reply-To: <" . $s_send . ">\r\n";
            if ($cc) $header .= "Cc: " . $cc . "\r\n";
            if ($bcc) $header .= "Bcc: " . $bcc . "\r\n";

            // 제목
            $s_subject = "임시 비밀번호를 보내드립니다.";

            // 메일 내용
            $s_content = '
<html>
<head>
    <title>비밀번호</title>
</head>
<body leftmargin="0" topmargin="0" text="#000000" marginheight="0" marginwidth="0">
<m-ta http-equiv="content-type" content="text/html;charset=UTF-8">
    <style>
        A:link {
            COLOR: #333333; TEXT-DECORATION: none
        }
        A:visited {
            COLOR: #333333; TEXT-DECORATION: none
        }
        A:hover {
            COLOR: #4282e1; TEXT-DECORATION: underline
        }
        P {
            LINE-HEIGHT: 140%; COLOR: #333333; FONT-SIZE: 9pt
        }
        BR {
            LINE-HEIGHT: 140%; COLOR: #333333; FONT-SIZE: 9pt
        }
        BODY {
            LINE-HEIGHT: 140%; COLOR: #333333; FONT-SIZE: 9pt
        }
        TD {
            LINE-HEIGHT: 140%; COLOR: #333333; FONT-SIZE: 9pt
        }
    </style>

    <br><br><br>
    <table border="0" cellspacing="0" cellpadding="0" width="570" align="center">
        <tbody><tr>
            <td align="center"><img src="http://kobic.me/img/pw_top.gif" width="590" height="113"></td>
        </tr>
        <tr>
            <td background="http://kobic.me/img/pw_bg.gif" align="center">
                <table border="0" cellspacing="0" cellpadding="0" width="90%">
                    <tbody><tr>
                        <td height="65" align="left">
                            &nbsp;&nbsp;&nbsp;안녕하세요. Wiabid 운영팀입니다. 요청하신 <b>비밀번호 안내</b>입니다. <br>
                            <font color="#ffffff">---</font>비밀번호는 임시 발급된 번호입니다.<br><font color="#ffffff">---</font>로그인 후 <b> Mypage </b>에서 수정해 주시기 바랍니다.
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#e6e6e6" height="1"></td>
                    </tr>
                    <tr>
                        <td height="100" align="center">
                            <table border="0" cellspacing="0" cellpadding="0" width="320">

                                <tbody><tr>
                                    <td bgcolor="#333333" height="2"></td>
                                </tr>
                                <tr>
                                    <td>
                                        <table border="0" cellspacing="0" cellpadding="0" width="100%">

                                            <tbody><tr>
                                                <td style="PADDING-LEFT:" 15px="" bgcolor="#f7f7f7" height="30" width="130" align="left">
                                                    <b><font color="#333333">&nbsp;&nbsp;아이디(이메일)</font></b>
                                                </td>
                                                <td width="10"></td>
                                                <td align="left">'. $m_id .'</td>
                                            </tr>

                                            </tbody></table>
                                    </td>
                                </tr>
                                <tr>
                                    <td bgcolor="#dddddd" height="1"></td>
                                </tr>
                                <tr>
                                    <td>
                                        <table border="0" cellspacing="0" cellpadding="0" width="100%">

                                            <tbody><tr>
                                                <td style="PADDING-LEFT:" 15px="" bgcolor="#f7f7f7" height="30" width="130" align="left"><font color="#333333"><b>&nbsp;&nbsp;비밀번호</b></font>
                                                </td>
                                                <td width="10"></td>
                                                <td align="left">'. $temp_pw .'</td>
                                            </tr>

                                            </tbody></table>
                                    </td>
                                </tr>
                                <tr>
                                    <td bgcolor="#dddddd" height="1"></td>
                                </tr>

                                </tbody></table>
                        </td>
                    </tr>
                    <tr>
                        <td height="60" align="center"> <a href="http://kobic.me" target="_blank"><font color="#333333" style="font-size:17px"><b>[사이트 바로가기]<b></b></b></font></a><font color="#333333" style="font-size:17px"><b><b>
                                    </b></b></font></td>
                    </tr>
                    <tr>
                        <td height="10" align="middle"></td>
                    </tr>
                    <tr>
                        <td align="middle">
                            이 메일은 비밀번호와 관련된 메일이므로 읽은 후 바로 삭제하는 것이 안전합니다.<br>
                            이메일 유출로 인해 발생한 문제에 대한 책임은 저희에게 있지 않습니다.
                        </td>
                    </tr>
                    </tbody></table>
                <table border="0" cellspacing="0" cellpadding="0" width="100%">

                    <tbody>
                    <tr>
                        <td align="center"> <img src="http://kobic.me/img/pw_bar.gif" width="567" height="16">
                        </td>
                    </tr>
                    <tr>
                        <td style="FONT-SIZE:" 8pt="" height="50" valign="bottom" align="center">
                            Copyright © 2017 ㈜한국국제물류플랫폼 All rights reserved.
                        </td>
                    </tr>
                    <tr>
                        <td height="5" align="middle"></td>
                    </tr>

                    </tbody></table>
            </td>
        </tr>
        <tr>
            <td> <img src="http://kobic.me/img/pw_foot.gif" width="590" height="17"></td>
        </tr>

        </tbody></table>
    <br><br><br>
</body></html>';
            //임시 비밀번호는 " . $temp_pw . " 입니다.";

            $result_send = mail($s_recive, $s_subject, $s_content, $header, $s_send);

            if (!$result_send) {
                $err = 'ok|비번은 변경했으나.... 메일은 못보냈습니다.';

            } else {
                $err = 'ok|임시비번을 등록된 이메일로 발송했습니다.';
            }
        }


    } else {
        $err = 'no|가입정보가 없습니다. 다시 확인 해주세요.';
    }


} else {
    $err = 'no|'. print_r($_POST) .'아이디가 정확하지 않습니다.';
}

echo $err;

?>