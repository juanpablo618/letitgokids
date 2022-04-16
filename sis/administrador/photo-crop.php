<?php
require_once ('connect.php');
require_once ('../include/Cphoto.php');
require_once ('../include/Cimage.php');

doctype();
?>
<html>
<head>	
	<?php head(); ?>
    <link rel="stylesheet" type="text/css" href="css/cphoto.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../scripts/crop/imgareaselect-default.css" media="screen" />    
    <script src="../scripts/Cphoto.js"></script>    
	<script src="../scripts/crop/jquery.imgareaselect.min.js"></script>	
</head>
<body>
<?php
if (isset($_GET['tableFk']) === FALSE)  $_GET['tableFk']    = '';
if (isset($_GET['idFk']) === FALSE)     $_GET['idFk']       = '';
if (isset($_GET['t']) === FALSE)        $_GET['t']          = '';
if (isset($_GET['p']) === FALSE)        $_GET['p']          = '';

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

if ($_GET['t'] === 'false')
{
	$photo->setIsTemp(FALSE);
}
else
{
	$photo->setIsTemp(TRUE);
}

$photo->setName(base64_decode($_GET['p']));
$photo->cropPhotoForm('photo-preview.php', 'Modificar Foto');
?>
</body>
</html>