<?php
require_once ('connect.php');
require_once ('../include/Crefund.php');
require_once ('../include/Cdetail_refund.php');
require_once ('../include/Cproduct.php');
require_once ('../include/Csale.php');
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

<h1 class="show">Ver devolución</h1>

<?php
if (isset($_GET['id']) === FALSE)
{
	$_GET['id'] = '';
}

$refund = new Crefund();

$fields = '';

$refund->setId($_GET['id'], TRUE);
$refund->getData();
$refund->showData($fields, TRUE, 'refund-query.php', 'Devolución');

close();
?>
</body>
</html>