<?php
require_once ('connect.php');
require_once ('../include/Cphoto.php');
require_once ('../include/Cfile.php');
require_once ('../include/Cimage.php');

if (isset($_GET['tableFk']) === FALSE)  $_GET['tableFk']    = '';
if (isset($_GET['p']) === FALSE)        $_GET['p']          = '';
if (isset($_GET['t']) === FALSE)        $_GET['t']          = '';
if (isset($_GET['a']) === FALSE)        $_GET['a']          = '';

$photo = new Cphoto();

$photo->setTableFk(base64_decode($_GET['tableFk']), TRUE);
$photo->setConstants();
$photo->setName(base64_decode($_GET['p']), TRUE);
if ($_GET['t'] === 'true')
{
	$photo->setIsTemp(TRUE);
}
else
{
	$photo->setIsTemp(FALSE);
}

$file = new Cfile();

$file->setFile($photo->getName(FALSE));

switch ($file->getExtension(TRUE))
{
	case 'gif':
		$mime = 'image/gif';
		break;
	case 'png':
		$mime = 'image/png';
		break;
	default:
		$mime = 'image/jpeg';
}

header('Content-type: '.$mime);
if ($_GET['a'] === 'false')
{
	$photo->previewPhoto(FALSE);
}
else
{
	$photo->previewPhoto(TRUE);
}
?>