<?php
require_once ('connect.php');
require_once ('../include/Cpayment.php');
require_once ('../include/Cdetail_payment.php');
require_once ('../include/Cmovement.php');
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

<h1 class="del-group">Eliminar rendiciones</h1>

<?php
if (isset($_POST['paymentGroup']) === FALSE)
{
	$_POST['paymentGroup'] = '';
}

$payment = new Cpayment();

$payment->delGroupForm($_POST['paymentGroup'], 'payment-query.php', FALSE, 'Rendición');

close();
?>
</body>
</html>
