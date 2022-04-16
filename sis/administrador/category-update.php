<?php
require_once ('connect.php');
require_once ('../include/Ccategory.php');

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

<h1 class="update">Modificar categoría</h1>

<?php
if (isset($_GET['id']) === FALSE)
{
	$_GET['id'] = '';
}

$category = new Ccategory();

$fields = '';
$category->setId($_GET['id'], TRUE);
$category->updateForm($fields, 'category-query.php', FALSE, 'Categoría');

close();
?>
</body>
</html>
