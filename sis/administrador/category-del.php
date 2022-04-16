<?php
require_once ('connect.php');
require_once ('../include/Ccategory.php');
require_once ('../include/Cproduct.php');
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

<h1 class="del">Eliminar categoría</h1>

<?php
if (isset($_GET['id']) === FALSE)
{
	$_GET['id'] = '';
}

$category = new Ccategory();

$category->setId($_GET['id'], TRUE);
$category->delForm('category-query.php', FALSE, 'Categoría');

close();
?>
</body>
</html>
