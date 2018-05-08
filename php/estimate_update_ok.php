<?php
    session_start();
    include_once ('../admin/lib/common.php');
       
    //*****기본정보*****//    
    $MBM_NO = addslashes($_POST['MBM_NO']);         // 견적서번호
    $QTN_NO = addslashes($_POST['QTN_NO']);         // 견적서번호
    $QTN_NM = addslashes($_POST['QTN_NM']);         // 견적명
    $QTN_YMD = addslashes($_POST['QTN_YMD']);       // 견적일자
    $QTN_YMD = str_replace("-", "", $QTN_YMD);
        
    //*****선적정보*****//
    $DISTRICT = addslashes($_POST['DISTRICT']);     // 경유지
    $VSL_NM = addslashes($_POST['VSL_NM']);         // 선사명
    $LINER_NM = addslashes($_POST['LINER_NM']);     // 선(기)명
    $VOY_NO = addslashes($_POST['VOY_NO']);         // 항차
    $DOC_CLOSE_YMD = $_POST['DOC_CLOSE_YMD'];       // 서류마감
    $CRG_CLOSE_YMD = $_POST['CRG_CLOSE_YMD'];       // 화물마감
    $ETD_YMD = $_POST['ETD_YMD'];                   // ETD
    $VIA_YMD = $_POST['VIA_YMD'];                   // ETA(via)
    $ETA_YMD = $_POST['ETA_YMD'];                   // ETA
    $TRS_DAYS_CNT = $_POST['TRS_DAYS_CNT'];         // 운송일수

    //*****참조사항*****//
    $REMARK = addslashes($_POST['REMARK']);         // 참조사항

    $sql1 ="UPDATE `tbid_qtn_mst` SET               
        QTN_NM = '{$QTN_NM}',         
        QTN_YMD = '{$QTN_YMD}',
        REMARK = '{$REMARK}',
        QTN_BID_DT = NOW(),
        UPD_DT =  NOW(),
        UPD_ID = '{$MBM_NO}' 
        WHERE QTN_NO = '{$QTN_NO}'
    ";   
    sql_query($sql1);

    $sql2 ="UPDATE `tbid_qtn_trs` SET               
        VSL_NM = '{$VSL_NM}',         
        LINER_NM = '{$LINER_NM}',
        VOY_NO = '{$VOY_NO}',
        DOC_CLOSE_YMD = '{$DOC_CLOSE_YMD}',
        CRG_CLOSE_YMD = '{$CRG_CLOSE_YMD}',
        ETD_YMD = '{$ETD_YMD}',
        VIA_YMD = '{$VIA_YMD}',
        ETA_YMD = '{$ETA_YMD}',
        TRS_DAYS_CNT = '{$TRS_DAYS_CNT}',
        DISTRICT = '{$DISTRICT}',        
        UPD_DT =  NOW(),
        UPD_ID = '{$MBM_NO}' 
        WHERE QTN_NO = '{$QTN_NO}'
    ";   
    sql_query($sql2);

    alertMove('견적정보가 제출되었습니다.', RT_PATH.'/html/quotation/bid_info.html?NTC_CLS_CD=SPOT');
?>