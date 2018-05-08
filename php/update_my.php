<?php
session_start();
include_once ('../admin/lib/common.php');

//print_r($_POST);
/*
MBM_EMAIL_ID] => account@wiabid.com
[MBR_NM] => 나 영희
[rdoREG_TYP_CD] => D
[REG_TYP_CD] => B
[PB_TYPE] => D
[REG_NO] => 2358800211
[COMP_NM] => 케이씨로지스
[COMP_KND_CD] => SHP
[COMP_DTL_KND_CD] => 01
[COMP_KND_ETC_NM] =>
[DEPT_NM] =>
[HP_NO] => 01023566225
[TEL_NO] =>
[FAX_NO] =>
*/

$MBR_NO = $_SESSION['MBM_NO'];
$MBM_EMAIL_ID = addslashes($_POST['MBM_EMAIL_ID']);
$MBR_NM = addslashes($_POST['MBR_NM']);
$REG_TYP_CD = addslashes($_POST['rdoREG_TYP_CD']);
$PB_TYPE = addslashes($_POST['PB_TYPE']);
$REG_NO = addslashes($_POST['REG_NO']);
$COMP_NM = addslashes($_POST['COMP_NM']);
$COMP_KND_CD = addslashes($_POST['COMP_KND_CD']);
$LIMIT_KND_CD = addslashes($_POST['LIMIT_KND_CD']);
$COMP_DTL_KND_CD = addslashes($_POST['COMP_DTL_KND_CD']);
$COMP_KND_ETC_NM = addslashes($_POST['COMP_KND_ETC_NM']);
$DEPT_NM = addslashes($_POST['DEPT_NM']);
$HP_NO = addslashes($_POST['HP_NO']);
$TEL_NO = addslashes($_POST['TEL_NO']);
$FAX_NO = addslashes($_POST['FAX_NO']);

if($REG_TYP_CD =="P") {
    $PB_TYPE = "";
} else {
    $PB_TYPE = $REG_TYP_CD;
	$REG_TYP_CD = "B";
}

if($COMP_KND_CD !="ETC") {
    $sCOMP_DTL_KND_CD = "";
}

$sql_insert = "UPDATE tcmn_mbr_join
		  SET MBR_NM = '{$MBR_NM}'
		    , REG_TYP_CD = '{$REG_TYP_CD}'
		    , REG_NO =  '{$REG_NO}'
		    , COMP_NM = '{$COMP_NM}'
		    , COMP_KND_CD = '{$COMP_KND_CD}'
		    , COMP_DTL_KND_CD = '{$COMP_DTL_KND_CD}'
		    , DEPT_NM = '{$DEPT_NM}'
		    , HP_NO = '{$HP_NO}'
		    , TEL_NO = '{$TEL_NO}'
		    , FAX_NO = '{$FAX_NO}'
		    , UPD_USR = '{$MBR_NO}'
		    , UPD_YMD = now()
		WHERE MBR_NO =  '{$MBR_NO}'
";
sql_query($sql_insert);
//
//echo "<p><br>";
//echo $sql_insert;
//echo "<p><br>";


if($LIMIT_KND_CD == "NON") {
    $LIMIT_CD = "Y";
} else {
    $LIMIT_CD = "N";
}

if($REG_NO) {
    $sql_insert2 = "UPDATE tcmn_mbr_comp
		  SET COMP_NM = '{$COMP_NM}'
		    , COMP_KND_CD = '{$COMP_KND_CD}'
		    , COMP_KND_NM = (SELECT CODE_NM FROM tcmn_code_dtl WHERE CLSS_CD = 'COMP_KND' AND CODE_CD = '{$COMP_KND_CD}')
		    , COMP_DTL_KND_CD = '{$sCOMP_DTL_KND_CD}'
            , LIMIT_KND_CD = '{$LIMIT_KND_CD}' 
		    , LIMIT_CD = '{$LIMIT_CD}'
		    , COMP_KND_ETC_NM = '{$COMP_KND_ETC_NM}'
		    , REG_TYP_CD = '{$REG_TYP_CD}'
		    , PB_TYPE = '{$PB_TYPE}'
		    , UPD_USR = '{$MBR_NO}'
		    , UPD_DT = now()
		WHERE REG_NO =  '{$REG_NO}'
";
sql_query($sql_insert2);
//echo $sql_insert2;
}

//echo "<p><br>";
alertMove('수정되었습니다.', '../html/my/my_edit.html');