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

<h1 class="add">Agregar proveedor/cliente</h1>

<?php
$provider = new Cprovider();

$fields = '';
$provider->addForm($fields, 'provider-query.php', FALSE, 'Proveedor/Cliente');

close();
?>
</body>
</html>
