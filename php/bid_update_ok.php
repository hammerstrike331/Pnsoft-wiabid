<?php
    session_start();
    include_once ('../admin/lib/common.php');
    
    // print_r($_POST);exit;
    //***************step1******************//    
    $NTC_NO = addslashes($_POST['NTC_NO']);                 // 공고번호    
    $CRG_TYP_CD = addslashes($_POST['CRG_TYP_CD']);         // 화물구분   FCL / LCL / BULK / AIR
    $NTC_NM = addslashes($_POST['NTC_NM']);                 // 공고명    
    $NTC_PIC_NM = addslashes($_POST['NTC_PIC_NM']);         // 공고자명
    $NTC_CLOSE_YMD = addslashes($_POST['NTC_CLOSE_YMD']);   // 입찰마감일시
    $NTC_CLOSE_TM = addslashes($_POST['NTC_CLOSE_TM']);     // 입찰마감일시
    $CLOSE_CMPL_DT = $NTC_CLOSE_YMD." ".$NTC_CLOSE_TM;      // 입찰마감완료일시
    $NTC_IO_TYP_CD = addslashes($_POST['NTC_IO_TYP_CD']);   // 수출입구분  O / I / A
    $PAY_COND_CD = addslashes($_POST['PAY_COND_CD']);       // 운임지불조건 
    $SEA_RQST_YN = addslashes($_POST['SEA_RQST_YN']);       // 해상운송
    $AIR_RQST_YN = addslashes($_POST['AIR_RQST_YN']);       // 항공운송
    $DOM_RQST_YN = addslashes($_POST['DOM_RQST_YN']);       // 국내운송
    $CRG_RQST_YN = addslashes($_POST['CRG_RQST_YN']);       // 적하보험
    $CSTM_RQST_YN = addslashes($_POST['CSTM_RQST_YN']);     // 통관
    $PACK_RQST_YN = addslashes($_POST['PACK_RQST_YN']);     // 포장
    
    $BID_CLS_CD = "SP";    
    $SA_CLS_CD = "SEA";    
    if($CRG_TYP_CD == "AIR")
        $SA_CLS_CD = "AIR"; 

    $NTC_CLOSE_YMD = str_replace("-", "", $NTC_CLOSE_YMD);    
    $NTC_CLOSE_TM = str_replace(":", "", $NTC_CLOSE_TM);    

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

    //***************step2******************//    
    $POL_CD = addslashes($_POST['POL_CD']);  // 선적항    
    $POL_CD = sql_fetch("SELECT LOC_CD FROM `tcmn_unloc_code` WHERE LOC_NM = '{$POL_CD}'");
    $POL_CD = $POL_CD[LOC_CD];

    $DOOR_NM = addslashes($_POST['DOOR_NM']);  // PICK UP지    
    $DOOR_YMD = addslashes($_POST['DOOR_YMD']); // PICK UP 일자
    $POD_CD = addslashes($_POST['POD_CD']);  // 양하항    
    $POD_CD = sql_fetch("SELECT LOC_CD FROM `tcmn_unloc_code` WHERE LOC_NM = '{$POD_CD}'");
    $POD_CD = $POD_CD[LOC_CD];

    $FDS_NM = addslashes($_POST['FDS_NM']);  // 선적항
    $FDS_YMD = addslashes($_POST['FDS_YMD']); // 도착요구 일자
    $INCTRMS_CD = addslashes($_POST['INCTRMS_CD']); // 무역거래조건
    $TRS_ROUTE_CD = addslashes($_POST['TRS_ROUTE_CD']); // 운송노선
    $TRS_COND_CD = addslashes($_POST['TRS_COND_CD']); // 운송조건    
    $LOAD_TYP_CD = addslashes($_POST['LOAD_TYP_CD']); // 적재형태
    $DECK_TYP_CD = addslashes($_POST['DECK_TYP_CD']); // 적재형태
    $PORTABLE_YN = addslashes($_POST['PORTABLE_YN']); // 자가구동 화물
     
    $DOOR_YMD = str_replace("-", "", $DOOR_YMD);
    $FDS_YMD = str_replace("-", "", $FDS_YMD);    

    if($PORTABLE_YN == "on") 
        $PORTABLE_YN = "T"; 
    else 
        $PORTABLE_YN = "F";

    //***************step3******************//
    $CRG_NM = addslashes($_POST['CRG_NM']); // 품목명
    $CNTR1_SZTP = addslashes($_POST['CNTR1_SZTP']); // 물동량
    $CNTR1_CNT = addslashes($_POST['CNTR1_CNT']); // 물동량
    $CNTR1_WGT = addslashes($_POST['CNTR1_WGT']); // 물동량
    $CNTR2_SZTP = addslashes($_POST['CNTR2_SZTP']); // 물동량
    $CNTR2_CNT = addslashes($_POST['CNTR2_CNT']); // 물동량
    $CNTR2_WGT = addslashes($_POST['CNTR2_WGT']); // 물동량
    $CNTR3_SZTP = addslashes($_POST['CNTR3_SZTP']); // 물동량
    $CNTR3_CNT = addslashes($_POST['CNTR3_CNT']); // 물동량
    $CNTR3_WGT = addslashes($_POST['CNTR3_WGT']); // 물동량    
    $CRG_AMT = addslashes($_POST['CRG_AMT']); // 물품가액(FOB)
    $CRG_AMT = str_replace(',', '', $CRG_AMT);

    $CRG_CURR_CD = addslashes($_POST['CRG_CURR_CD']); // 물품가액(FOB)
    $CRG_UNIT_NM = addslashes($_POST['CRG_UNIT_NM']); // 물품가 기준
    $IMDG_CD = addslashes($_POST['IMDG_CD']); // 위험물
    
    $EX_RATE = addslashes($_POST['EX_RATE']); // 견적적용환율
    $EX_RATE = str_replace(',', '', $EX_RATE);

    $REMARK = addslashes($_POST['REMARK']); // 기타요청사항
    $PKG_CD = addslashes($_POST['PKG_CD']); // 포장형태
    $CRG_CNT = addslashes($_POST['CRG_CNT']); // 수량
    $CRG_WGT = addslashes($_POST['CRG_WGT']); // 중량
    $CRG_WGT = str_replace(',', '', $CRG_WGT);

    $CRG_VOL = addslashes($_POST['CRG_VOL']); // 용적
    $CRG_VOL = str_replace(',', '', $CRG_VOL);

    $DIM_LEN = addslashes($_POST['DIM_LEN']); // Dimension
    $DIM_WID = addslashes($_POST['DIM_WID']); // Dimension
    $DIM_HGT = addslashes($_POST['DIM_HGT']); // Dimension
    
    $CRG_UNT_WGT = addslashes($_POST['CRG_UNT_WGT']); // 최대중량  
    $CRG_UNT_WGT = str_replace(',', '', $CRG_UNT_WGT);

    $PKG_GRP_CD = addslashes($_POST['PKG_GRP_CD']); // Packing Group
    
    if($CRG_TYP_CD == "BLK") {
        $PACK_ORG_FILE_NM = NULL;
        $PACK_PATH_NM = NULL;
        $PACK_FILE_NM = NULL;

        if (isset($_FILES['PACK_FILE']['name'])) {
            $target_path = "../uploads/";

            $PACK_ORG_FILE_NM = basename($_FILES['PACK_FILE']['name']);
            $PACK_PATH_NM = "uploads/";
            $target_file = $target_path.$PACK_ORG_FILE_NM;
            $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $PACK_FILE_NM = time().".".$fileType;
            $target_path .= $PACK_FILE_NM;            
            move_uploaded_file($_FILES['PACK_FILE']['tmp_name'], $target_path);
        }
        
        if($PACK_ORG_FILE_NM) {
            $sql1 = "UPDATE `tbid_ntc_mst` SET 
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
                PACK_RQST_YN = '{$PACK_RQST_YN}',
                PAY_COND_CD = '{$PAY_COND_CD}',
                REMARK = '{$REMARK}',
                EX_RATE = '{$EX_RATE}',
                PACK_ORG_FILE_NM = '{$PACK_ORG_FILE_NM}',
                PACK_PATH_NM = '{$PACK_PATH_NM}',
                PACK_FILE_NM = '{$PACK_FILE_NM}',
                SA_CLS_CD = '{$SA_CLS_CD}',
                CRG_TYP_CD = '{$CRG_TYP_CD}',
                BID_CLS_CD = '{$BID_CLS_CD}', 
                CLOSE_CMPL_DT = '{$CLOSE_CMPL_DT}',       
                UPD_DT =  NOW(),
                UPD_ID = '{$MBM_NO}' 
                WHERE NTC_NO = '{$NTC_NO}'
            ";    
            sql_query($sql1); 
        }
        else {
            $sql1 = "UPDATE `tbid_ntc_mst` SET 
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
                PACK_RQST_YN = '{$PACK_RQST_YN}',
                PAY_COND_CD = '{$PAY_COND_CD}',
                REMARK = '{$REMARK}',
                EX_RATE = '{$EX_RATE}',            
                SA_CLS_CD = '{$SA_CLS_CD}',
                CRG_TYP_CD = '{$CRG_TYP_CD}',
                BID_CLS_CD = '{$BID_CLS_CD}',        
                UPD_DT =  NOW(),
                UPD_ID = '{$MBM_NO}' 
                WHERE NTC_NO = '{$NTC_NO}'
            ";    
            sql_query($sql1); 
        }
    }
    else {
        $sql1 = "UPDATE `tbid_ntc_mst` SET 
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
            PACK_RQST_YN = '{$PACK_RQST_YN}',
            PAY_COND_CD = '{$PAY_COND_CD}',
            REMARK = '{$REMARK}',
            EX_RATE = '{$EX_RATE}',            
            SA_CLS_CD = '{$SA_CLS_CD}',
            CRG_TYP_CD = '{$CRG_TYP_CD}',
            BID_CLS_CD = '{$BID_CLS_CD}',        
            UPD_DT =  NOW(),
            UPD_ID = '{$MBM_NO}' 
            WHERE NTC_NO = '{$NTC_NO}'
        ";    
        sql_query($sql1); 
    }    
    // echo $sql1."<br/>";

    $sql2 = "UPDATE tbid_ntc_crgo SET 
        NTC_SEQ = '1',
        POL_CD = '{$POL_CD}',
        POD_CD = '{$POD_CD}',
        DOOR_NM = '{$DOOR_NM}',
        FDS_NM = '{$FDS_NM}',
        DOOR_YMD = '{$DOOR_YMD}',
        FDS_YMD = '{$FDS_YMD}',
        INCTRMS_CD = '{$INCTRMS_CD}',
        TRS_ROUTE_CD = '{$TRS_ROUTE_CD}',
        TRS_COND_CD = '{$TRS_COND_CD}',
        LOAD_TYP_CD = '{$LOAD_TYP_CD}',
        DECK_TYP_CD = '{$DECK_TYP_CD}',
        PORTABLE_YN = '{$PORTABLE_YN}',
        CRG_NM = '{$CRG_NM}',
        CRG_CNT = '{$CRG_CNT}',
        PKG_CD = '{$PKG_CD}',
        CRG_WGT = '{$CRG_WGT}',
        CRG_VOL = '{$CRG_VOL}',
        CRG_UNT_WGT = '{$CRG_UNT_WGT}',
        CNTR1_SZTP = '{$CNTR1_SZTP}',
        CNTR1_CNT = '{$CNTR1_CNT}',
        CNTR1_WGT = '{$CNTR1_WGT}',
        CNTR2_SZTP = '{$CNTR2_SZTP}',
        CNTR2_CNT = '{$CNTR2_CNT}',
        CNTR2_WGT = '{$CNTR2_WGT}',
        CNTR3_SZTP = '{$CNTR3_SZTP}',
        CNTR3_CNT = '{$CNTR3_CNT}',
        CNTR3_WGT = '{$CNTR3_WGT}',
        DIM_WID = '{$DIM_WID}',
        DIM_LEN = '{$DIM_LEN}',
        DIM_HGT = '{$DIM_HGT}',
        IMDG_CD = '{$IMDG_CD}',
        PKG_GRP_CD = '{$PKG_GRP_CD}',
        CRG_AMT = '{$CRG_AMT}',
        CRG_CURR_CD = '{$CRG_CURR_CD}',
        CRG_UNIT_NM = '{$CRG_UNIT_NM}',
        EX_RATE = '{$EX_RATE}',
        UPD_DT = NOW(),
        UPD_ID = '{$MBM_NO}' 
        WHERE NTC_NO = '{$NTC_NO}'
    ";
    // echo $sql2; exit;
    sql_query($sql2);

    alertMove('일반입찰 공고가 수정되었습니다.', RT_PATH.'/html/quotation/bid_info.html?NTC_CLS_CD=SPOT');
?>