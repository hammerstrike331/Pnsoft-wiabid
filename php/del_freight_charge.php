<?php 
	session_start();
	include_once ('../admin/lib/common.php');

	$QTN_ID = $_POST['QTN_ID'];
	
    $sql1 = "SELECT * FROM tbid_qtn_frt WHERE ID = '{$QTN_ID}'";
    $qtn_frt = sql_fetch($sql1);
	
    $QTN_NO = $qtn_frt['QTN_NO'];
    $QTN_SEQ = $qtn_frt['QTN_SEQ'];    
    $FRT_AMT = $qtn_frt['FRT_AMT'];
    $FRT_KOR_AMT = $qtn_frt['FRT_KOR_AMT'];
    $FRT_TAX_AMT = $qtn_frt['FRT_TAX_AMT'];
    $FRT_TOT_AMT = $qtn_frt['FRT_TOT_AMT'];

    $sql2 = "SELECT * FROM tbid_qtn_mst WHERE QTN_NO = '{$QTN_NO}'";
    $qtn_mst = sql_fetch($sql2);

    $sql3 = "";
    if($QTN_SEQ == 1) {
    	if(!$qtn_mst['DOM_FRG_AMT'])
    		$qtn_mst['DOM_FRG_AMT'] = 0;
    	$DOM_FRG_AMT = $qtn_mst['DOM_FRG_AMT']-$FRT_AMT;

    	if(!$qtn_mst['DOM_KOR_AMT'])
    		$qtn_mst['DOM_KOR_AMT'] = 0;
    	$DOM_KOR_AMT = $qtn_mst['DOM_KOR_AMT']-$FRT_KOR_AMT;

    	if(!$qtn_mst['DOM_KOR_TOT_AMT'])
    		$qtn_mst['DOM_KOR_TOT_AMT'] = 0;
    	$DOM_KOR_TOT_AMT = $qtn_mst['DOM_KOR_TOT_AMT']-$FRT_TOT_AMT;

    	if(!$qtn_mst['DOM_TAX_TOT_AMT'])
    		$qtn_mst['DOM_TAX_TOT_AMT'] = 0;
    	$DOM_TAX_TOT_AMT = $qtn_mst['DOM_TAX_TOT_AMT']-$FRT_TAX_AMT;

    	if(!$qtn_mst['TAX_AMT'])
    		$qtn_mst['TAX_AMT'] = 0;
    	$TAX_AMT = $qtn_mst['TAX_AMT']-$FRT_TAX_AMT;
    	
    	if(!$qtn_mst['TOT_AMT'])
    		$qtn_mst['TOT_AMT'] = 0;
    	$TOT_AMT = $qtn_mst['TOT_AMT']-$FRT_TOT_AMT;

    	$SPLY_AMT = $TOT_AMT - $TAX_AMT;

    	$sql3 = "UPDATE tbid_qtn_mst SET 
	        DOM_FRG_AMT = '{$DOM_FRG_AMT}',	        
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
    	$SA_FRG_AMT = $qtn_mst['SA_FRG_AMT']-$FRT_AMT;

    	if(!$qtn_mst['SA_KOR_AMT'])
    		$qtn_mst['SA_KOR_AMT'] = 0;
    	$SA_KOR_AMT = $qtn_mst['SA_KOR_AMT']-$FRT_KOR_AMT;

    	if(!$qtn_mst['SA_KOR_TOT_AMT'])
    		$qtn_mst['SA_KOR_TOT_AMT'] = 0;
    	$SA_KOR_TOT_AMT = $qtn_mst['SA_KOR_TOT_AMT']-$FRT_TOT_AMT;

    	if(!$qtn_mst['SA_TAX_TOT_AMT'])
    		$qtn_mst['SA_TAX_TOT_AMT'] = 0;
    	$SA_TAX_TOT_AMT = $qtn_mst['SA_TAX_TOT_AMT']-$FRT_TAX_AMT;

    	if(!$qtn_mst['TAX_AMT'])
    		$qtn_mst['TAX_AMT'] = 0;
    	$TAX_AMT = $qtn_mst['TAX_AMT']-$FRT_TAX_AMT;
    	
    	if(!$qtn_mst['TOT_AMT'])
    		$qtn_mst['TOT_AMT'] = 0;
    	$TOT_AMT = $qtn_mst['TOT_AMT']-$FRT_TOT_AMT;

    	$SPLY_AMT = $TOT_AMT - $TAX_AMT;

    	$sql3 = "UPDATE tbid_qtn_mst SET 
	        SA_FRG_AMT = '{$SA_FRG_AMT}',	        
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
    	$ARV_FRG_AMT = $qtn_mst['ARV_FRG_AMT']-$FRT_AMT;

    	if(!$qtn_mst['ARV_KOR_AMT'])
    		$qtn_mst['ARV_KOR_AMT'] = 0;
    	$ARV_KOR_AMT = $qtn_mst['ARV_KOR_AMT']-$FRT_KOR_AMT;

    	if(!$qtn_mst['ARV_KOR_TOT_AMT'])
    		$qtn_mst['ARV_KOR_TOT_AMT'] = 0;
    	$ARV_KOR_TOT_AMT = $qtn_mst['ARV_KOR_TOT_AMT']-$FRT_TOT_AMT;

    	if(!$qtn_mst['ARV_TAX_TOT_AMT'])
    		$qtn_mst['ARV_TAX_TOT_AMT'] = 0;
    	$ARV_TAX_TOT_AMT = $qtn_mst['ARV_TAX_TOT_AMT']-$FRT_TAX_AMT;

    	if(!$qtn_mst['TAX_AMT'])
    		$qtn_mst['TAX_AMT'] = 0;
    	$TAX_AMT = $qtn_mst['TAX_AMT']-$FRT_TAX_AMT;

    	if(!$qtn_mst['TOT_AMT'])
    		$qtn_mst['TOT_AMT'] = 0;
    	$TOT_AMT = $qtn_mst['TOT_AMT']-$FRT_TOT_AMT;

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

    $sql4 = "DELETE FROM tbid_qtn_frt WHERE ID = '{$QTN_ID}'";
    $result = sql_query($sql4);
    
	echo json_encode($result);
?>