<?php
    session_start();
    include_once ('../admin/lib/common.php');
      
    $pid = addslashes($_POST['pid']);
    $qid = addslashes($_POST['qid']);
    $aid = addslashes($_POST['aid']);
    $q_pw = addslashes($_POST['q_pw']);
        
    if($qid) {
        $sql ="SELECT COUNT(*) AS cnt FROM tbl_question WHERE id='{$qid}' AND password='{$q_pw}'";   
        $row = sql_fetch($sql);
        
        if($row['cnt'] > 0) {
            $url = RT_PATH.'/html/quotation/view_question.html?pid='.$pid.'&qid='.$qid;
            print "<script type='text/javascript'>location.href='$url';</script>";
        } else {
            alertMove('비밀번호를 다시 입력하십시오.', RT_PATH.'/html/quotation/questions_and_answers.html?pid='.$pid);
        }    
    }
    
    if($aid) {
        $sql ="SELECT COUNT(*) AS cnt FROM tbl_answer WHERE id='{$aid}' AND password='{$q_pw}'";   
        $row = sql_fetch($sql);
        
        if($row['cnt'] > 0) {
            $url = RT_PATH.'/html/quotation/view_answer.html?pid='.$pid.'&aid='.$aid;
            print "<script type='text/javascript'>location.href='$url';</script>";
        } else {
            alertMove('비밀번호를 다시 입력하십시오.', RT_PATH.'/html/quotation/questions_and_answers.html?pid='.$pid);
        }
    }
    
?>