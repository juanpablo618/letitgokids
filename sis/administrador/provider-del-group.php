<?php
require_once ('connect.php');
require_once ('../include/Cprovider.php');
require_once ('../include/Cmovement.php');
require_once ('../include/Cproduct.php');
require_once ('../include/Cpayment.php');
require_once ('../include/Ccategory.php');
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

<h1 class="del-group">Eliminar proveedores/clientes</h1>

<?php
if (isset($_POST['providerGroup']) === FALSE)
{
	$_POST['providerGroup'] = '';
}

$provider = new Cprovider();

$provider->delGroupForm($_POST['providerGroup'], 'provider-query.php', FALSE, 'Proveedores/Clientes');

close();
?>
</body>
</html>
