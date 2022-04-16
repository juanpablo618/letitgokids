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

<h1 class="add">Agregar categoría</h1>

<?php
$category = new Ccategory();

$fields = '';
$category->addForm($fields, 'category-query.php', FALSE, 'Categoría');

close();
?>
</body>
</html>
