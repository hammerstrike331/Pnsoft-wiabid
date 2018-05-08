<?php
	session_start();
	include_once("../lib/common.php");

	// 관리자 세션 확인
	if(!isset($_SESSION['ADMIN_GRPNAME'])) {
	    alertMove('로그인 후 이용해 주세요', "../index.html");
	}

	$s_send = "info@wiabid.com";
	$s_recive = $_POST['sendMails'];	
	$s_subject = $_POST['sendSubject'];
	$s_content = $_POST['sendContents'];
	$NtcQtnNoList = $_POST['NtcQtnNoList'];
	$type = $_POST['type'];
	
	// 받는 메일 체크
	$s_recive = preg_replace("/\s+/","",$s_recive);
	$s_recive = str_replace(",", ";", $s_recive);

	$s_recive_string = $s_recive;
	$s_recive_array = explode (";", $s_recive_string);
	$s_count = count($s_recive_array);

	$charset = "UTF-8";

	$header = "Content-Type: text/html; charset=utf-8\r\n";
	$header .= "MIME-Version: 1.0\r\n";

	$header .= "Return-Path: <". $s_send .">\r\n";
	$header .= "From: ". $s_send ." <". $s_send .">\r\n";
	$header .= "Reply-To: <". $s_send .">\r\n";

	if ($cc) 
		$header .= "Cc: ". $cc ."\r\n";

	if ($bcc)
		$header .= "Bcc: ". $bcc ."\r\n";

	//마지막 문자열이 ";"이면
	$s_recive_end = substr($s_recive_string,-1);

	if($s_recive_end == ';') {
	    $s_count = $s_count - 1;
	}

	//보내지 못한 횟수
	$no_send = 0;

	$temp = "";
	$email_array = array();

	for ($i = 0; $i < $s_count; $i++) {
	    //$result = mail($s_recive_array[$i], $s_subject, $s_content, $header,  '-f'.$s_send);
	    $result = mail($s_recive_array[$i], $s_subject, $s_content, $header, $s_send);

	    if(!$result) {
	        $no_send = $no_send + 1;
	    }
	    $temp .= $s_recive_array[$i].";";
	    array_push($email_array, $s_recive_array[$i]);
	}

	if($NtcQtnNoList) {
		$no_array = json_decode($NtcQtnNoList);		

        foreach ($no_array as $key => $value) {
        	$REF_NO = $value;
            $REF_KND_CD = "";

            if(strpos($REF_NO, "BID") !== false) 
            	$REF_KND_CD = "NTC";
            else if(strpos($REF_NO, "QTN") !== false) 
            	$REF_KND_CD = "QTN";

            $sql = "INSERT INTO tbid_mail_log SET 
            	REF_KND_CD = '{$REF_KND_CD}',
            	REF_NO = '{$REF_NO}',
            	SUBJECT = '{$s_subject}',
            	PIC_EMAIL = '{$email_array[$key]}',
            	CONTEXT = '{$s_content}',
            	SEND_DT = NOW()
            ";
            sql_query($sql);            
        }
    }

    if ($type == "ajax") {
		$msg = "ok|메일전송을 완료 하였습니다.";
	    $s_result = json_encode($msg);
	    echo $s_result;
	    exit;
    }else {
    	alertMove('메일을 정확히 전송하였습니다.','../memberList.html');
    }

?>