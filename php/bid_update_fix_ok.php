<?php
    session_start();
    include_once ('../admin/lib/common.php');
    
    // print_r($_POST);exit;
    //***************step1******************//    
    $NTC_NO = addslashes($_POST['NTC_NO']);                 // 공고번호
    $CRG_TYP_CD = addslashes($_POST['CRG_TYP_CD']);         // 화물구분   SEA / AIR
    $NTC_NM = addslashes($_POST['NTC_NM']);                 // 공고명
    $NTC_PIC_NM = addslashes($_POST['NTC_PIC_NM']);         // 공고자명
    $NTC_CLOSE_YMD = addslashes($_POST['NTC_CLOSE_YMD']);   // 입찰마감일시
    $NTC_CLOSE_TM = addslashes($_POST['NTC_CLOSE_TM']);     // 입찰마감일시
    $CLOSE_CMPL_DT = $NTC_CLOSE_YMD." ".$NTC_CLOSE_TM;      // 입찰마감완료일시
    $CNTRCT_FR_YMD = addslashes($_POST['CNTRCT_FR_YMD']);   // 계약기간
    $CNTRCT_TO_YMD = addslashes($_POST['CNTRCT_TO_YMD']);   // 계약기간
    $CNTRCT_STND_CD = addslashes($_POST['CNTRCT_STND_CD']); // 계약기준일 (01)출항일 기준 / (02)CY 입고일 기준
    $NTC_IO_TYP_CD = addslashes($_POST['NTC_IO_TYP_CD']);   // 수출입구분  O / I / T / A
    $PAY_COND_CD = addslashes($_POST['PAY_COND_CD']);       // 운임지불조건 
    $SEA_RQST_YN = addslashes($_POST['SEA_RQST_YN']);       // 해상운송
    $AIR_RQST_YN = addslashes($_POST['AIR_RQST_YN']);       // 항공운송
    $DOM_RQST_YN = addslashes($_POST['DOM_RQST_YN']);       // 국내운송
    $CRG_RQST_YN = addslashes($_POST['CRG_RQST_YN']);       // 적하보험
    $CSTM_RQST_YN = addslashes($_POST['CSTM_RQST_YN']);     // 통관
    $REMARK = addslashes($_POST['REMARK']);                 // 기타
        
    $BID_CLS_CD = "RG";    
    $SA_CLS_CD = "SEA";    
    if($CRG_TYP_CD == "AIR")
        $SA_CLS_CD = "AIR"; 

    $NTC_CLOSE_YMD = str_replace("-", "", $NTC_CLOSE_YMD);    
    $NTC_CLOSE_TM = str_replace(":", "", $NTC_CLOSE_TM);    
    $CNTRCT_FR_YMD = str_replace("-", "", $CNTRCT_FR_YMD);    
    $CNTRCT_TO_YMD = str_replace("-", "", $CNTRCT_TO_YMD);    

    if($SEA_RQST_YN) {
        if($SEA_RQST_YN == "on") 
            $SEA_RQST_YN = "T"; 
        else
            $SEA_RQST_YN = "F";     
    }
    
    if($AIR_RQST_YN) {
        if($AIR_RQST_YN == "on") 
            $SEA_RQST_YN = "T"; 
        else
            $SEA_RQST_YN = "F"; 
    }

    if($DOM_RQST_YN == "on") 
        $DOM_RQST_YN = "T"; 
    else
        $DOM_RQST_YN = "F"; 

    if($CRG_RQST_YN == "on") 
        $CRG_RQST_YN = "T"; 
    else
        $CRG_RQST_YN = "F"; 

    if($CSTM_RQST_YN == "on") 
        $CSTM_RQST_YN = "T"; 
    else
        $CSTM_RQST_YN = "F"; 

    if($PACK_RQST_YN == "on") 
        $PACK_RQST_YN = "T"; 
    else
        $PACK_RQST_YN = "F";

    $MBM_NO = $_SESSION['MBM_NO'];

    $memInfo = "SELECT B.COMP_CD , B.COMP_NM FROM `tcmn_mbr_join` AS A LEFT JOIN tcmn_mbr_comp AS B ON A.REG_NO = B.REG_NO WHERE A.MBR_NO = '{$MBM_NO}'";
    $row = sql_fetch($memInfo);
    
    $COMP_CD = $row['COMP_CD'];
    $COMP_NM = $row['COMP_NM'];

    $sql1 ="UPDATE `tbid_ntc_mst` SET               
        COMP_CD = '{$COMP_CD}',         
        COMP_NM = '{$COMP_NM}',                                         
        NTC_NM = '{$NTC_NM}',       
        NTC_PIC_NO = '{$MBM_NO}',                                   
        NTC_PIC_NM = '{$NTC_PIC_NM}',
        NTC_CLOSE_YMD = '{$NTC_CLOSE_YMD}',     
        NTC_CLOSE_TM = '{$NTC_CLOSE_TM}', 
        IO_TYP_CD = '{$NTC_IO_TYP_CD}',
        SEA_RQST_YN = '{$SEA_RQST_YN}',     
        DOM_RQST_YN = '{$DOM_RQST_YN}',     
        CRG_RQST_YN = '{$CRG_RQST_YN}',     
        CSTM_RQST_YN = '{$CSTM_RQST_YN}',           
        PAY_COND_CD = '{$PAY_COND_CD}',        
        REMARK = '{$REMARK}', 
        SA_CLS_CD = '{$SA_CLS_CD}',
        CRG_TYP_CD = '{$CRG_TYP_CD}',                
        CNTRCT_FR_YMD = '{$CNTRCT_FR_YMD}',
        CNTRCT_TO_YMD = '{$CNTRCT_TO_YMD}',
        CNTRCT_STND_CD = '{$CNTRCT_STND_CD}',  
        CLOSE_CMPL_DT = '{$CLOSE_CMPL_DT}',      
        UPD_DT =  NOW(),
        UPD_ID = '{$MBM_NO}' 
        WHERE NTC_NO = '{$NTC_NO}'
    ";   
    sql_query($sql1);

    //***************step2******************//
    $ROUTE_LIST = explode("-", $_POST['ROUTE_LIST']); // ROUTE Index 배열
    $ROUTE_CNT = count($ROUTE_LIST);
    
    $POL_CD0 = addslashes($_POST['POL_CD'.$ROUTE_LIST[0]]);
    $POD_CD0 = addslashes($_POST['POD_CD'.$ROUTE_LIST[0]]);

    $POL_CD0 = sql_fetch("SELECT LOC_CD FROM `tcmn_unloc_code` WHERE LOC_NM = '{$POL_CD0}'");
    $POL_CD0 = $POL_CD0[LOC_CD];

    $POD_CD0 = sql_fetch("SELECT LOC_CD FROM `tcmn_unloc_code` WHERE LOC_NM = '{$POD_CD0}'");
    $POD_CD0 = $POD_CD0[LOC_CD];

    $sql2 = "UPDATE `tbid_ntc_crgo` SET         
        NTC_SEQ = '{$ROUTE_CNT}',
        POL_CD = '{$POL_CD0}',
        POD_CD = '{$POD_CD0}',
        UPD_DT = NOW(),
        UPD_ID = '{$MBM_NO}' 
        WHERE NTC_NO = '{$NTC_NO}'
    ";        
    sql_query($sql2);

    $sql3 = "DELETE FROM tbid_ntc_crgo_route WHERE NTC_NO = '{$NTC_NO}'";
    sql_query($sql3);

    for($i = 0; $i < $ROUTE_CNT; $i++)
    {
        $POL_CD = addslashes($_POST['POL_CD'.$ROUTE_LIST[$i]]);             // 선적항
        $POL_CD = sql_fetch("SELECT LOC_CD FROM `tcmn_unloc_code` WHERE LOC_NM = '{$POL_CD}'");
        $POL_CD = $POL_CD[LOC_CD];

        $DOOR_NM = addslashes($_POST['DOOR_NM'.$ROUTE_LIST[$i]]);           // PICK UP지

        $POD_CD = addslashes($_POST['POD_CD'.$ROUTE_LIST[$i]]);             // 양하항
        $POD_CD = sql_fetch("SELECT LOC_CD FROM `tcmn_unloc_code` WHERE LOC_NM = '{$POD_CD}'");
        $POD_CD = $POD_CD[LOC_CD];
        
        $FDS_NM = addslashes($_POST['FDS_NM'.$ROUTE_LIST[$i]]);             // DELIVERY 장소
        $INCTRMS_CD = addslashes($_POST['INCTRMS_CD'.$ROUTE_LIST[$i]]);     // 무역거래조건
        $CRG_NM = addslashes($_POST['CRG_NM'.$ROUTE_LIST[$i]]);             // 품목명
        $CNTR_DESC = addslashes($_POST['CNTR_DESC'.$ROUTE_LIST[$i]]);       // 물동량(FCL)
        $PKG_CD = addslashes($_POST['PKG_CD'.$ROUTE_LIST[$i]]);             // 포장형태
        $CRG_CNT = addslashes($_POST['CRG_CNT'.$ROUTE_LIST[$i]]);           // 수량
        $CRG_WGT = addslashes($_POST['CRG_WGT'.$ROUTE_LIST[$i]]);           // 중량
        $CRG_VOL = addslashes($_POST['CRG_VOL'.$ROUTE_LIST[$i]]);           // 용적
        $SHIP_CNT = addslashes($_POST['SHIP_CNT'.$ROUTE_LIST[$i]]);         // 선적건수
        $CRG_AMT = addslashes($_POST['CRG_AMT'.$ROUTE_LIST[$i]]);           // 물품가액(FOB)        
        $CRG_AMT = str_replace(',', '', $CRG_AMT);

        $CRG_CURR_CD = addslashes($_POST['CRG_CURR_CD'.$ROUTE_LIST[$i]]);   // 물품가액(FOB)
        $CRG_UNIT_NM = addslashes($_POST['CRG_UNIT_NM'.$ROUTE_LIST[$i]]);   // 물품가 기준
        $IMDG_CD = addslashes($_POST['IMDG_CD'.$ROUTE_LIST[$i]]);           // 위험물
        $EX_RATE = addslashes($_POST['EX_RATE'.$ROUTE_LIST[$i]]);           // 견적적용환율
        $EX_RATE = str_replace(',', '', $EX_RATE);
        
        $ETC_SVC_DESC = addslashes($_POST['ETC_SVC_DESC'.$ROUTE_LIST[$i]]); // 기타요청사항
        $WGT_SECT_CD = addslashes($_POST['WGT_SECT_CD'.$ROUTE_LIST[$i]]);   // 선호중량구간
        $TRS_ROUTE_CD  = addslashes($_POST['TRS_ROUTE_CD'.$ROUTE_LIST[$i]]);// 운송노선

        $sql4 = "INSERT INTO tbid_ntc_crgo_route SET 
            NTC_NO = '{$NTC_NO}',            
            POL_CD = '{$POL_CD}',       
            DOOR_NM = '{$DOOR_NM}',
            POD_CD = '{$POD_CD}',
            FDS_NM = '{$FDS_NM}',
            INCTRMS_CD = '{$INCTRMS_CD}',
            CRG_NM = '{$CRG_NM}',
            CNTR_DESC = '{$CNTR_DESC}',
            PKG_CD = '{$PKG_CD}',       
            CRG_CNT = '{$CRG_CNT}',
            CRG_WGT = '{$CRG_WGT}',
            CRG_VOL = '{$CRG_VOL}',
            SHIP_CNT = '{$SHIP_CNT}',       
            CRG_AMT = '{$CRG_AMT}',        
            CRG_CURR_CD = '{$CRG_CURR_CD}',
            CRG_UNIT_NM = '{$CRG_UNIT_NM}',
            IMDG_CD = '{$IMDG_CD}',
            EX_RATE = '{$EX_RATE}',
            ETC_SVC_DESC = '{$ETC_SVC_DESC}',
            WGT_SECT_CD = '{$WGT_SECT_CD}',
            TRS_ROUTE_CD = '{$TRS_ROUTE_CD}',
            ROUTE_NO = '{$ROUTE_LIST[$i]}'
        ";
        // echo $sql4."<br/>";
        sql_query($sql4);
    }

    alertMove('정기입찰 공고가 수정되었습니다.', RT_PATH.'/html/quotation/bid_info.html?NTC_CLS_CD=RGLR');
?>