<?php
require_once ('connect.php');
require_once ('../include/Cproduct.php');
require_once ('../include/Cprovider.php');
require_once ('../include/Ccategory.php');
require_once ('../include/Cdate.php');
require_once ('../include/Cphoto.php');
require_once ('../include/Cfile.php');
require_once ('../include/Cimage.php');

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

<h1 class="add">Agregar producto</h1>

<?php
$product = new Cproduct();

$fields = 'id,name,idProvider,dateAdded,status,listPrice,idCategory,description';
$product->addForm($fields, 'product-query.php', FALSE, 'Producto');

close();
?>
</body>
</html>
