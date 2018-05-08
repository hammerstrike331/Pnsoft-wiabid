<?php
session_start();
include_once("../lib/common.php");

//print_r($_POST);
//echo '<p>';

if (!count($_POST['chk'])) {
    alert($_POST['act_button']." 하실 항목을 하나 이상 체크하세요.");
}

for ($i=0; $i<count($_POST['chk']); $i++) {

    // 실제 번호를 넘김
    $k = $_POST['chk'][$i];

    $reg_no = '';
    $manager = '';
    $sales = '';

    if($_POST['REG_NO'.$k]) $reg_no = $_POST['REG_NO'.$k];
    if($_POST['s_MANAGER'.$k]) $manager = " `MNGR_YN` ='Y' ";
    if($_POST['s_SALES'.$k]) $sales = " `SALE_PIC_YN` = 'Y' ";

    if($manager) {
        $sql = " UPDATE `tcmn_mbr_join` SET {$manager} WHERE `MBR_NO` = '{$k}'";
        //echo $sql . "<br>";
        sql_query($sql);
    } else {
        $sql = " UPDATE `tcmn_mbr_join` SET  `MNGR_YN` = 'N' WHERE `MBR_NO` = '{$k}'";
        //echo $sql . "<br>";
        sql_query($sql);
    }

    if($sales) {
        $sql = " UPDATE `tcmn_mbr_join` SET {$sales} WHERE `MBR_NO` = '{$k}'";
        //echo $sql . "<br>";
        sql_query($sql);
    } else {
        $sql = " UPDATE `tcmn_mbr_join` SET  `SALE_PIC_YN` ='N'  WHERE `MBR_NO` = '{$k}'";
        //echo $sql . "<br>";
        sql_query($sql);
    }

}

alertMove('처리되었습니다.', '../memberList.html');
//exit;