<?php
require_once ('connect.php');
require_once ('../include/Crefund.php');
require_once ('../include/Cdetail_refund.php');
require_once ('../include/Cdetail_payment.php');
require_once ('../include/Cproduct.php');
require_once ('../include/Cprovider.php');
require_once ('../include/Ccategory.php');
require_once ('../include/Csale.php');
require_once ('../include/Cdetail.php');
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

<h1 class="update">Modificar devolución</h1>

<?php
if (isset($_GET['id']) === FALSE)
{
	$_GET['id'] = '';
}

$refund = new Crefund();

$fields = 'id,dateAdded,reason,type,detail,idSale';
$refund->setId($_GET['id'], TRUE);
$refund->updateForm($fields, 'refund-query.php', FALSE, 'Devolución');

close();
?>
</body>
</html>
