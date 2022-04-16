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

<h1 class="del-group">Eliminar ventas</h1>

<?php
if (isset($_POST['saleGroup']) === FALSE)
{
	$_POST['saleGroup'] = '';
}

$sale = new Csale();

$sale->delGroupForm($_POST['saleGroup'], 'sale-query.php', FALSE, 'VEntas');

close();
?>
</body>
</html>
