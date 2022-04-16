<?php
require_once ('connect.php');
require_once ('../include/Cmovement.php');
require_once ('../include/Cprovider.php');
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

<h1 class="show">Ver movimiento</h1>

<?php
if (isset($_GET['id']) === FALSE)
{
	$_GET['id'] = '';
}

$movement = new Cmovement();

$fields = '';

$i = 0;
$fieldsDetail[$i]['field']  = 'id';
$fieldsDetail[$i]['width']  = '5%';
$fieldsDetail[$i]['strlen'] = '';

$i++;
$fieldsDetail[$i]['field']  = 'nombre';
$fieldsDetail[$i]['width']  = '50%';
$fieldsDetail[$i]['strlen'] = '';

$i++;
$fieldsDetail[$i]['field']  = 'cod';
$fieldsDetail[$i]['width']  = '45%';
$fieldsDetail[$i]['strlen'] = '';


$movement->setId($_GET['id'], TRUE);
$movement->getData();
$movement->showData($fields, TRUE, 'movement-query.php', 'Movimiento');

close();
?>
</body>
</html>