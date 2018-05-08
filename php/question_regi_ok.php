<?php
    session_start();
    include_once ('../admin/lib/common.php');
      
    $pid = addslashes($_POST['pid']);
    $MBM_NO = addslashes($_POST['MBM_NO']);
    $MBM_NM = addslashes($_POST['MBM_NM']);             
    $title = addslashes($_POST['title']);
    $check_pass = addslashes($_POST['check_pass']);
    if($check_pass == "on") 
        $check_pass = 1;
    else
        $check_pass = 0;
    $password = addslashes($_POST['password']);
    $content = addslashes($_POST['content']);
       
    $sql ="INSERT INTO tbl_question SET               
        mem_no = '{$MBM_NO}',
        writer = '{$MBM_NM}',
        title = '{$title}',
        check_pass = '{$check_pass}',
        password = '{$password}',        
        content = '{$content}',
        ins_date = NOW(),
        visit_count = 0        
    ";   
    sql_query($sql);
    
    alertMove('질문이 등록되었습니다.', RT_PATH.'/html/quotation/questions_and_answers.html?pid='.$pid);
?>