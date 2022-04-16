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

<h1 class="del-group">Eliminar Productos</h1>

<?php
if (isset($_POST['productGroup']) === FALSE)
{
	$_POST['productGroup'] = '';
}

$product = new Cproduct();

$product->delGroupForm($_POST['productGroup'], 'product-query.php', FALSE, 'Productos');

close();
?>
</body>
</html>
