<?php
require_once ('connect.php');
require_once ('../include/Cmovement.php');
require_once ('../include/Cprovider.php');
require_once ('../include/Cproduct.php');
require_once ('../include/Ccategory.php');
require_once ('../include/Cpayment.php');
require_once ('../include/Crefund.php');
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

<h1 class="show">Estado por movimientos</h1>

<?php
$movement = new Cmovement();

$movement->reportExpenditure();

close();
?>
</body>
</html>
