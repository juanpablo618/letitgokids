<?php
require_once ('connect.php');
require_once ('../include/Cprovider.php');
require_once ('../include/Cmovement.php');
require_once ('../include/Cproduct.php');
require_once ('../include/Cpayment.php');
require_once ('../include/Crefund.php');
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

<h1 class="del">Eliminar proveedor/cliente</h1>

<?php
if (isset($_GET['id']) === FALSE)
{
	$_GET['id'] = '';
}

$provider = new Cprovider();

$provider->setId($_GET['id'], TRUE);
$provider->delForm('provider-query.php', FALSE, 'Proveedor/Cliente');

close();
?>
</body>
</html>
