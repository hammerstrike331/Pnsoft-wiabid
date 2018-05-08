<?php
    session_start();
    include_once ('../admin/lib/common.php');
      
    $pid = addslashes($_POST['pid']);
    $qid = addslashes($_POST['qid']);
       
    $sql1 ="DELETE FROM tbl_question WHERE id='{$qid}'";
    sql_query($sql1);

    $sql2 ="DELETE FROM tbl_answer WHERE question_id='{$qid}'";
    sql_query($sql2);
    
    alertMove('질문이 삭제되었습니다.', RT_PATH.'/html/quotation/questions_and_answers.html?pid='.$pid);
?>