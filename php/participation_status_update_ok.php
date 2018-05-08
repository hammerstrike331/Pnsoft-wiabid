<?php
    session_start();
    include_once ('../admin/lib/common.php');
      
    $NTC_NO = addslashes($_POST['NTC_NO']);             // 공고번호
    $QTN_NO = addslashes($_POST['QTN_NO']);             // 견적서번호
    $QTN_STS_CD = addslashes($_POST['QTN_STS_CD']);     // 참여현황   20:낙찰, 40:유보, 50:제외
       
    $sql ="UPDATE `tbid_qtn_mst` SET               
        QTN_STS_CD = '{$QTN_STS_CD}'
        WHERE QTN_NO = '{$QTN_NO}'
    ";   
    sql_query($sql);

    $url = RT_PATH.'/html/quotation/participation_status.html?pid='.$NTC_NO;
    print "<script type='text/javascript'>location.href='$url';</script>";
?>