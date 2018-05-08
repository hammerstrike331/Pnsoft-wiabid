<?php
    session_start();
    include_once ('../admin/lib/common.php');
      
    $NTC_NO = addslashes($_POST['P_NTC_NO']);                       // 공고번호
    $QTN_NO = addslashes($_POST['P_QTN_NO']);                       // 견적서번호
    $POST_PERSON_AGREE = addslashes($_POST['POST_PERSON_AGREE']);   // 공고자 1:동의, 2:거절
    $ADD_REQUEST = addslashes($_POST['ADD_REQUEST']);         // 추가요청사항
       
    $sql ="UPDATE `tbid_qtn_mst` SET               
        POST_PERSON_AGREE = '{$POST_PERSON_AGREE}',
        ADD_REQUEST = '{$ADD_REQUEST}'
        WHERE QTN_NO = '{$QTN_NO}'
    ";   
    sql_query($sql);

    $url = RT_PATH.'/html/quotation/contract.html?pid='.$NTC_NO;
    print "<script type='text/javascript'>location.href='$url';</script>";
?>