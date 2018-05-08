<?php
    session_start();
    include_once ('../admin/lib/common.php');
      
    $pid = addslashes($_POST['pid']);
    $aid = addslashes($_POST['aid']);

    $title = addslashes($_POST['title']);
    $check_pass = addslashes($_POST['check_pass']);
    if($check_pass == "on") 
        $check_pass = 1;
    else
        $check_pass = 0;
    $password = addslashes($_POST['password']);
    $content = addslashes($_POST['content']);
       
    $sql ="UPDATE tbl_answer SET         
        title = '{$title}',
        check_pass = '{$check_pass}',
        password = '{$password}',        
        content = '{$content}',
        ins_date = NOW()
        WHERE id='{$aid}'       
    ";   
    sql_query($sql);
    
    alertMove('답변이 수정되었습니다.', RT_PATH.'/html/quotation/questions_and_answers.html?pid='.$pid);
?>