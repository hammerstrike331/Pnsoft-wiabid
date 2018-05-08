<?php 
	session_start();
	include_once ('../admin/lib/common.php');

	$type = $_POST['type'];
    $text = $_POST['text'];

    $sql = "SELECT LOC_CD, LOC_NM FROM `tcmn_unloc_code`  WHERE (SA_CLS_CD = 'ALL' OR SA_CLS_CD = '{$type}') AND LOC_NM LIKE('%{$text}%') LIMIT 200";

    $result = sql_query($sql);

    $list = '<div class="popmenuCont"><ul class="popmenu">';
    for ($i=0; $row=sql_fetch_array($result); $i++) {
            $list .= "<li>{$row['LOC_NM']}</li>";
    }
    $list .= '</ul></div>';

    echo $list;exit;

?>