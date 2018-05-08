<?php
session_start();
include_once("../lib/common.php");

$up_idx = addslashes($_POST['up_idx']);
$SA_CLS_CD = addslashes($_POST['u_SA_CLS_CD']);
$FRT_GRP_CD = addslashes($_POST['u_FRT_GRP_CD']);
$FRT_CD = addslashes($_POST['u_FRT_CD']);
$FRT_ENG_NM = addslashes($_POST['u_FRT_ENG_NM']);
$FRT_NM = addslashes($_POST['u_FRT_NM']);
$TAX_RATE = addslashes($_POST['u_TAX_RATE']);
$CURR_CD = addslashes($_POST['u_CURR_CD']);
$DISP_YN = addslashes($_POST['u_DISP_YN']);
$DSP_SEQ_NO = addslashes($_POST['u_DSP_SEQ_NO']);
$USE_YN = addslashes($_POST['u_USE_YN']);

$sql = "UPDATE  `tcmn_frt_code` 
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
                `UPD_USR` = 'admin',
                `UPD_YMD` =  now()
        WHERE `IDX` = '{$up_idx}'

           ";
sql_query($sql);
echo "입력 완료되었습니다.";
//echo $sql;


?>