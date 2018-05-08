<?php
session_start();
include_once("../lib/common.php");

// print_r($_POST);

$up_idx = addslashes($_POST['up_idx']);
$LOC_IDX = addslashes($_POST['u_LOC_IDX']);
$LOC_CD = addslashes($_POST['u_LOC_CD']);
$LOC_NM = addslashes($_POST['u_LOC_NM']);
$NAT_CD = addslashes($_POST['u_NAT_CD']);
$LATD_CD = addslashes($_POST['u_LATD_CD']);
$LOTD_CD = addslashes($_POST['u_LOTD_CD']);
$SA_CLS_CD = addslashes($_POST['u_SA_CLS_CD']);
$USE_YN = addslashes($_POST['u_USE_YN']);



$sql = "UPDATE  `tcmn_unloc_code` 
            SET `LOC_CD` = '{$LOC_CD}',
                `LOC_NM` = '{$LOC_NM}',			
                `AREA_CD` = '{$AREA_CD}',	
                `LATD_CD` = '{$LATD_CD}',
                `LOTD_CD` = '{$LOTD_CD}',
                `INP_USR` = 'admin',
                `INP_DT` =  now(),
                `SA_CLS_CD` = '{$SA_CLS_CD}',
                `USE_YN` = '{$USE_YN}'
		WHERE 	`LOC_IDX` = '{$up_idx}'
				";


sql_query($sql);
//echo $sql;
echo "처리되었습니다.";