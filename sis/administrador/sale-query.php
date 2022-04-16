<?php
require_once ('connect.php');
require_once ('../include/Csale.php');
require_once ('../include/Cdate.php');
require_once ('../include/Cprovider.php');
require_once ('../include/Cdetail.php');
require_once ('../include/Cproduct.php');
require_once ('../include/Crefund.php');
require_once ('../include/Cdetail_refund.php');
require_once ('../include/Cdetail_payment.php');
require_once ('../include/Cnavigator.php');

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

<h1 class="query">Listado de ventas</h1>

<?php
if (isset($_GET['p']) === FALSE)
{
	$_GET['p'] = '';
}
if (isset($_GET['orderby']) === FALSE)
{
	$_GET['orderby'] = '';
}

$sale = new Csale();

$searchFields = 'id,dateAdded,totalAmountGross,totalAmountNet,idUserAdd,idClient';
$sale->searchForm('get', $searchFields, $_GET['p'], 'B&uacute;squeda', TRUE);

//orderby por defecto
if ($_GET['orderby'] == '')
{
	$_GET['orderby'] = 'id';
	$_GET['ascdesc'] = 'DESC';
}

//campos que se muestran en la consulta
$i = 0;
$fields[$i]['field'] = 'id';
$fields[$i]['width'] = '5%';
$fields[$i]['strlen'] = '';

$i++;
$fields[$i]['field'] = 'dateAdded';
$fields[$i]['width'] = '8%';
$fields[$i]['strlen'] = '';

$i++;
$fields[$i]['field'] = 'idClient';
$fields[$i]['width'] = '20%';
$fields[$i]['strlen'] = '';

$i++;
$fields[$i]['field'] = 'products';
$fields[$i]['width'] = '20%';
$fields[$i]['strlen'] = '';

$i++;
$fields[$i]['field'] = 'totalAmountGross';
$fields[$i]['width'] = '17%';
$fields[$i]['strlen'] = '';

$i++;
$fields[$i]['field'] = 'totalAmountNet';
$fields[$i]['width'] = '17%';
$fields[$i]['strlen'] = '';

//acciones de la consulta
$actions[0]['file']         = 'sale-update.php';
$actions[0]['image']        = 'img/update-head.png';
$actions[0]['image-over']   = 'img/update.png';
$actions[0]['image-head']   = '';
$actions[0]['class']        = 'update';
$actions[0]['text']         = 'Modificar';
$actions[0]['title']        = 'Modificar venta';
$actions[0]['confirm']      = FALSE;
$actions[0]['msg']          = '';
$actions[0]['width']        = '3%';

$actions[1]['file']         = 'sale-del.php';
$actions[1]['image']        = 'img/delete-head.png';
$actions[1]['image-over']   = 'img/delete.png';
$actions[1]['image-head']   = '';
$actions[1]['class']        = 'del';
$actions[1]['text']         = 'Eliminar';
$actions[1]['title']        = 'Eliminar venta';
$actions[1]['confirm']      = TRUE;
$actions[1]['msg']          = '¿Está seguro que desea eliminar la venta?';
$actions[1]['width']        = '3%';


$actions[2]['file']         = 'refund-add.php';
$actions[2]['image']        = 'img/no-head.png';
$actions[2]['image-over']   = 'img/no.png';
$actions[2]['image-head']   = '';
$actions[2]['class']        = 'del';
$actions[2]['text']         = 'Devolución';
$actions[2]['title']        = 'Devolución venta';
$actions[2]['confirm']      = FALSE;
$actions[2]['msg']          = '';
$actions[2]['width']        = '3%';

//acciones grupales de la consulta
$groupActions[0]['file']    = 'sale-del-group.php';
$groupActions[0]['image']   = '';
$groupActions[0]['text']    = 'Eliminar';
$groupActions[0]['title']   = 'Eliminar ventas seleccionadas';
$groupActions[0]['confirm'] = TRUE;
$groupActions[0]['msg']     = '¿Está seguro que desea eliminar las ventas seleccionadas?';
$groupActions[0]['button']  = TRUE;
$groupActions[0]['class']   = 'del';

$sale->showQuery($fields, $actions, $groupActions, '3%', TRUE, TRUE, '', TRUE, TRUE, 'Listado', NAV_AMOUNT_PAGES, NAV_RESULTS_PER_PAGE);

close();
?>
</body>
</html>
