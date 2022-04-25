<?php
require_once ('connect.php');
require_once ('../include/Cproduct.php');
require_once ('../include/Cphoto.php');
require_once ('../include/Cfile.php');
require_once ('../include/Cdate.php');

$photo = new Cphoto();

//Cproduct(): controlo directorios y limpio temporales de los productos
$product = new Cproduct();
$photo->setTableFk($product->getTableName());
$photo->setConstants();
$photo->pathControl();
$photo->deleteOldTempPhotos();

doctype();
?>
<html>
<head>
	<?php head(); ?>
</head>
<body>
<?php
open(FALSE, 'main');
?>
    <div id="welcome">

    	<div id="main-text">
        	<div>La moda sustentable</div>
        	<div>no es tendencia, es el futuro.</div>
        	<div>Alargá la vida de tus prendas...</div>
    	</div>
    </div>
<?php
if ($photo->error())
{
?>
<div class="message error"><?php $photo->showErrors(); ?></div>
<?php
}
close();
?>
</body>
</html>