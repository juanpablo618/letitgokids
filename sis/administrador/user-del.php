<?php
require_once ('connect.php');
require_once ('../include/Cuser.php');
require_once ('../include/Cmovement.php');
require_once ('../include/Cproduct.php');
require_once ('../include/Csale.php');
require_once ('../include/Cprovider.php');
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

<h1 class="del">Eliminar usuario</h1>

<?php
if (isset($_GET['id']) === FALSE)
{
	$_GET['id'] = '';
}

$user = new Cuser();

$user->setId($_GET['id'], TRUE);
$user->delForm('user-query.php', FALSE, 'user');

close();
?>
</body>
</html>
