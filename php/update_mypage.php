<?php
session_start();
include_once ('../admin/lib/common.php');

// print_r($_POST);exit;
if( $_POST['headUpload'] == "headUpload") 
{
    $PACK_ORG_FILE_NM = NULL;
    $PACK_PATH_NM = NULL;
    $PACK_FILE_NM = NULL;
    $target_path = "../uploads/";

    $mem_no = $_SESSION['MBM_NO'];

    if (!$_FILES['PACK_FILE']['error'])
    {
        $PACK_ORG_FILE_NM = basename($_FILES['PACK_FILE']['name']);
        $PACK_PATH_NM = RT_PATH."uploads/";
        $target_file = $target_path.$PACK_ORG_FILE_NM;
        $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $PACK_FILE_NM = time().".".$fileType;
        $target_path .= $PACK_FILE_NM;            
        move_uploaded_file($_FILES['PACK_FILE']['tmp_name'], $target_path);
        $fullPath = RT_PATH."/uploads/".$PACK_FILE_NM;
    
	    $sql = "SELECT IDX FROM `tbid_spc_fdr` WHERE FDR_NO = '{$mem_no}'";
	    $row = sql_fetch($sql);
	    $idx = $row['IDX'];

	    if(!$row) {	// have no
	    	$sql = "INSERT INTO `tbid_spc_fdr`
	                SET IMG_FILE_NM = '{$fullPath}',
	                    FDR_NO = '{$mem_no}',
	                    INS_ID = '{$mem_no}',
	                    INS_DT = NOW() ";
	                
	        sql_query($sql);
	    }
	    else 
	    {
	        $sql = "UPDATE `tbid_spc_fdr`
		            SET IMG_FILE_NM = '{$fullPath}',
		                UPD_ID = '{$mem_no}',
		                UPD_DT = NOW() 
		            WHERE IDX='{$idx}'";

	        sql_query($sql);
	    }

	}else {
		alertMove('실패하였습니다. 다시 시도해 주세요.', '../html/my/my_info.html?tab=1&mb_id='.$mem_no);
	}
	alertMove('수정되었습니다.', '../html/my/my_info.html?tab=1&mb_id='.$mem_no);
	return;
}
else if( $_POST['myHistory'] == "myHistory") 
{

    $MBM_NO = $_SESSION['MBM_NO'];
    $MBM_NM = $_SESSION['MBM_NM'];
	$TEL_NO = $_POST['TEL_NO'];
	$HP_NO = $_POST['HP_NO'];
	$FAX_NO = $_POST['FAX_NO'];
	$EMAIL_ID = $_POST['MBM_EMAIL_ID'];
	$INTRDC_DESC = addslashes($_POST['INTRDC_DESC']);
	$CAREER_YY_CNT = addslashes($_POST['CAREER_YY_CNT']);
	$CAREER_MM_CNT = addslashes($_POST['CAREER_MM_CNT']);
	
	// 서비스
		$SEA = $_POST['SEA'] == "on" ? "해상, ": "";
		$AIR = $_POST['AIR'] == "on" ? "항공, ": "";
		$BULK = $_POST['BULK'] == "on" ? "벌크, ": "";
		$PRO = $_POST['PRO'] == "on" ? "프로젝트, ": "";
		$LCL = $_POST['LCL'] == "on" ? "LCL콘솔, ": "";
		$SEAIR = $_POST['SEAIR'] == "on" ? "Sea & Air, ": "";
		$DAN = $_POST['DAN'] == "on" ? "위험물, ": "";
		$ICE = $_POST['ICE'] == "on" ? "냉동·냉장, ": "";
		$PER = $_POST['PER'] == "on" ? "Perishable, ": "";
		$KAR = $_POST['KAR'] == "on" ? "까르네(Carnet), ": "";
		$JON = $_POST['JON'] == "on" ? "전시화물, ": "";
		$HAND = $_POST['HAND'] == "on" ? "핸드캐리, ": "";
		$BRO = $_POST['BRO'] == "on" ? "해외이주화물, ": "";
		$COU = $_POST['COU'] == "on" ? "쿠리어(Courrier), ": "";
		$DAI = $_POST['DAI'] == "on" ? "따이공, ": "";
		$AETC = $_POST['AETC'] == "on" ? "기타, ": "";

		$SERVICE = $SEA.$AIR.$BULK.$PRO.$LCL.$SEAIR.$DAN.$ICE.$PER.$KAR.$JON.$HAND.$BRO.$COU.$DAI.$AETC;
	// 관심지역
		$JAP = $_POST['JAP'] == "on" ? "일본·동아시아, ": "";
		$CHI = $_POST['CHI'] == "on" ? "중국·홍콩, ": "";
		$ESA = $_POST['ESA'] == "on" ? "동남아시아, ": "";
		$WAS = $_POST['WAS'] == "on" ? "서남아시아, ": "";
		$CAS = $_POST['CAS'] == "on" ? "중앙아시아, ": "";
		$CEA = $_POST['CEA'] == "on" ? "중동, ": "";
		$OCE = $_POST['OCE'] == "on" ? "오세아니아, ": "";
		$NAF = $_POST['NAF'] == "on" ? "북아프리카, ": "";
		$MEDS = $_POST['MEDS'] == "on" ? "지중해연안, ": "";
		$NEU = $_POST['NEU'] == "on" ? "북유럽, ": "";
		$WEU = $_POST['WEU'] == "on" ? "서유럽, ": "";
		$EEU = $_POST['EEU'] == "on" ? "동유럽, ": "";
		$AFR = $_POST['AFR'] == "on" ? "아프리카, ": "";
		$NAM = $_POST['NAM'] == "on" ? "북미, ": "";
		$SAM = $_POST['SAM'] == "on" ? "남미, ": "";
		$RUS = $_POST['RUS'] == "on" ? "러시아, ": "";

		$AREA = $JAP.$CHI.$ESA.$WAS.$CAS.$CEA.$OCE.$NAF.$MEDS.$NEU.$WEU.$EEU.$AFR.$NAM.$SAM.$RUS;
	// ITEM
		$CAR = $_POST['CAR'] == "on" ? "자동차부품, ": "";
		$TIR = $_POST['TIR'] == "on" ? "타이어, ": "";
		$ELC = $_POST['ELC'] == "on" ? "전자·전기제품/부품, ": "";
		$RES = $_POST['RES'] == "on" ? "레진(Resin), ": "";
		$PRI = $_POST['PRI'] == "on" ? "제지·인쇄물, ": "";
		$MEC = $_POST['MEC'] == "on" ? "기계류, ": "";
		$CHE = $_POST['CHE'] == "on" ? "케미칼(Chemical), ": "";
		$FOO = $_POST['FOO'] == "on" ? "식품·음료(Food Stuff), ": "";
		$FAR = $_POST['FAR'] == "on" ? "농수산물, ": "";
		$WEA = $_POST['WEA'] == "on" ? "의류, ": "";
		$SHO = $_POST['SHO'] == "on" ? "신발·안경·모자, ": "";
		$FIB = $_POST['FIB'] == "on" ? "섬유·직물, ": "";
		$IRO = $_POST['IRO'] == "on" ? "철강·코일·파이프, ": "";
		$COS = $_POST['COS'] == "on" ? "화장품·향수, ": "";
		$HOU = $_POST['HOU'] == "on" ? "가재도구(Household), ": "";
		$INS = $_POST['INS'] == "on" ? "악기, ": "";
		$SKI = $_POST['SKI'] == "on" ? "가죽·털, ": "";
		$MED = $_POST['MED'] == "on" ? "의료기기, ": "";
		$BIC = $_POST['BIC'] == "on" ? "자전거·오토바이, ": "";
		$PLA = $_POST['PLA'] == "on" ? "플라스틱, ": "";
		$PAC = $_POST['PAC'] == "on" ? "포장재, ": "";
		$SPO = $_POST['SPO'] == "on" ? "스포츠용품, ": "";
		$STA = $_POST['STA'] == "on" ? "문구류, ": "";
		$TOB = $_POST['TOB'] == "on" ? "담배·술, ": "";
		$TOY = $_POST['TOY'] == "on" ? "장난감, ": "";
		$GUN = $_POST['GUN'] == "on" ? "무기류, ": "";
		$IETC = $_POST['IETC'] == "on" ? "기타, ": "";

		$ITEM_CD = $CAR.$TIR.$ELC.$RES.$PRI.$MEC.$CHE.$FOO.$FAR.$WEA.$SHO.$FIB.$IRO.$COS.$HOU.$INS.$SKI.$MED.$BIC.$PLA.$PAC.$SPO.$STA.$TOB.$TOY.$GUN.$IETC;

    $sql = "SELECT IDX FROM `tbid_spc_fdr` WHERE FDR_NO = '{$MBM_NO}'";
    $row = sql_fetch($sql);
    $idx = $row['IDX'];

    if(!$row) {	// have no
    	$insert_sql = "INSERT INTO `tbid_spc_fdr`
                SET FDR_NO = '{$MBM_NO}',
                    FDR_NM = '{$MBM_NM}',
                    CAREER_YY_CNT = '{$CAREER_YY_CNT}',
                    CAREER_MM_CNT = '{$CAREER_MM_CNT}',
                    INTRDC_DESC = '{$INTRDC_DESC}',

                    SERVICE = '{$SERVICE}',
                    ITEM_CD = '{$ITEM_CD}',
                    AREA_DTL_NM = '{$AREA}',

                    TEL_NO = '{$TEL_NO}',
                    HP_NO = '{$HP_NO}',
                    FAX_NO = '{$FAX_NO}',
                    EMAIL_ID = '{$EMAIL_ID}',
                    INS_ID = '{$MBM_NO}',
                    INS_DT = NOW() ";
                // echo $insert_sql;exit;
        sql_query($insert_sql);
    }
    else 
    {
        $update_sql = "UPDATE `tbid_spc_fdr`
	            SET FDR_NO = '{$MBM_NO}',
                    FDR_NM = '{$MBM_NM}',
                    CAREER_YY_CNT = '{$CAREER_YY_CNT}',
                    CAREER_MM_CNT = '{$CAREER_MM_CNT}',
                    INTRDC_DESC = '{$INTRDC_DESC}',

                    SERVICE = '{$SERVICE}',
                    ITEM_CD = '{$ITEM_CD}',
                    AREA_DTL_NM = '{$AREA}',

                    TEL_NO = '{$TEL_NO}',
                    HP_NO = '{$HP_NO}',
                    FAX_NO = '{$FAX_NO}',
                    EMAIL_ID = '{$EMAIL_ID}',
                    UPD_ID = '{$MBM_NO}',
                    UPD_DT = NOW()  
	            WHERE IDX='{$idx}'";
        sql_query($update_sql);
    }
    alertMove('수정되었습니다.', '../html/my/my_info.html?tab=1&mb_id='.$MBM_NO);
    return;
}
else if( $_POST['business'] == "business") 
{
	$COMP_CD = addslashes($_POST['COMP_CD']);
	$COMP_NM = addslashes($_POST['COMP_NM']);
	$REG_NO = addslashes($_POST['REG_NO']);
	$MBR_NO = $_SESSION['MBM_NO'];
	$MBR_NM = $_SESSION['MBM_NM'];
	$EMP_CNT = addslashes($_POST['EMP_CNT']);				//매출액(전년도)
	$SALES_AMT = addslashes($_POST['SALES_AMT']);			//매출액 won
	$DTL_SVC_DESC = addslashes($_POST['DTL_SVC_DESC']);		//DTL_SVC_DESC
	$DOM_BRN_CNT = addslashes($_POST['DOM_BRN_CNT']);		//국내지사
	$EXP_BRN_CNT = addslashes($_POST['EXP_BRN_CNT']);		//해외지사
	$EXP_PTN_CNT = addslashes($_POST['EXP_PTN_CNT']);		//해외파트너
	$MAIN_OPR_DESC = addslashes($_POST['MAIN_OPR_DESC']);	//주요수행실적
	$MAIN_INSR_DESC = addslashes($_POST['MAIN_INSR_DESC']);	//주요인증 및 공인기관가입 내역
	$PRE_YEAR = addslashes($_POST['PRE_YEAR']);

    $sql = "SELECT COMP_CD FROM `tcmn_fwd_comp` WHERE COMP_CD = '{$COMP_CD}'";
    $row = sql_fetch($sql);
    
    if(!$row) {	// have no
    	$sql_insert = "INSERT INTO `tcmn_fwd_comp` SET ";
    }
    else {
		$sql_update = "UPDATE tcmn_fwd_comp SET ";
	}

	$LOGO_FILE_NM = "";
	$fileuploaded = 0;
    if (!$_FILES['LOGO_FILE']['error'])
    {
    	$target_path = "../uploads/";
        
        $PACK_ORG_FILE_NM = basename($_FILES['LOGO_FILE']['name']);
        $LOGO_FILE_NM = time().$PACK_ORG_FILE_NM;
        $target_path .= $LOGO_FILE_NM;
        if(move_uploaded_file($_FILES['LOGO_FILE']['tmp_name'], $target_path)) {
        	$LOGO_FILE_NM = RT_PATH."/uploads/".$LOGO_FILE_NM;

        	if(!$row) {
        		$sql_insert .= " LOGO_FILE_NM = '{$LOGO_FILE_NM}' ";
        	}
        	else {
        		$sql_update .= " LOGO_FILE_NM = '{$LOGO_FILE_NM}' ";
        	}
    		
    		$fileuploaded = 1;
        }
    }

	$BIZ_FILE_NM = "";
    if (!$_FILES['BIZ_FILE']['error'])
    {
    	$target_path = "../uploads/";
        
        $PACK_ORG_FILE_NM = basename($_FILES['BIZ_FILE']['name']);
        $BIZ_FILE_NM = time().$PACK_ORG_FILE_NM;
        $target_path .= $BIZ_FILE_NM;          
        if(move_uploaded_file($_FILES['BIZ_FILE']['tmp_name'], $target_path)) 
        {
        	if($fileuploaded == 1) {
        		$sql_insert .= ", ";
        		$sql_update .= ", ";
        	}

        	$BIZ_FILE_NM = RT_PATH."/uploads/".$BIZ_FILE_NM;
        	if(!$row) {
        		$sql_insert .= " BIZ_FILE_NM = '{$BIZ_FILE_NM}' ";
        	}
        	else {
        		$sql_update .= " BIZ_FILE_NM = '{$BIZ_FILE_NM}' ";
        	}

    		$fileuploaded = 1;
        }
    }

	if(!$row) 	// insert new company for fwd
	{
    	if($fileuploaded == 1) {
    		$sql_insert .= ", ";
    	}
	    $sql_insert .= " COMP_CD = '{$COMP_CD}'
			    , COMP_NM = '{$COMP_NM}'
			    , MBR_NO = '{$MBR_NO}'
	            , REG_NO = '{$REG_NO}' 
			    , EMP_CNT = '{$EMP_CNT}'
			    , SALES_AMT = '{$SALES_AMT}'
			    , DTL_SVC_DESC = '{$DTL_SVC_DESC}'
			    , DOM_BRN_CNT = '{$DOM_BRN_CNT}'
			    , EXP_BRN_CNT = '{$EXP_BRN_CNT}'
			    , EXP_PTN_CNT = '{$EXP_PTN_CNT}'

			    , MAIN_OPR_DESC = '{$MAIN_OPR_DESC}'
			    , MAIN_INSR_DESC = '{$MAIN_INSR_DESC}'
			    , PRE_YEAR = '{$PRE_YEAR}'

			    , INP_USR = '{$MBR_NM}'
			    , INP_YMD = now() ";

		sql_query($sql_insert);
	}
	else {
    	if($fileuploaded == 1) {
    		$sql_update .= ", ";
    	}
	    $sql_update .= " COMP_CD = '{$COMP_CD}'
			    , COMP_NM = '{$COMP_NM}'
			    , MBR_NO = '{$MBR_NO}'
	            , REG_NO = '{$REG_NO}' 
			    , EMP_CNT = '{$EMP_CNT}'
			    , SALES_AMT = '{$SALES_AMT}'
			    , DTL_SVC_DESC = '{$DTL_SVC_DESC}'
			    , DOM_BRN_CNT = '{$DOM_BRN_CNT}'
			    , EXP_BRN_CNT = '{$EXP_BRN_CNT}'
			    , EXP_PTN_CNT = '{$EXP_PTN_CNT}'

			    , MAIN_OPR_DESC = '{$MAIN_OPR_DESC}'
			    , MAIN_INSR_DESC = '{$MAIN_INSR_DESC}'
			    , PRE_YEAR = '{$PRE_YEAR}'

			    , UPD_USR = '{$MBR_NM}'
			    , UPD_YMD = now()
			WHERE COMP_CD =  '{$COMP_CD}' ";
		// echo $sql_update;exit;
		sql_query($sql_update);
	}
	alertMove('수정되었습니다.', '../html/my/my_info.html?tab=2&mb_id='.$MBR_NO);
	return;
}
// 해운운임
else if( $_POST['frmSea'] == "frmSea") 
{
	$seaType = $_POST['seaType'];
	$SEQ = $_POST['SEQ'];
	$COMP_CD = $_POST['seaCOMPCD'];
	$POL_CD = $_POST['POL_CD'];
	$POD_CD = $_POST['POD_CD'];
	$TRF_20 = $_POST['TRF_20'];
	$TRF_40 = $_POST['TRF_40'];
	$TRF_4H = $_POST['TRF_4H'];
	$CURR_CD = $_POST['currency'];
	$REMARK = $_POST['REMARK'];
	$TRS_DAYS_CNT = $_POST['T_Time'];
	$APLY_YMD = $_POST['APLY_YMD'];
	$EXPR_YMD = $_POST['EXPR_YMD'];
    $mem_no = $_SESSION['MBM_NO'];
    $mem_nm = $_SESSION['MBM_NM'];

    $sqlPOL = "SELECT LOC_CD FROM `tcmn_unloc_code`  WHERE LOC_NM = '{$POL_CD}'";
    $POL_CD = sql_fetch($sqlPOL);
    $POL_CD = $POL_CD[LOC_CD];
    $sqlPOD = "SELECT LOC_CD FROM `tcmn_unloc_code`  WHERE LOC_NM = '{$POD_CD}'";
    $POD_CD = sql_fetch($sqlPOD);
    $POD_CD = $POD_CD[LOC_CD];

    if($seaType == "add") {	// have no
    	$sql = "INSERT INTO `tcmn_fwd_trf`
                SET COMP_CD = '{$COMP_CD}',
                	SA_CLS_CD ='SEA',
                    POL_CD = '{$POL_CD}',
                    POD_CD = '{$POD_CD}',
                    TRF_20 = '{$TRF_20}',
                    TRF_40 = '{$TRF_40}',
                    TRF_4H = '{$TRF_4H}',
                    CURR_CD = '{$CURR_CD}',
                    REMARK = '{$REMARK}',
                    APLY_YMD = '{$APLY_YMD}',
                    EXPR_YMD = '{$EXPR_YMD}',
                    TRS_DAYS_CNT = '{$TRS_DAYS_CNT}',
                    INP_NO = '{$mem_no}',
                    INP_USR = '{$mem_nm}',
                    INP_YMD = NOW() ";
                
        sql_query($sql);
    }
    else if($seaType == "update")
    {
    	$sql = "UPDATE `tcmn_fwd_trf`
                SET COMP_CD = '{$COMP_CD}',
                    POL_CD = '{$POL_CD}',
                    POD_CD = '{$POD_CD}',
                    TRF_20 = '{$TRF_20}',
                    TRF_40 = '{$TRF_40}',
                    TRF_4H = '{$TRF_4H}',
                    CURR_CD = '{$CURR_CD}',
                    REMARK = '{$REMARK}',
                    APLY_YMD = '{$APLY_YMD}',
                    EXPR_YMD = '{$EXPR_YMD}',
                    TRS_DAYS_CNT = '{$TRS_DAYS_CNT}',
                    UPD_USR = '{$mem_nm}',
                    UPD_YMD = NOW() 
                WHERE SEQ = '{$SEQ}' ";
                
        sql_query($sql);
    }
    alertMove('수정되었습니다.', '../html/my/my_info.html?tab=4&mb_id='.$mem_no);
    return;
}
// 항공운임
else if( $_POST['frmAir'] == "frmAir") 
{
	$airType = $_POST['airType'];
	$SEQ = $_POST['SEQ'];
	$COMP_CD = $_POST['airCOMPCD'];
	$POL_CD = $_POST['POL_CD'];
	$POD_CD = $_POST['POD_CD'];
	$TRF_MIN = $_POST['TRF_MIN'];
	$TRF_N = $_POST['TRF_N'];
	$TRF_45 = $_POST['TRF_45'];
	$TRF_100 = $_POST['TRF_100'];
	$TRF_300 = $_POST['TRF_300'];
	$TRF_500 = $_POST['TRF_500'];
	$TRF_1000 = $_POST['TRF_1000'];
	$TRF_FSC = $_POST['TRF_FSC'];
	$TRF_SSC = $_POST['TRF_SSC'];
	$CURR_CD = $_POST['currency'];
	$REMARK = $_POST['REMARK'];
	$APLY_YMD = $_POST['APLY_YMD'];
	$EXPR_YMD = $_POST['EXPR_YMD'];
    $mem_no = $_SESSION['MBM_NO'];
    $mem_nm = $_SESSION['MBM_NM'];

    $sqlPOL = "SELECT LOC_CD FROM `tcmn_unloc_code`  WHERE LOC_NM = '{$POL_CD}'";
    $POL_CD = sql_fetch($sqlPOL);
    $POL_CD = $POL_CD[LOC_CD];
    $sqlPOD = "SELECT LOC_CD FROM `tcmn_unloc_code`  WHERE LOC_NM = '{$POD_CD}'";
    $POD_CD = sql_fetch($sqlPOD);
    $POD_CD = $POD_CD[LOC_CD];

    if($airType == "add") {	// have no
    	$sql = "INSERT INTO `tcmn_fwd_trf`
                SET COMP_CD = '{$COMP_CD}',
                	SA_CLS_CD ='AIR',
                    POL_CD = '{$POL_CD}',
                    POD_CD = '{$POD_CD}',
                    TRF_MIN = '{$TRF_MIN}',
                    TRF_N = '{$TRF_N}',
                    TRF_45 = '{$TRF_45}',
                    TRF_100 = '{$TRF_100}',
                    TRF_300 = '{$TRF_300}',
                    TRF_500 = '{$TRF_500}',
                    TRF_1000 = '{$TRF_1000}',
                    TRF_FSC = '{$TRF_FSC}',
                    TRF_SSC = '{$TRF_SSC}',
                    CURR_CD = '{$CURR_CD}',
                    REMARK = '{$REMARK}',
                    APLY_YMD = '{$APLY_YMD}',
                    EXPR_YMD = '{$EXPR_YMD}',
                    INP_NO = '{$mem_no}',
                    INP_USR = '{$mem_nm}',
                    INP_YMD = NOW() ";
                
        sql_query($sql);
    }
    else if($airType == "update")
    {
    	$sql = "UPDATE `tcmn_fwd_trf`
                SET COMP_CD = '{$COMP_CD}',
                	SA_CLS_CD ='AIR',
                    POL_CD = '{$POL_CD}',
                    POD_CD = '{$POD_CD}',
                    TRF_MIN = '{$TRF_MIN}',
                    TRF_N = '{$TRF_N}',
                    TRF_45 = '{$TRF_45}',
                    TRF_100 = '{$TRF_100}',
                    TRF_300 = '{$TRF_300}',
                    TRF_500 = '{$TRF_500}',
                    TRF_1000 = '{$TRF_1000}',
                    TRF_FSC = '{$TRF_FSC}',
                    TRF_SSC = '{$TRF_SSC}',
                    CURR_CD = '{$CURR_CD}',
                    REMARK = '{$REMARK}',
                    APLY_YMD = '{$APLY_YMD}',
                    EXPR_YMD = '{$EXPR_YMD}',
                    UPD_USR = '{$mem_nm}',
                    UPD_YMD = NOW() 
                WHERE SEQ = '{$SEQ}' ";
                
        sql_query($sql);
    }
    alertMove('수정되었습니다.', '../html/my/my_info.html?tab=5&mb_id='.$mem_no);
    return;
}

// ajax
else if( $_POST['img_type'] ) 
{
	$mem_no = $_POST['mem_no'];
	if ( $_POST['img_type'] == "head_img" ) 
	{
		$default = RT_PATH."/img/icon/icon-company.png";
		$update_sql = "UPDATE `tbid_spc_fdr` SET IMG_FILE_NM = '{$default}', UPD_DT = NOW() WHERE FDR_NO='{$mem_no}'";
	}
	else if ( $_POST['img_type'] == "logo_img" ) 
	{
		$default = RT_PATH."/img/icon/no_image_01.png";
		$update_sql = "UPDATE `tcmn_fwd_comp` SET LOGO_FILE_NM = '{$default}', UPD_YMD = NOW() WHERE MBR_NO='{$mem_no}'";
	}
	else if ( $_POST['img_type'] == "biz_img" ) 
	{
		$default = RT_PATH."/img/icon/no_image_02.jpg";
		$update_sql = "UPDATE `tcmn_fwd_comp` SET BIZ_FILE_NM = '{$default}', UPD_YMD = NOW() WHERE MBR_NO='{$mem_no}'";
	}
	sql_query($update_sql);
	echo "success";exit;
}
// ajax delete sea
else if( $_POST['frmDelete'] == "Delete" ) 
{
	$SEQ = $_POST['SEQ'];
	$delsql = "DELETE FROM `tcmn_fwd_trf` WHERE SEQ='{$SEQ}'";

	sql_query($delsql);
	echo "success";exit;
}

