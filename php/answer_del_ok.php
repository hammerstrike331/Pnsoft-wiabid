<?php
    session_start();
    include_once ('../admin/lib/common.php');
      
    $pid = addslashes($_POST['pid']);
    $aid = addslashes($_POST['aid']);
       
    $sql ="DELETE FROM tbl_answer WHERE id='{$aid}'";   
    sql_query($sql);
    
    alertMove('답변이 삭제되었습니다.', RT_PATH.'/html/quotation/questions_and_answers.html?pid='.$pid);
?>