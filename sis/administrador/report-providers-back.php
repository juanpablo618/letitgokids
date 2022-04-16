<?php
require_once ('connect.php');
require_once ('../include/Cprovider.php');
require_once ('../include/Cproduct.php');
require_once ('../include/Ccategory.php');
require_once ('../include/Cdate.php');

doctype();
?>
<html>
<head>
	<?php head(); ?>
</head>
<body>
<?php
open();
?>

<h1 class="show">Productos a devolver</h1>

<?php
$provider = new Cprovider();

$provider->reportProductToBack();

close();
?>
</body>
</html>
