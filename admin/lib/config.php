<?php
// 기본설정값
// 도메인

// $my_domain = $_SERVER["HTTP_HOST"];
$my_domain = "http://localhost/wiabid";

define('BASE_URL','http://'.$my_domain);
define('BASE_URL2', $my_domain);
define('BASE_ADM_URL','http://'.$my_domain.'/admin/');

define('G5_MYSQL_HOST', '127.0.0.1');
define('G5_MYSQL_USER', 'root');
define('G5_MYSQL_PASSWORD', '');
// define('G5_MYSQL_DB', 'wiabid');
define('G5_MYSQL_DB', 'wiabidweb2');
define('G5_MYSQL_SET_MODE', false);

// define('G5_MYSQL_HOST', 'uws64-056.cafe24.com');
// define('G5_MYSQL_USER', 'wiabidweb2');
// define('G5_MYSQL_PASSWORD', 'platform2018');
// define('G5_MYSQL_DB', 'wiabidweb2');
// define('G5_MYSQL_SET_MODE', false);

// define('G5_MYSQL_HOST', 'w.rdc.sae.sina.com.cn');
// define('G5_MYSQL_USER', 'kx21jy42wo');
// define('G5_MYSQL_PASSWORD', 'm0ymx5xkzzikliz30zjxy1lz5j04z5xjji3ji3jz');
// define('G5_MYSQL_DB', 'app_sysbit');
// define('G5_MYSQL_SET_MODE', false);
#######################################################

$_DOCUMENT_ROOT = dirname(__FILE__)."/../..";

//edit upload 시 필요
$arrAllowImageExt = array("jpg","gif","png","jpeg");

define('RT_PATH', BASE_URL2);
define('CSS_DIR', RT_PATH.'/css');
define('JS_DIR', RT_PATH.'/js');
define('IMG_DIR', RT_PATH.'/img');

define('ADM_DIR', RT_PATH.'/admin');
define('CSS_ADM_DIR', RT_PATH.'/admin/css');
define('JS_ADM_DIR', RT_PATH.'/admin/js');
define('IMG_ADM_DIR', RT_PATH.'/admin/img');

//  Upload Folder DATA_PATH
//define("CFG_PATH",$_DOCUMENT_ROOT."/uploads");
define("CFG_URL",RT_PATH."/uploads");

define("G5_DATA_PATH", RT_PATH."/uploads");

//메인페이지 URL (PC)
//define('MAIN_PAGE_URL', "/admin/index.php");
define('MAIN_PAGE_URL', "/admin/index.html");

//G5_SESSION_PATH(수정필요)
define("G5_SESSION_PATH",RT_PATH."/home/kobic/pubic_html/session");



//==============================================================================
// 사용기기 설정
// pc 설정 시 모바일 기기에서도 PC화면 보여짐
// mobile 설정 시 PC에서도 모바일화면 보여짐
// both 설정 시 접속 기기에 따른 화면 보여짐
//------------------------------------------------------------------------------
define('G5_SET_DEVICE', 'both');

define('G5_USE_MOBILE', true); // 모바일 홈페이지를 사용하지 않을 경우 false 로 설정
define('G5_USE_CACHE',  true); // 최신글등에 cache 기능 사용 여부


/********************
시간 상수
 ********************/
// 서버의 시간과 실제 사용하는 시간이 틀린 경우 수정하세요.
// 하루는 86400 초입니다. 1시간은 3600초
// 6시간이 빠른 경우 time() + (3600 * 6);
// 6시간이 느린 경우 time() - (3600 * 6);
define('G5_SERVER_TIME',    time());
define('G5_TIME_YMDHIS',    date('Y-m-d H:i:s', G5_SERVER_TIME));
define('G5_TIME_YMD',       substr(G5_TIME_YMDHIS, 0, 10));
define('G5_TIME_HIS',       substr(G5_TIME_YMDHIS, 11, 8));

// 입력값 검사 상수 (숫자를 변경하시면 안됩니다.)
define('G5_ALPHAUPPER',      1); // 영대문자
define('G5_ALPHALOWER',      2); // 영소문자
define('G5_ALPHABETIC',      4); // 영대,소문자
define('G5_NUMERIC',         8); // 숫자
define('G5_HANGUL',         16); // 한글
define('G5_SPACE',          32); // 공백
define('G5_SPECIAL',        64); // 특수문자

// 퍼미션
define('G5_DIR_PERMISSION',  0755); // 디렉토리 생성시 퍼미션
define('G5_FILE_PERMISSION', 0644); // 파일 생성시 퍼미션

// 모바일 인지 결정 $_SERVER['HTTP_USER_AGENT']
define('G5_MOBILE_AGENT',   'phone|samsung|lgtel|mobile|[^A]skt|nokia|blackberry|android|sony');

// SMTP
// lib/mailer.lib.php 에서 사용
define('G5_SMTP',      '127.0.0.1');
define('G5_SMTP_PORT', '25');


/********************
기타 상수
 ********************/

// 암호화 함수 지정
// 사이트 운영 중 설정을 변경하면 로그인이 안되는 등의 문제가 발생합니다.
define('G5_STRING_ENCRYPT_FUNCTION', 'sql_password');

// SQL 에러를 표시할 것인지 지정
// 에러를 표시하려면 TRUE 로 변경
define('G5_DISPLAY_SQL_ERROR', FALSE);

// escape string 처리 함수 지정
// addslashes 로 변경 가능
define('G5_ESCAPE_FUNCTION', 'sql_escape_string');

// sql_escape_string 함수에서 사용될 패턴
//define('G5_ESCAPE_PATTERN',  '/(and|or).*(union|select|insert|update|delete|from|where|limit|create|drop).*/i');
//define('G5_ESCAPE_REPLACE',  '');

// 게시판에서 링크의 기본개수를 말합니다.
// 필드를 추가하면 이 숫자를 필드수에 맞게 늘려주십시오.
define('G5_LINK_COUNT', 2);

// 썸네일 jpg Quality 설정
define('G5_THUMB_JPG_QUALITY', 90);

// 썸네일 png Compress 설정
define('G5_THUMB_PNG_COMPRESS', 5);

// 모바일 기기에서 DHTML 에디터 사용여부를 설정합니다.
define('G5_IS_MOBILE_DHTML_USE', false);

// MySQLi 사용여부를 설정합니다.
define('G5_MYSQLI_USE', true);

// Browscap 사용여부를 설정합니다.
define('G5_BROWSCAP_USE', true);

// 접속자 기록 때 Browscap 사용여부를 설정합니다.
define('G5_VISIT_BROWSCAP_USE', false);

define('G5_IP_DISPLAY', '\\1.♡.\\3.\\4');

define('G5_TIMEZONE', 'Asia/Seoul');

if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on') {   //https 통신일때 daum 주소 js
    define('G5_POSTCODE_JS', '<script src="https://spi.maps.daum.net/imap/map_js_init/postcode.v2.js"></script>');
} else {  //http 통신일때 daum 주소 js
    define('G5_POSTCODE_JS', '<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>');
}

?>