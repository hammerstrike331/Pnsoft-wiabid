<?php
session_start();
include_once ("../lib/func.lib.php");

unset($_COOKIE['member_count']);
unset($_COOKIE['send_count']);
unset($_COOKIE['payment_ready']);
unset($_COOKIE['payment_count']);

session_destroy();

move('../index.html');

?>