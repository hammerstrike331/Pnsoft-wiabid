<?php
include_once('config.php');
include_once('common.lib.php');    // 공통 라이브러리

$connect_db = sql_connect(G5_MYSQL_HOST, G5_MYSQL_USER, G5_MYSQL_PASSWORD) or die('MySQL Connect Error!!!');
$select_db  = sql_select_db(G5_MYSQL_DB, $connect_db) or die('MySQL DB Error!!!');

//$g5['connect_db'] = $connect_db;

sql_set_charset('utf8', $connect_db);
if(defined('G5_MYSQL_SET_MODE') && G5_MYSQL_SET_MODE) sql_query("SET SESSION sql_mode = ''");
if (defined(G5_TIMEZONE)) sql_query(" set time_zone = '".G5_TIMEZONE."'");

?>