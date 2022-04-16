<?php
session_start();
session_destroy();
require_once ('../include/config.php');
header('location: '.ADMIN_LOGIN_URL);
exit;
?>