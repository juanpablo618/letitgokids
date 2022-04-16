<?php
session_start();
require_once ('../include/config.php');
require_once ('../include/functions.php');
require_once ('../include/adodb5/adodb.inc.php');
require_once ('../include/Cbase.php');
require_once ('../include/Cuser.php');

//Para controlar permisos
require_once ('../include/Cgroup.php');
require_once ('../include/Cgroupxpermission.php');
require_once ('../include/Cpermission.php');

require_once ('interface.php');

$dbConn = DBConnect();
$user	= new Cuser($dbConn);

if($user->validateUser() !== TRUE)
{
    header('location: '.ADMIN_LOGIN_URL);
    exit;
}
date_default_timezone_set('America/Argentina/Cordoba');
?>