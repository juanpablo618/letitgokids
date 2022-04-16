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

<h1 class="del-group">Eliminar categorías</h1>

<?php
if (isset($_POST['categoryGroup']) === FALSE)
{
	$_POST['categoryGroup'] = '';
}

$category = new Ccategory();

$category->delGroupForm($_POST['categoryGroup'], 'category-query.php', FALSE, 'Categorías');

close();
?>
</body>
</html>
