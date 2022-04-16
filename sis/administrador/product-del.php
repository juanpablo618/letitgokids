<?php
require_once ('connect.php');
require_once ('../include/Cproduct.php');
require_once ('../include/Cdetail.php');
require_once ('../include/Cphoto.php');
require_once ('../include/Cfile.php');

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

<h1 class="del">Eliminar categor&iacute;a</h1>

<?php
if (isset($_GET['id']) === FALSE)
{
	$_GET['id'] = '';
}

$product = new Cproduct();

$product->setId($_GET['id'], TRUE);
$product->delForm('product-query.php', FALSE, 'Producto');

close();
?>
</body>
</html>
