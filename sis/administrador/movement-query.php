<?php
require_once ('connect.php');
require_once ('../include/Cmovement.php');
require_once ('../include/Cproduct.php');
require_once ('../include/Cprovider.php');
require_once ('../include/Cpayment.php');
require_once ('../include/Ccategory.php');
require_once ('../include/Ccurrent_account.php');
require_once ('../include/Cnavigator.php');
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

<h1 class="query">Listado de movimiento</h1>

<?php
if (isset($_GET['p']) === FALSE)
{
	$_GET['p'] = '';
}
if (isset($_GET['orderby']) === FALSE)
{
	$_GET['orderby'] = '';
}

$movement = new Cmovement();

$searchFields = 'id,dateAdded,amount,idClient,idSale,description,typePay,typeMovement,idUserAdd,type,idProvider,discount';
$movement->searchForm('get', $searchFields, $_GET['p'], 'B&uacute;squeda', TRUE);

//orderby por defecto
if ($_GET['orderby'] == '')
{
	$_GET['orderby'] = 'id';
	$_GET['ascdesc'] = 'DESC';
}

//campos que se muestran en la consulta
$i = 0;
$fields[$i]['field'] = 'id';
$fields[$i]['width'] = '3%';
$fields[$i]['strlen'] = '';

$i++;
$fields[$i]['field'] = 'dateAdded';
$fields[$i]['width'] = '10%';
$fields[$i]['strlen'] = '';

$i++;
$fields[$i]['field'] = 'typeMovement';
$fields[$i]['width'] = '12%';
$fields[$i]['strlen'] = '';

$i++;
$fields[$i]['field'] = 'description';
$fields[$i]['width'] = '32%';
$fields[$i]['strlen'] = '';

$i++;
$fields[$i]['field'] = 'type';
$fields[$i]['width'] = '10%';
$fields[$i]['strlen'] = '';

$i++;
$fields[$i]['field'] = 'typePay';
$fields[$i]['width'] = '10%';
$fields[$i]['strlen'] = '';

$i++;
$fields[$i]['field'] = 'amount';
$fields[$i]['width'] = '10%';
$fields[$i]['strlen'] = '';

//acciones de la consulta
$actions[0]['file']         = 'movement-update.php';
$actions[0]['image']        = 'img/update-head.png';
$actions[0]['image-over']   = 'img/update.png';
$actions[0]['image-head']   = '';
$actions[0]['class']        = 'update';
$actions[0]['text']         = 'Modificar';
$actions[0]['title']        = 'Modificar movimiento';
$actions[0]['confirm']      = FALSE;
$actions[0]['msg']          = '';
$actions[0]['width']        = '3%';

$actions[1]['file']         = 'movement-del.php';
$actions[1]['image']        = 'img/delete-head.png';
$actions[1]['image-over']   = 'img/delete.png';
$actions[1]['image-head']   = '';
$actions[1]['class']        = 'del';
$actions[1]['text']         = 'Eliminar';
$actions[1]['title']        = 'Eliminar movimiento';
$actions[1]['confirm']      = TRUE;
$actions[1]['msg']          = '¿Está seguro que desea eliminar el movimiento?';
$actions[1]['width']        = '3%';

$actions[2]['file']         = 'movement-show.php';
$actions[2]['image']        = 'img/show-head.png';
$actions[2]['image-over']   = 'img/show.png';
$actions[2]['image-head']   = '';
$actions[2]['class']        = 'show';
$actions[2]['text']         = 'Ver';
$actions[2]['title']        = 'Ver movimiento';
$actions[2]['confirm']      = FALSE;
$actions[2]['msg']          = '';
$actions[2]['width']        = '3%';

//acciones grupales de la consulta
$groupActions[0]['file']    = 'movement-del-group.php';
$groupActions[0]['image']   = '';
$groupActions[0]['text']    = 'Eliminar';
$groupActions[0]['title']   = 'Eliminar movimientos seleccionados';
$groupActions[0]['confirm'] = TRUE;
$groupActions[0]['msg']     = '¿Está seguro que desea eliminar los movimiento seleccionados?';
$groupActions[0]['button']  = TRUE;
$groupActions[0]['class']   = 'del';

$movement->showQuery($fields, $actions, $groupActions, '3%', TRUE, TRUE, '', TRUE, TRUE, 'Listado', NAV_AMOUNT_PAGES, NAV_RESULTS_PER_PAGE);

close();
?>
</body>
</html>
