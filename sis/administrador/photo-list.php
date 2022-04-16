<?php
require_once ('connect.php');
require_once ('../include/Cphoto.php');
require_once ('../include/Cfile.php');
require_once ('../include/Cimage.php');

doctype();
?>
<html>
<head>	
	<?php head(); ?>
    <link rel="stylesheet" type="text/css" href="css/cphoto.css" media="screen" />
    <script src="../scripts/Cphoto.js"></script>
</head>
<body onload="checkedSelectedPhotoTinyMCE()">
<?php
if (isset($_GET['tableFk']) === FALSE)  $_GET['tableFk']    = '';
if (isset($_GET['idFk']) === FALSE)     $_GET['idFk']       = '';

$photo = new Cphoto();

if (validateRequiredValue($_GET['tableFk']) === TRUE)
{
	$photo->setTableFk(base64_decode($_GET['tableFk']), TRUE);
}
if (validateRequiredValue($_GET['idFk']) === TRUE)
{
	$photo->setIdFk(base64_decode($_GET['idFk']), TRUE);
}

$photo->setConstants();
$photo->listPhotoTinyMCE();
?>
</body>
</html>