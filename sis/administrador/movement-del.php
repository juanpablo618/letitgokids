<?php
require_once ('connect.php');
require_once ('../include/Cmovement.php');
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

<h1 class="del">Eliminar movimiento</h1>

<?php
if (isset($_GET['id']) === FALSE)
{
	$_GET['id'] = '';
}

$movement = new Cmovement();

$movement->setId($_GET['id'], TRUE);
$movement->delForm('movement-query.php', FALSE, 'Movimiento');

close();
?>
</body>
</html>
