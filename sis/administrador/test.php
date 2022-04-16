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
require_once ('../include/Csale.php');
require_once ('../include/Crefund.php');
require_once ('../include/Cdetail_refund.php');
require_once ('../include/Cdetail.php');
require_once ('../include/Cproduct.php');
require_once ('../include/Cmovement.php');
require_once ('../include/Cdate.php');


$dbConn = DBConnect();

date_default_timezone_set('America/Argentina/Cordoba');

$dateAdded = date($dbConn->fmtDate);

echo $dateAdded = str_replace("'", '', $dateAdded);

$refund = new Crefund($dbConn);

$refund->setId(2);

dump($refund->canDelete());

$refund->showErrors();
?>