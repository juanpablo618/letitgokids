<?php
require_once ('connect.php');
require_once ('../include/Cphoto.php');
require_once ('../include/Cfile.php');

if (isset($_GET['tableFk']) === FALSE)  $_GET['tableFk']    = '';
if (isset($_GET['t']) === FALSE)        $_GET['t']          = '';
if (isset($_GET['p']) === FALSE)        $_GET['p']          = '';
if (isset($_GET['idPhoto']) === FALSE)  $_GET['idPhoto']    = '';
if (isset($_GET['idFk']) === FALSE)     $_GET['idFk']       = '';

$photo = new Cphoto();
$photo->setTableFk(base64_decode($_GET['tableFk']), TRUE);
$photo->setConstants();

if ($_GET['t'] === 'true')
{
	$photo->setIsTemp(TRUE);
	$photo->setName(base64_decode($_GET['p']));
}
else
{
	$photo->setIsTemp(FALSE);
	$photo->setIdPhoto($_GET['idPhoto'], TRUE);
}
$photo->deletePhotosTemporarily();

$params = '?tableFk='.$_GET['tableFk'];
if (validateRequiredValue($_GET['idFk']) === TRUE)
{
	$params.= '&idFk='.$_GET['idFk'];
}

header('location: photo-add.php'.$params);
exit;
?>