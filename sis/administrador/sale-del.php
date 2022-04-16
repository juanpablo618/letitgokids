<?php
require_once ('connect.php');
require_once ('../include/Csale.php');
require_once ('../include/Cdetail.php');
require_once ('../include/Cproduct.php');
require_once ('../include/Cmovement.php');
require_once ('../include/Crefund.php');
require_once ('../include/Cpayment.php');
require_once ('../include/Cdetail_refund.php');
require_once ('../include/Cdetail_payment.php');
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

<h1 class="del">Eliminar venta</h1>

<?php
if (isset($_GET['id']) === FALSE)
{
	$_GET['id'] = '';
}

$sale = new Csale();

$sale->setId($_GET['id'], TRUE);
$sale->delForm('sale-query.php', FALSE, 'Venta');

close();
?>
</body>
</html>
