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

<h1 class="del-group">Eliminar movimientos</h1>

<?php
if (isset($_POST['movementGroup']) === FALSE)
{
	$_POST['movementGroup'] = '';
}

$movement = new Cmovement();

$movement->delGroupForm($_POST['movementGroup'], 'movement-query.php', FALSE, 'Movimientos');

close();
?>
</body>
</html>
