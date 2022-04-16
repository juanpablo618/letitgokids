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
    <script src="../scripts/Cphoto.js"></script>    
</head>
<body onload="checkedMain();">
<?php
if (isset($_GET['tableFk']) === FALSE)      $_GET['tableFk']        = '';
if (isset($_GET['idFk']) === FALSE)         $_GET['idFk']           = '';
if (isset($_GET['photosLimit']) === FALSE)  $_GET['photosLimit']    = '';

$photo = new Cphoto();

if (validateRequiredValue($_GET['tableFk']) === TRUE)
{
	$photo->setTableFk(base64_decode($_GET['tableFk']), TRUE);
}
if (validateRequiredValue($_GET['idFk']) === TRUE)
{
	$photo->setIdFk(base64_decode($_GET['idFk']), TRUE);
}
if (validateRequiredValue($_GET['photosLimit']) === TRUE)
{
	$photo->setPhotosLimit(base64_decode($_GET['photosLimit']));
}

$photo->setConstants();
$photo->addPhotoForm('img/', 'photo-preview.php', 'photo-del.php', FALSE, FALSE, FALSE);
?>
</body>
</html>