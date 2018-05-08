<?php
    session_start();
    include_once ('../admin/lib/common.php');
      
    $pid = addslashes($_POST['pid']);
    $qid = addslashes($_POST['qid']);
    
    $title = addslashes($_POST['title']);
    $check_pass = addslashes($_POST['check_pass']);
    if($check_pass == "on") 
        $check_pass = 1;
    else
        $check_pass = 0;
    $password = addslashes($_POST['password']);
    $content = addslashes($_POST['content']);
       
    $sql ="UPDATE tbl_question SET 
        title = '{$title}',
        check_pass = '{$check_pass}',
        password = '{$password}',        
        content = '{$content}',
        ins_date = NOW()        
        WHERE id='{$qid}'
    ";   
    sql_query($sql);
    
    alertMove('질문이 수정되었습니다.', RT_PATH.'/html/quotation/questions_and_answers.html?pid='.$pid);
?>