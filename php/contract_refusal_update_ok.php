<?php
    session_start();
    include_once ('../admin/lib/common.php');
      
    $NTC_NO = addslashes($_POST['B_NTC_NO']);             // 공고번호
    $QTN_NO = addslashes($_POST['B_QTN_NO']);             // 견적서번호
    $BID_PERSON_AGREE = addslashes($_POST['BID_PERSON_AGREE']);     // 공고자 1:동의, 2:거절
       
    $sql ="UPDATE `tbid_qtn_mst` SET               
        BID_PERSON_AGREE = '{$BID_PERSON_AGREE}'
        WHERE QTN_NO = '{$QTN_NO}'
    ";   
    
    sql_query($sql);

    $url = RT_PATH.'/html/quotation/contract.html?pid='.$NTC_NO;
    print "<script type='text/javascript'>location.href='$url';</script>";
?>