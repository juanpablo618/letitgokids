<?php
require_once ('connect.php');
require_once ('../include/Cproduct.php');
require_once ('../include/Ccategory.php');
require_once ('../include/Cprovider.php');
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

<h1 class="show">Ver producto</h1>

<?php
if (isset($_GET['id']) === FALSE)
{
	$_GET['id'] = '';
}

$product = new Cproduct();

$fields = 'id,name,dateAdded,status,listPrice,description,history';


$product->setId($_GET['id'], TRUE);
$product->getData();
$product->showData($fields, TRUE, 'product-query.php', 'Producto');

close();
?>
</body>
</html>