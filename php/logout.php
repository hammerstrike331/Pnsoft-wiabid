<?php
session_start();
include_once ('../admin/lib/common.php');


session_destroy();

move(RT_PATH.'/index.html');

?>