<?php
require_once ('connect.php');
require_once ('../include/Cprovider.php');

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

<h1 class="update">Modificar proveedor/cliente</h1>

<?php
if (isset($_GET['id']) === FALSE)
{
	$_GET['id'] = '';
}

$provider = new Cprovider();

$fields = '';
$provider->setId($_GET['id'], TRUE);
$provider->updateForm($fields, 'provider-query.php', FALSE, 'proveedor/cliente');

close();
?>
</body>
</html>
