<?php 
	session_start();
	include_once ('../admin/lib/common.php');

	$QTN_NO = $_POST['QTN_NO'];
	$QTN_SEQ = $_POST['QTN_SEQ'];
	$FRT_GRP_CD = $_POST['FRT_GRP_CD'];
	$TRF_TYP_CD = $_POST['TRF_TYP_CD'];
	$TRF_QTY = $_POST['TRF_QTY'];
	$TRF_PRC = $_POST['TRF_PRC'];
    $TRF_PRC = str_replace(',', '', $TRF_PRC);

	$TRF_CURR_CD = $_POST['TRF_CURR_CD'];
	$FRT_AMT = $_POST['FRT_AMT'];
    $FRT_AMT = str_replace(',', '', $FRT_AMT);

	$FRT_KOR_AMT = $_POST['FRT_KOR_AMT'];
    $FRT_KOR_AMT = str_replace(',', '', $FRT_KOR_AMT);

	$FRT_TAX_AMT = $_POST['FRT_TAX_AMT'];
    $FRT_TAX_AMT = str_replace(',', '', $FRT_TAX_AMT);

	$FRT_TOT_AMT = $_POST['FRT_TOT_AMT'];
    $FRT_TOT_AMT = str_replace(',', '', $FRT_TOT_AMT);
    
	$INS_ID = $_POST['INS_ID'];

	$sql1 = "INSERT INTO tbid_qtn_frt SET
		QTN_NO = '{$QTN_NO}',
        QTN_SEQ = '{$QTN_SEQ}',
        FRT_GRP_CD = '{$FRT_GRP_CD}',
        TRF_TYP_CD = '{$TRF_TYP_CD}',
        TRF_QTY = '{$TRF_QTY}',
        TRF_PRC = '{$TRF_PRC}',
        TRF_CURR_CD = '{$TRF_CURR_CD}',
        FRT_AMT = '{$FRT_AMT}',
        FRT_KOR_AMT = '{$FRT_KOR_AMT}',
        FRT_TAX_AMT = '{$FRT_TAX_AMT}',
        FRT_TOT_AMT = '{$FRT_TOT_AMT}',
        INS_DT = NOW(),
        INS_ID = '{$INS_ID}'
    ";   
    
    sql_query($sql1);

    $sql2 = "SELECT * FROM tbid_qtn_mst WHERE QTN_NO = '{$QTN_NO}'";
    $qtn_mst = sql_fetch($sql2);

    $sql3 = "";
    if($QTN_SEQ == 1) {
    	if(!$qtn_mst['DOM_FRG_AMT'])
    		$qtn_mst['DOM_FRG_AMT'] = 0;
    	$DOM_FRG_AMT = $qtn_mst['DOM_FRG_AMT']+$FRT_AMT;

    	$DOM_CURR_CD = $TRF_CURR_CD;

    	if(!$qtn_mst['DOM_KOR_AMT'])
    		$qtn_mst['DOM_KOR_AMT'] = 0;
    	$DOM_KOR_AMT = $qtn_mst['DOM_KOR_AMT']+$FRT_KOR_AMT;

    	if(!$qtn_mst['DOM_KOR_TOT_AMT'])
    		$qtn_mst['DOM_KOR_TOT_AMT'] = 0;
    	$DOM_KOR_TOT_AMT = $qtn_mst['DOM_KOR_TOT_AMT']+$FRT_TOT_AMT;

    	if(!$qtn_mst['DOM_TAX_TOT_AMT'])
    		$qtn_mst['DOM_TAX_TOT_AMT'] = 0;
    	$DOM_TAX_TOT_AMT = $qtn_mst['DOM_TAX_TOT_AMT']+$FRT_TAX_AMT;

    	if(!$qtn_mst['TAX_AMT'])
    		$qtn_mst['TAX_AMT'] = 0;
    	$TAX_AMT = $qtn_mst['TAX_AMT']+$FRT_TAX_AMT;
    	
    	if(!$qtn_mst['TOT_AMT'])
    		$qtn_mst['TOT_AMT'] = 0;
    	$TOT_AMT = $qtn_mst['TOT_AMT']+$FRT_TOT_AMT;

    	$SPLY_AMT = $TOT_AMT - $TAX_AMT;

    	$sql3 = "UPDATE tbid_qtn_mst SET 
	        DOM_FRG_AMT = '{$DOM_FRG_AMT}',
	        DOM_CURR_CD = '{$DOM_CURR_CD}',
	        DOM_KOR_AMT = '{$DOM_KOR_AMT}',
	        DOM_KOR_TOT_AMT = '{$DOM_KOR_TOT_AMT}',
	        DOM_TAX_TOT_AMT = '{$DOM_TAX_TOT_AMT}',
	        SPLY_AMT = '{$SPLY_AMT}',
	        TAX_AMT = '{$TAX_AMT}',
	        TOT_AMT = '{$TOT_AMT}'
	        WHERE QTN_NO = '{$QTN_NO}'
	    ";
    } else if($QTN_SEQ == 2) {
    	if(!$qtn_mst['SA_FRG_AMT'])
    		$qtn_mst['SA_FRG_AMT'] = 0;
    	$SA_FRG_AMT = $qtn_mst['SA_FRG_AMT']+$FRT_AMT;

    	$SA_CURR_CD = $TRF_CURR_CD;

    	if(!$qtn_mst['SA_KOR_AMT'])
    		$qtn_mst['SA_KOR_AMT'] = 0;
    	$SA_KOR_AMT = $qtn_mst['SA_KOR_AMT']+$FRT_KOR_AMT;

    	if(!$qtn_mst['SA_KOR_TOT_AMT'])
    		$qtn_mst['SA_KOR_TOT_AMT'] = 0;
    	$SA_KOR_TOT_AMT = $qtn_mst['SA_KOR_TOT_AMT']+$FRT_TOT_AMT;

    	if(!$qtn_mst['SA_TAX_TOT_AMT'])
    		$qtn_mst['SA_TAX_TOT_AMT'] = 0;
    	$SA_TAX_TOT_AMT = $qtn_mst['SA_TAX_TOT_AMT']+$FRT_TAX_AMT;

    	if(!$qtn_mst['TAX_AMT'])
    		$qtn_mst['TAX_AMT'] = 0;
    	$TAX_AMT = $qtn_mst['TAX_AMT']+$FRT_TAX_AMT;
    	
    	if(!$qtn_mst['TOT_AMT'])
    		$qtn_mst['TOT_AMT'] = 0;
    	$TOT_AMT = $qtn_mst['TOT_AMT']+$FRT_TOT_AMT;

    	$SPLY_AMT = $TOT_AMT - $TAX_AMT;

    	$sql3 = "UPDATE tbid_qtn_mst SET 
	        SA_FRG_AMT = '{$SA_FRG_AMT}',
	        SA_CURR_CD = '{$SA_CURR_CD}',
	        SA_KOR_AMT = '{$SA_KOR_AMT}',
	        SA_KOR_TOT_AMT = '{$SA_KOR_TOT_AMT}',
	        SA_TAX_TOT_AMT = '{$SA_TAX_TOT_AMT}',
	        SPLY_AMT = '{$SPLY_AMT}',
	        TAX_AMT = '{$TAX_AMT}',
	        TOT_AMT = '{$TOT_AMT}'
	        WHERE QTN_NO = '{$QTN_NO}'
	    ";
    } else if($QTN_SEQ == 3) {
    	if(!$qtn_mst['ARV_FRG_AMT'])
    		$qtn_mst['ARV_FRG_AMT'] = 0;
    	$ARV_FRG_AMT = $qtn_mst['ARV_FRG_AMT']+$FRT_AMT;

    	$ARV_CURR_CD = $TRF_CURR_CD;

    	if(!$qtn_mst['ARV_KOR_AMT'])
    		$qtn_mst['ARV_KOR_AMT'] = 0;
    	$ARV_KOR_AMT = $qtn_mst['ARV_KOR_AMT']+$FRT_KOR_AMT;

    	if(!$qtn_mst['ARV_KOR_TOT_AMT'])
    		$qtn_mst['ARV_KOR_TOT_AMT'] = 0;
    	$ARV_KOR_TOT_AMT = $qtn_mst['ARV_KOR_TOT_AMT']+$FRT_TOT_AMT;

    	if(!$qtn_mst['ARV_TAX_TOT_AMT'])
    		$qtn_mst['ARV_TAX_TOT_AMT'] = 0;
    	$ARV_TAX_TOT_AMT = $qtn_mst['ARV_TAX_TOT_AMT']+$FRT_TAX_AMT;

    	if(!$qtn_mst['TAX_AMT'])
    		$qtn_mst['TAX_AMT'] = 0;
    	$TAX_AMT = $qtn_mst['TAX_AMT']+$FRT_TAX_AMT;

    	if(!$qtn_mst['TOT_AMT'])
    		$qtn_mst['TOT_AMT'] = 0;
    	$TOT_AMT = $qtn_mst['TOT_AMT']+$FRT_TOT_AMT;

    	$SPLY_AMT = $TOT_AMT - $TAX_AMT;

    	$sql3 = "UPDATE tbid_qtn_mst SET 
	        ARV_FRG_AMT = '{$ARV_FRG_AMT}',
	        ARV_CURR_CD = '{$ARV_CURR_CD}',
	        ARV_KOR_AMT = '{$ARV_KOR_AMT}',
	        ARV_KOR_TOT_AMT = '{$ARV_KOR_TOT_AMT}',
	        ARV_TAX_TOT_AMT = '{$ARV_TAX_TOT_AMT}',
	        SPLY_AMT = '{$SPLY_AMT}',
	        TAX_AMT = '{$TAX_AMT}',
	        TOT_AMT = '{$TOT_AMT}'
	        WHERE QTN_NO = '{$QTN_NO}'
	    ";
    }

    if($sql3 != "") {
    	sql_fetch($sql3);
    }    

    $sql4 = "SELECT COUNT(*) as cnt FROM tbid_qtn_frt WHERE QTN_NO = '{$QTN_NO}' AND QTN_SEQ = '{$QTN_SEQ}'";
    $row = sql_fetch($sql4);
    $qtnCnt = $row['cnt'];

    $sql5 = "SELECT ID FROM tbid_qtn_frt ORDER BY ID DESC LIMIT 1";
    $lastId = sql_fetch($sql5);

    $result = $lastId['ID']."-".$qtnCnt;

	echo json_encode($result);
?>