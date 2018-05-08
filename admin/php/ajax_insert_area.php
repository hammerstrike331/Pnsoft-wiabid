<?php
session_start();
include_once("../lib/common.php");

//print_r($_POST);
//echo "<p>";

$LOC_CD = addslashes($_POST['s_LOC_CD']);
$LOC_NM = addslashes($_POST['s_LOC_NM']);
$NAT_CD = addslashes($_POST['s_NAT_NM']);
$LATD_CD = addslashes($_POST['s_LATD_CD']);
$LOTD_CD = addslashes($_POST['s_LOTD_CD']);
$SA_CLS_CD = addslashes($_POST['s_SA_CLS_CD']);
$USE_YN = addslashes($_POST['s_USE_YN']);

$AREA_CD = addslashes($_POST['AREA_CD']);
$INP_USR = addslashes($_POST['INP_USR']);
$INP_DT = addslashes($_POST['INP_DT']);


$sql = "INSERT INTO  `tcmn_unloc_code` 
            SET `LOC_CD` = '{$LOC_CD}',
                `LOC_NM` = '{$LOC_NM}',			
                `AREA_CD` = '{$AREA_CD}',	
                `LATD_CD` = '{$LATD_CD}',
                `LOTD_CD` = '{$LOTD_CD}',
                `INP_USR` = 'admin',
                `INP_DT` =  now(),
                `SA_CLS_CD` = '{$SA_CLS_CD}',
                `USE_YN` = '{$USE_YN}'
           ";

sql_query($sql);
//echo $sql;
echo "처리되었습니다.";
