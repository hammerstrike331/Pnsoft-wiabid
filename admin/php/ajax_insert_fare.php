<?php
session_start();
include_once("../lib/common.php");

print_r($_POST);


$SA_CLS_CD = addslashes($_POST['s_SA_CLS_CD']);
$FRT_GRP_CD = addslashes($_POST['s_FRT_GRP_CD']);
$FRT_CD = addslashes($_POST['s_FRT_CD']);
$FRT_ENG_NM = addslashes($_POST['s_FRT_ENG_NM']);
$FRT_NM = addslashes($_POST['s_FRT_NM']);
$TAX_RATE = addslashes($_POST['s_TAX_RATE']);
$CURR_CD = addslashes($_POST['s_CURR_CD']);
$DISP_YN = addslashes($_POST['s_DISP_YN']);
$DSP_SEQ_NO = addslashes($_POST['s_DSP_SEQ_NO']);
$USE_YN = addslashes($_POST['s_USE_YN']);


$sql = "INSERT INTO  `tcmn_frt_code` 
           SET `SA_CLS_CD` = '{$SA_CLS_CD}',            
                `FRT_GRP_CD` = '{$FRT_GRP_CD}',
                `FRT_CD` = '{$FRT_CD}',			
                `FRT_ENG_NM` = '{$FRT_ENG_NM}',	
                `FRT_NM` = '{$FRT_NM}',
                `TAX_RATE` = '{$TAX_RATE}',
                `CURR_CD` = '{$CURR_CD}',
                `DISP_YN` = '{$DISP_YN}',
                `DSP_SEQ_NO` = '{$DSP_SEQ_NO}',
                `USE_YN` = '{$USE_YN}',
                `INP_USR` = 'admin',
                `INP_YMD` =  now()
           ";

sql_query($sql);
//echo $sql;
echo "처리되었습니다.";
