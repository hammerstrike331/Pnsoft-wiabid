<?php
// 각종 편리한 함수 모음

########################################################################################
## 세션 쿠키 관련 함수
########################################################################################
// 세션변수 생성
function set_session($session_name, $value)
{
    if (PHP_VERSION < '5.3.0')
        session_register($session_name);
    // PHP 버전별 차이를 없애기 위한 방법
    $$session_name = $_SESSION[$session_name] = $value;
}


// 세션변수값 얻음
function get_session($session_name)
{
    return isset($_SESSION[$session_name]) ? $_SESSION[$session_name] : '';
}


// 쿠키변수 생성
function set_cookie($cookie_name, $value, $expire)
{

    setcookie(md5($cookie_name), base64_encode($value), G5_SERVER_TIME + $expire, '/', G5_COOKIE_DOMAIN);
}

// 쿠키변수값 얻음
function get_cookie($cookie_name)
{
    $cookie = md5($cookie_name);
    if (array_key_exists($cookie, $_COOKIE))
        return base64_decode($_COOKIE[$cookie]);
    else
        return "";
}

// 토큰 생성
function _token()
{
    return md5(uniqid(rand(), true));
}

// 불법접근을 막도록 토큰을 생성하면서 토큰값을 리턴
function get_token()
{
    $token = md5(uniqid(rand(), true));
    set_session('ss_token', $token);

    return $token;
}


// POST로 넘어온 토큰과 세션에 저장된 토큰 비교
function check_token()
{
    set_session('ss_token', '');
    return true;
}

####  세션 쿠키 관련 함수  END -




########################################################################################
## 자동화 처리
########################################################################################

// URL 자동 링크
function url_auto_link($str)
{
    global $config;
    // http://sir.kr/pg_lecture/461
    // http://sir.kr/pg_lecture/463
    $str = str_replace(array("&lt;", "&gt;", "&amp;", "&quot;", "&nbsp;", "&#039;"), array("\t_lt_\t", "\t_gt_\t", "&", "\"", "\t_nbsp_\t", "'"), $str);
    //$str = preg_replace("`(?:(?:(?:href|src)\s*=\s*(?:\"|'|)){0})((http|https|ftp|telnet|news|mms)://[^\"'\s()]+)`", "<A HREF=\"\\1\" TARGET='{$config['cf_link_target']}'>\\1</A>", $str);
    $str = preg_replace("/([^(href=\"?'?)|(src=\"?'?)]|\(|^)((http|https|ftp|telnet|news|mms):\/\/[a-zA-Z0-9\.-]+\.[가-힣\xA1-\xFEa-zA-Z0-9\.:&#=_\?\/~\+%@;\-\|\,\(\)]+)/i", "\\1<A HREF=\"\\2\" TARGET=\"{$config['cf_link_target']}\">\\2</A>", $str);
    $str = preg_replace("/(^|[\"'\s(])(www\.[^\"'\s()]+)/i", "\\1<A HREF=\"http://\\2\" TARGET=\"{$config['cf_link_target']}\">\\2</A>", $str);
    $str = preg_replace("/[0-9a-z_-]+@[a-z0-9._-]{4,}/i", "<a href=\"mailto:\\0\">\\0</a>", $str);
    $str = str_replace(array("\t_nbsp_\t", "\t_lt_\t", "\t_gt_\t", "'"), array("&nbsp;", "&lt;", "&gt;", "&#039;"), $str);


    return $str;
}

// url에 http:// 를 붙인다
function set_http($url)
{
    if (!trim($url)) return;

    if (!preg_match("/^(http|https|ftp|telnet|news|mms)\:\/\//i", $url))
        $url = "http://" . $url;

    return $url;
}

### 자동화 처리 END -



########################################################################################
## 용량, 문자열, 시간 계산 모음
########################################################################################
// 한글 요일
function get_yoil($date, $full=0)
{
    $arr_yoil = array ('일', '월', '화', '수', '목', '금', '토');

    $yoil = date("w", strtotime($date));
    $str = $arr_yoil[$yoil];
    if ($full) {
        $str .= '요일';
    }
    return $str;
}


// 파일의 용량을 구한다.
function get_filesize($size)
{
    //$size = @filesize(addslashes($file));
    if ($size >= 1048576) {
        $size = number_format($size/1048576, 1) . "M";
    } else if ($size >= 1024) {
        $size = number_format($size/1024, 1) . "K";
    } else {
        $size = number_format($size, 0) . "byte";
    }
    return $size;
}


// 폴더의 용량 ($dir는 / 없이 넘기세요)
function get_dirsize($dir)
{
    $size = 0;
    $d = dir($dir);
    while ($entry = $d->read()) {
        if ($entry != '.' && $entry != '..') {
            $size += filesize($dir.'/'.$entry);
        }
    }
    $d->close();
    return $size;
}


// 마이크로 타임을 얻어 계산 형식으로 만듦
function get_microtime()
{
    list($usec, $sec) = explode(" ",microtime());
    return ((float)$usec + (float)$sec);
}

// 문자열 자르기
function cut_str($str, $len, $suffix="…")
{
    $arr_str = preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY);
    $str_len = count($arr_str);

    if ($str_len >= $len) {
        $slice_str = array_slice($arr_str, 0, $len);
        $str = join("", $slice_str);

        return $str . ($str_len > $len ? $suffix : '');
    } else {
        $str = join("", $arr_str);
        return $str;
    }
}

// UTF-8 문자열 자르기
// 출처 : https://www.google.co.kr/search?q=utf8_strcut&aq=f&oq=utf8_strcut&aqs=chrome.0.57j0l3.826j0&sourceid=chrome&ie=UTF-8
function utf8_strcut( $str, $size, $suffix='...' )
{
    $substr = substr( $str, 0, $size * 2 );
    $multi_size = preg_match_all( '/[\x80-\xff]/', $substr, $multi_chars );

    if ( $multi_size > 0 )
        $size = $size + intval( $multi_size / 3 ) - 1;

    if ( strlen( $str ) > $size ) {
        $str = substr( $str, 0, $size );
        $str = preg_replace( '/(([\x80-\xff]{3})*?)([\x80-\xff]{0,2})$/', '$1', $str );
        $str .= $suffix;
    }

    return $str;
}

// 문자열에 utf8 문자가 들어 있는지 검사하는 함수
// 코드 : http://in2.php.net/manual/en/function.mb-check-encoding.php#95289
function is_utf8($str)
{
    $len = strlen($str);
    for($i = 0; $i < $len; $i++) {
        $c = ord($str[$i]);
        if ($c > 128) {
            if (($c > 247)) return false;
            elseif ($c > 239) $bytes = 4;
            elseif ($c > 223) $bytes = 3;
            elseif ($c > 191) $bytes = 2;
            else return false;
            if (($i + $bytes) > $len) return false;
            while ($bytes > 1) {
                $i++;
                $b = ord($str[$i]);
                if ($b < 128 || $b > 191) return false;
                $bytes--;
            }
        }
    }
    return true;
}


// 한글(2bytes)에서 마지막 글자가 1byte로 끝나는 경우
// 출력시 깨지는 현상이 발생하므로 마지막 완전하지 않은 글자(1byte)를 하나 없앰
function cut_hangul_last($hangul)
{
    // 한글이 반쪽나면 ?로 표시되는 현상을 막음
    $cnt = 0;
    for($i=0;$i<strlen($hangul);$i++) {
        // 한글만 센다
        if (ord($hangul[$i]) >= 0xA0) {
            $cnt++;
        }
    }

    return $hangul;
}

// 랜덤 문자열 만들기
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ=-_';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

/*
-----------------------------------------------------------
    Charset 을 변환하는 함수
-----------------------------------------------------------
iconv 함수가 있으면 iconv 로 변환하고 없으면 mb_convert_encoding 함수를 사용한다.둘다 없으면 사용할 수 없다.
*/

function convert_charset($from_charset, $to_charset, $str)
{

    if( function_exists('iconv') )
        return iconv($from_charset, $to_charset, $str);
    elseif( function_exists('mb_convert_encoding') )
        return mb_convert_encoding($str, $to_charset, $from_charset);
    else
        die("Not found 'iconv' or 'mbstring' library in server.");
}

// CHARSET 변경 : euc-kr -> utf-8
function iconv_utf8($str)
{
    return iconv('euc-kr', 'utf-8', $str);
}


// CHARSET 변경 : utf-8 -> euc-kr
function iconv_euckr($str)
{
    return iconv('utf-8', 'euc-kr', $str);
}


// TEXT 형식으로 변환
function get_text($str, $html=0, $restore=false)
{
    $source[] = "<";
    $target[] = "&lt;";
    $source[] = ">";
    $target[] = "&gt;";
    $source[] = "\"";
    $target[] = "&#034;";
    $source[] = "\'";
    $target[] = "&#039;";

    if($restore)
        $str = str_replace($target, $source, $str);

    // 3.31
    // TEXT 출력일 경우 &amp; &nbsp; 등의 코드를 정상으로 출력해 주기 위함
    if ($html == 0) {
        $str = html_symbol($str);
    }

    if ($html) {
        $source[] = "\n";
        $target[] = "<br/>";
    }

    return str_replace($source, $target, $str);
}

function html_symbol($str)
{
    return preg_replace("/\&([a-z0-9]{1,20}|\#[0-9]{0,3});/i", "&#038;\\1;", $str);
}


// HTML 특수문자 변환 htmlspecialchars
function htmlspecialchars2($str)
{
    $trans = array("\"" => "&#034;", "'" => "&#039;", "<"=>"&#060;", ">"=>"&#062;");
    $str = strtr($str, $trans);
    return $str;
}

// date 형식 변환
function conv_date_format($format, $date, $add='')
{
    if($add)
        $timestamp = strtotime($add, strtotime($date));
    else
        $timestamp = strtotime($date);

    return date($format, $timestamp);
}

// 검색어 특수문자 제거
function get_search_string($stx)
{
    $stx_pattern = array();
    $stx_pattern[] = '#\.*/+#';
    $stx_pattern[] = '#\\\*#';
    $stx_pattern[] = '#\.{2,}#';
    $stx_pattern[] = '#[/\'\"%=*\#\(\)\|\+\&\!\$~\{\}\[\]`;:\?\^\,]+#';

    $stx_replace = array();
    $stx_replace[] = '';
    $stx_replace[] = '';
    $stx_replace[] = '.';
    $stx_replace[] = '';

    $stx = preg_replace($stx_pattern, $stx_replace, $stx);

    return $stx;
}


// 문자열이 한글, 영문, 숫자, 특수문자로 구성되어 있는지 검사
function check_string($str, $options)
{
    $s = '';
    for($i=0;$i<strlen($str);$i++) {
        $c = $str[$i];
        $oc = ord($c);

        // 한글
        if ($oc >= 0xA0 && $oc <= 0xFF) {
            if ($options & G5_HANGUL) {
                $s .= $c . $str[$i+1] . $str[$i+2];
            }
            $i+=2;
        }
        // 숫자
        else if ($oc >= 0x30 && $oc <= 0x39) {
            if ($options & G5_NUMERIC) {
                $s .= $c;
            }
        }
        // 영대문자
        else if ($oc >= 0x41 && $oc <= 0x5A) {
            if (($options & G5_ALPHABETIC) || ($options & G5_ALPHAUPPER)) {
                $s .= $c;
            }
        }
        // 영소문자
        else if ($oc >= 0x61 && $oc <= 0x7A) {
            if (($options & G5_ALPHABETIC) || ($options & G5_ALPHALOWER)) {
                $s .= $c;
            }
        }
        // 공백
        else if ($oc == 0x20) {
            if ($options & G5_SPACE) {
                $s .= $c;
            }
        }
        else {
            if ($options & G5_SPECIAL) {
                $s .= $c;
            }
        }
    }

    // 넘어온 값과 비교하여 같으면 참, 틀리면 거짓
    return ($str == $s);
}


### 용량, 문자열, 시간 계산 모음 -



########################################################################################
##  alert, comfirm, goto, msg  등등
########################################################################################

// 메타태그를 이용한 URL 이동
// header("location:URL") 을 대체
function goto_url($url)
{
    $url = str_replace("&amp;", "&", $url);
    //echo "<script> location.replace('$url'); </script>";

    if (!headers_sent())
        header('Location: '.$url);
    else {
        echo '<script>';
        echo 'location.replace("'.$url.'");';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
        echo '</noscript>';
    }
    exit;
}

#메세지
function alert($msg){
    print "<script type='text/javascript'>alert('$msg      \\n');</script>";
}

#이동
function move($url){
    if(!$url){
        print "<script type='text/javascript'>history.go(-1);</script>";
    }else{
        print "<script type='text/javascript'>location.href='$url';</script>";
    }
    exit;
}

#창닫기
function win_close($msg){
    print "<script type='text/javascript'>alert('$msg      \\n');self.close();opener.location.reload();</script>";
    exit;
}

#메세지후 이동
function alertMove($msg , $url=''){
    print "<script type='text/javascript'>alert('$msg       \\n');</script>";
    if(!$url){
        print "<script type='text/javascript'>history.go(-1);</script>";
    }else{
        print "<script type='text/javascript'>location.href='$url';</script>";
    }
    exit;
}

#메세지후 이동 리플레이스
function alertReplace($msg, $url){
    print "<script type='text/javascript'>alert('$msg       \\n');location.replace('$url');</script>";
}

#메세지후 이동 리플레이스
function alertPrentReplace($msg, $url){
    print "<script type='text/javascript'>alert('$msg       \\n');parent.location.replace('$url');</script>";
}


#이동 리플레이스
function Replace($url){
    print "<script type='text/javascript'>location.replace('".$url."');</script>";
}

#메세지후 부모창 이동
function parent_go( $msg="", $href=0 )
{
    $go = $href ? "parent.location='$href';" : "history.go(-1);";

    echo " <script type='text/javascript'> ";
    if (trim($msg)!=""){
        echo "  window.alert('$msg'); ";
    }
    //echo " alert('$href'); ";
    echo "  $go ";
    echo " </script> ";
    exit;
}

#메세지후 닫기
function msg_close( $msg="", $reload=0 )
{
    $go = $reload ? "opener.location.reload();" : "";


    echo "<script type='text/javascript'>";
    if($msg!=""){ echo "alert('$msg');"; }
    echo $go;
    echo "parent.close();";
    echo "window.close();";
    echo "self.close();";
    echo "</script>";
    exit;
}

#메세지후 닫기
function msg_modalclose( $msg="" ,$reload ='')
{
    $go = $reload ? "parent.location.reload();" : "";

    echo "<script type='text/javascript'>";
    if($msg!=""){ echo "alert('$msg');"; }
    echo $go;
    echo "parent.$('#myModal').modal('hide');";
    echo "window.close();";
    echo "self.close();";
    echo "</script>";
    exit;
}

### alert, comfirm, goto, msg  등등  END -



/*

    <li class="prev disabled"><a href="javascript:;">Prev</a></li>
    <li class="prev"><a href="?page=460&amp;">Prev</a></li>

    <li class="active"><a href="javascript:;">1</a></li> &nbsp;
    <li><a href="?page=2&amp;">2</a></li> &nbsp;

    <li class="next"><a href="?page=31&amp;">Next</a></li>
    <li class="next disabled"><a href="javascript:;">Next</a></li>

					<div class="paging">
						<a href="javascript:void(0)" class="first">처음</a>
						<a href="javascript:void(0)" class="prev">이전</a>
						<a href="javascript:void(0)">1</a>
						<a href="javascript:void(0)">2</a>
						<a href="javascript:void(0)" class="next">다음</a>
						<a href="javascript:void(0)" class="last">마지막</a>
					</div>
*/


// 한페이지에 보여줄 행, 현재페이지, 총페이지수, URL
function get_paging($write_pages, $cur_page, $total_page, $url, $add="")
{
    global $aslang;
    $url = preg_replace('#&amp;page=[0-9]*#', '', $url) . '&amp;page=';

    $str = '';

    if ($cur_page > 1) {
        //$str .= '<a href="javascript:void(0)"  class="first">처음</a>'.PHP_EOL; //처음
        $str .= ''.PHP_EOL; //처음
    }

    $start_page = ( ( (int)( ($cur_page - 1 ) / $write_pages ) ) * $write_pages ) + 1;
    $end_page = $start_page + $write_pages - 1;

    if ($end_page >= $total_page) $end_page = $total_page;

    if ($start_page > 1) {
        $str .= '<a href="' . $url . ($start_page - 1) . $add . '" class="prev">이전</a> ' . PHP_EOL; //이전
    }

    if ($total_page > 1) {
        for ($k=$start_page;$k<=$end_page;$k++) {
            if ($cur_page != $k) {
                $str .= '<a href="' . $url . $k . $add . '">' . $k . '</a> &nbsp;' . PHP_EOL; //페이지
            } else {
                $str .= '<a href="' . $url . $k . $add . '" class="on">' . $k . '</a> &nbsp;' . PHP_EOL; //현재 페이지
            }
        }
    }

    if ($total_page > $end_page) {
        $str .= '<a href="' . $url . ($end_page + 1) . $add . '" class="next">다음</a>' . PHP_EOL; //다음
    }

    if ($cur_page <= $total_page) {
        //$str .= '<a href="javascript:void(0)"  class="last">마지막</a>'.PHP_EOL; //맨끝
        $str .= ''.PHP_EOL; //맨끝
    }


    if ($str)
        return $str;
    else
        return "";

}

// 한페이지에 보여줄 행, 현재페이지, 총페이지수, URL
function get_paging2($write_pages, $cur_page, $total_page, $url, $add="")
{
    //$url = preg_replace('#&amp;page=[0-9]*(&amp;page=)$#', '$1', $url);
    $url = preg_replace('#&amp;page=[0-9]*#', '', $url) . '&amp;page=';

    $str = '';
    $str .= '<ul class="pagination pagination-split text-center">';

    if ($cur_page > 1) {
        $str .= '<li><a href="'.$url.'1'.$add.'"><i class="fa fa-angle-left"></i></a></li>'.PHP_EOL;
    }

    $start_page = ( ( (int)( ($cur_page - 1 ) / $write_pages ) ) * $write_pages ) + 1;
    $end_page = $start_page + $write_pages - 1;

    if ($end_page >= $total_page) $end_page = $total_page;

    if ($start_page > 1) $str .= '<li><a href="'.$url.($start_page-1).$add.'"><i class="fa fa-angle-left"></i></a></li>'.PHP_EOL;

    if ($total_page > 1) {
        for ($k=$start_page;$k<=$end_page;$k++) {
            if ($cur_page != $k)
                $str .= '<li><a href="'.$url.$k.$add.'" >'.$k.'</a></li>'.PHP_EOL;
            else
                $str .= '<li class="active"><a href="javascript:void(0)">'.$k.'</a></li>'.PHP_EOL;
        }
    }

    if ($total_page > $end_page) $str .= '<li><a href="'.$url.($end_page+1).$add.'"><i class="fa fa-angle-right"></i></a><li>'.PHP_EOL;

    if ($cur_page < $total_page) {
        $str .= '<li><a href="'.$url.$total_page.$add.'"><i class="fa fa-angle-right"></i></a></li>'.PHP_EOL;
    }
        $str .=  '</ul>';
    if ($str)
        return "{$str}";
    else
        return "";
}


// 한페이지에 보여줄 행, 현재페이지, 총페이지수, URL
function get_paging3($write_pages, $cur_page, $total_page, $url, $add="")
{
    //$url = preg_replace('#&amp;page=[0-9]*(&amp;page=)$#', '$1', $url);
    $url = preg_replace('#&amp;page=[0-9]*#', '', $url) . '&amp;page=';

    $str = '';
    $str .= '<ul class="pagination pagination-split text-center">';

    if ($cur_page > 1) {
        // $str .= '<li><a href="'.$url.'1'.$add.'"><img src="'.RT_PATH.'/img/icon/icon-back-b.png" alt="맨앞"></a></li>'.PHP_EOL;
        $str .= '<li><a href="'.$url.'1'.$add.'"><i class="fa fa-angle-double-left"></i></a></li>'.PHP_EOL;
    }

    $start_page = ( ( (int)( ($cur_page - 1 ) / $write_pages ) ) * $write_pages ) + 1;
    $end_page = $start_page + $write_pages - 1;

    if ($end_page >= $total_page) $end_page = $total_page;

    if ($start_page > 1) 
        // $str .= '<li><a href="'.$url.($start_page-1).$add.'"><img src="'.RT_PATH.'/img/icon/icon-back-bb.png" alt="이전"></a></li>'.PHP_EOL;
        $str .= '<li><a href="'.$url.($start_page-1).$add.'"><i class="fa fa-angle-right"></i></a></li>'.PHP_EOL;
    if ($total_page > 1) {
        for ($k=$start_page;$k<=$end_page;$k++) {
            if ($cur_page != $k)
                $str .= '<li style="padding-top:10px;"><a href="'.$url.$k.$add.'" >'.$k.'</a></li>'.PHP_EOL;
            else
                $str .= '<li class="active" style="padding-top:10px;"><a href="javascript:void(0)">'.$k.'</a></li>'.PHP_EOL;
        }
    }

    if ($total_page > $end_page) 
        // $str .= '<li><a href="'.$url.($end_page+1).$add.'"><img src="'.RT_PATH.'/img/icon/icon-next-n.png" alt="다음"></a><li>'.PHP_EOL;
        $str .= '<li><a href="'.$url.($end_page+1).$add.'"><i class="fa fa-angle-right"></i></a><li>'.PHP_EOL;

    if ($cur_page < $total_page) {
        // $str .= '<li><a href="'.$url.$total_page.$add.'"><img src="'.RT_PATH.'/img/icon/icon-next-nn.png" alt="맨끝"></a></li>'.PHP_EOL;
        $str .= '<li><a href="'.$url.$total_page.$add.'"><i class="fa fa-angle-double-right"></i></a></li>'.PHP_EOL;
    }

    $str .=  '</ul>';
    if ($str)
        return "{$str}";
    else
        return "";
}

// 페이징 코드의 <nav><span> 태그 다음에 코드를 삽입
function page_insertbefore($paging_html, $insert_html)
{
    if(!$paging_html)
        $paging_html = '<nav class="pg_wrap"><span class="pg"></span></nav>';

    return preg_replace("/^(<nav[^>]+><span[^>]+>)/", '$1'.$insert_html.PHP_EOL, $paging_html);
}

// 페이징 코드의 </span></nav> 태그 이전에 코드를 삽입
function page_insertafter($paging_html, $insert_html)
{
    if(!$paging_html)
        $paging_html = '<nav class="pg_wrap"><span class="pg"></span></nav>';

    if(preg_match("#".PHP_EOL."</span></nav>#", $paging_html))
        $php_eol = '';
    else
        $php_eol = PHP_EOL;

    return preg_replace("#(</span></nav>)$#", $php_eol.$insert_html.'$1', $paging_html);
}

// 변수 또는 배열의 이름과 값을 얻어냄. print_r() 함수의 변형
function print_r2($var)
{
    ob_start();
    print_r($var);
    $str = ob_get_contents();
    ob_end_clean();
    $str = str_replace(" ", "&nbsp;", $str);
    echo nl2br("<span style='font-family:Tahoma, 굴림; font-size:9pt;'>$str</span>");
}



/*******************************************************************************
유일한 키를 얻는다.

결과 :
년월일시분초00 ~ 년월일시분초99
년(4) 월(2) 일(2) 시(2) 분(2) 초(2) 100분의1초(2)
총 16자리이며 년도는 2자리로 끊어서 사용해도 됩니다.
예) 2008062611570199 또는 08062611570199 (2100년까지만 유일키)

사용하는 곳 :
1. 게시판 글쓰기시 미리 유일키를 얻어 파일 업로드 필드에 넣는다.
2. 주문번호 생성시에 사용한다.
3. 기타 유일키가 필요한 곳에서 사용한다.
 *******************************************************************************/
// 기존의 get_unique_id() 함수를 사용하지 않고 get_uniqid() 를 사용한다.
function get_uniqid()
{
    global $g5;

    sql_query(" LOCK TABLE {$g5['uniqid_table']} WRITE ");
    while (1) {
        // 년월일시분초에 100분의 1초 두자리를 추가함 (1/100 초 앞에 자리가 모자르면 0으로 채움)
        $key = date('YmdHis', time()) . str_pad((int)(microtime()*100), 2, "0", STR_PAD_LEFT);

        $result = sql_query(" insert into {$g5['uniqid_table']} set uq_id = '$key', uq_ip = '{$_SERVER['REMOTE_ADDR']}' ", false);
        if ($result) break; // 쿼리가 정상이면 빠진다.

        // insert 하지 못했으면 일정시간 쉰다음 다시 유일키를 만든다.
        usleep(10000); // 100분의 1초를 쉰다
    }
    sql_query(" UNLOCK TABLES ");

    return $key;
}


// goo.gl 짧은주소 만들기
function googl_short_url($longUrl)
{
    global $config;

    // Get API key from : http://code.google.com/apis/console/
    // URL Shortener API ON
    $apiKey = $config['cf_googl_shorturl_apikey'];

    $postData = array('longUrl' => $longUrl);
    $jsonData = json_encode($postData);

    $curlObj = curl_init();

    curl_setopt($curlObj, CURLOPT_URL, 'https://www.googleapis.com/urlshortener/v1/url?key='.$apiKey);
    curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($curlObj, CURLOPT_HEADER, 0);
    curl_setopt($curlObj, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
    curl_setopt($curlObj, CURLOPT_POST, 1);
    curl_setopt($curlObj, CURLOPT_POSTFIELDS, $jsonData);

    $response = curl_exec($curlObj);

    //change the response json string to object
    $json = json_decode($response);

    curl_close($curlObj);

    return $json->id;
}


function g5_path()
{
    $result['path'] = str_replace('\\', '/', dirname(__FILE__));
    $tilde_remove = preg_replace('/^\/\~[^\/]+(.*)$/', '$1', $_SERVER['SCRIPT_NAME']);
    $document_root = str_replace($tilde_remove, '', $_SERVER['SCRIPT_FILENAME']);
    $root = str_replace($document_root, '', $result['path']);
    $port = $_SERVER['SERVER_PORT'] != 80 ? ':'.$_SERVER['SERVER_PORT'] : '';
    $http = 'http' . ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on') ? 's' : '') . '://';
    $user = str_replace(str_replace($document_root, '', $_SERVER['SCRIPT_FILENAME']), '', $_SERVER['SCRIPT_NAME']);
    $host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME'];
    if(isset($_SERVER['HTTP_HOST']) && preg_match('/:[0-9]+$/', $host))
        $host = preg_replace('/:[0-9]+$/', '', $host);
    $host = preg_replace("/[\<\>\'\"\\\'\\\"\%\=\(\)\/\^\*]/", '', $host);
    $result['url'] = $http.$host.$port.$user.$root;
    return $result;
}

// multi-dimensional array에 사용자지정 함수적용
function array_map_deep($fn, $array)
{
    if(is_array($array)) {
        foreach($array as $key => $value) {
            if(is_array($value)) {
                $array[$key] = array_map_deep($fn, $value);
            } else {
                $array[$key] = call_user_func($fn, $value);
            }
        }
    } else {
        $array = call_user_func($fn, $array);
    }

    return $array;
}

########################################################################################
##
##   키를 이용한 암호화/복호화 함수
##   // 사용 예
##   $message = "다양한 원본 메시지 東西南北 ABC abc 123 ※ ↔ ";
##   $key = "아..이정도면 매우 복잡한 키--;";
##
##   $encrypted = encrypt_md5($message, $key);
##   $decrypted = decrypt_md5($encrypted, $key);
##
##   echo " <HR>";
##   echo "Encrypted = $encrypted";
##   echo "Decrypted = $decrypted";
##
########################################################################################
function bytexor($a,$b)
{
    $c="";
    for($i=0;$i<16;$i++)$c.=$a{$i}^$b{$i};
    return $c;
}


function decrypt_md5($msg,$key)
{
    $string="";
    $buffer="";
    $key2="";

    while($msg)
    {
        $key2=pack("H*",md5($key.$key2.$buffer));
        $buffer=bytexor(substr($msg,0,16),$key2);
        $string.=$buffer;
        $msg=substr($msg,16);
    }
    return($string);
}

function encrypt_md5($msg,$key)
{
    $string="";
    $buffer="";
    $key2="";

    while($msg)
    {
        $key2=pack("H*",md5($key.$key2.$buffer));
        $buffer=substr($msg,0,16);
        $string.=bytexor($buffer,$key2);
        $msg=substr($msg,16);
    }
    return($string);
}

########################################################################################
#  보안관련
########################################################################################
// XSS 관련 태그 제거
function clean_xss_tags($str)
{
    $str = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $str);
    return $str;
}

#######################################################################################
#  코드 추출
#######################################################################################

function list_options($str) {

    $sql= "SELECT CODE_CD, CODE_NM FROM `tcmn_code_dtl` WHERE CLSS_CD = '{$str}'";
    $result = sql_query($sql);

    $list_ = "<option value=''>선택</option>";
    for ($i=0; $row=sql_fetch_array($result); $i++) {
            $list_ .= "<option value='{$row['CODE_CD']}'>({$row['CODE_CD']}) {$row['CODE_NM']}</option>";
    }
    return $list_;
}

function list_options1($str, $selCode) {

    $sql= "SELECT CODE_CD, CODE_NM FROM `tcmn_code_dtl` WHERE CLSS_CD = '{$str}'";
    $result = sql_query($sql);

    $list_ = "<option value=''>선택</option>";
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        if($selCode == $row['CODE_CD'])
            $list_ .= "<option value='{$row['CODE_CD']}' selected>({$row['CODE_CD']}) {$row['CODE_NM']}</option>";
        else
            $list_ .= "<option value='{$row['CODE_CD']}'>({$row['CODE_CD']}) {$row['CODE_NM']}</option>";
    }
    return $list_;
}



function list_loc($str) {

    $sql= "SELECT LOC_CD, LOC_NM FROM `tcmn_unloc_code`  WHERE SA_CLS_CD = '{$str}'";
    $result = sql_query($sql);

    $list_ = "<option value=''>선택</option>";
    for ($i=0; $row=sql_fetch_array($result); $i++) {
            $list_ .= "<option value='{$row['LOC_CD']}'>({$row['LOC_CD']}) {$row['LOC_NM']}</option>";
    }
    return $list_;
}



?>