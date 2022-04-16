<?php
require_once ('connect.php');
require_once ('../include/Crefund.php');
require_once ('../include/Cdetail_refund.php');
require_once ('../include/Cdetail.php');
require_once ('../include/Csale.php');
require_once ('../include/Cprovider.php');
require_once ('../include/Cproduct.php');
require_once ('../include/Cdate.php');
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

<h1 class="query">Listado de devoluciones</h1>

<?php
if (isset($_GET['p']) === FALSE)
{
	$_GET['p'] = '';
}
if (isset($_GET['orderby']) === FALSE)
{
	$_GET['orderby'] = '';
}

$refund = new Crefund();

$searchFields = 'id,dateAdded,idUserAdd,idSale,reason,detail,type,amount';
$refund->searchForm('get', $searchFields, $_GET['p'], 'B&uacute;squeda', TRUE);

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
$fields[$i]['field'] = 'idSale';
$fields[$i]['width'] = '26%';
$fields[$i]['strlen'] = '';

$i++;
$fields[$i]['field'] = 'reason';
$fields[$i]['width'] = '20%';
$fields[$i]['strlen'] = '';

$i++;
$fields[$i]['field'] = 'products';
$fields[$i]['width'] = '30%';
$fields[$i]['strlen'] = '';


//acciones de la consulta
$j = 0;
/*No permito modificar un refund
$actions[$j]['file']         = 'refund-update.php';
$actions[$j]['image']        = 'img/update-head.png';
$actions[$j]['image-over']   = 'img/update.png';
$actions[$j]['image-head']   = '';
$actions[$j]['class']        = 'update';
$actions[$j]['text']         = 'Modificar';
$actions[$j]['title']        = 'Modificar devolución';
$actions[$j]['confirm']      = FALSE;
$actions[$j]['msg']          = '';
$actions[$j]['width']        = '3%';
$j++;*/

$actions[$j]['file']         = 'refund-del.php';
$actions[$j]['image']        = 'img/delete-head.png';
$actions[$j]['image-over']   = 'img/delete.png';
$actions[$j]['image-head']   = '';
$actions[$j]['class']        = 'del';
$actions[$j]['text']         = 'Eliminar';
$actions[$j]['title']        = 'Eliminar devolución';
$actions[$j]['confirm']      = TRUE;
$actions[$j]['msg']          = '¿Está seguro que desea eliminar la devolución?';
$actions[$j]['width']        = '3%';
$j++;

$actions[$j]['file']         = 'refund-show.php';
$actions[$j]['image']        = 'img/show-head.png';
$actions[$j]['image-over']   = 'img/show.png';
$actions[$j]['image-head']   = '';
$actions[$j]['class']        = 'show';
$actions[$j]['text']         = 'Ver';
$actions[$j]['title']        = 'Ver devolución';
$actions[$j]['confirm']      = FALSE;
$actions[$j]['msg']          = '';
$actions[$j]['width']        = '3%';
$j++;

//acciones grupales de la consulta
$groupActions[0]['file']    = 'refund-del-group.php';
$groupActions[0]['image']   = '';
$groupActions[0]['text']    = 'Eliminar';
$groupActions[0]['title']   = 'Eliminar devoluciones seleccionadas';
$groupActions[0]['confirm'] = TRUE;
$groupActions[0]['msg']     = '¿Está seguro que desea eliminar las devoluciones seleccionadas?';
$groupActions[0]['button']  = TRUE;
$groupActions[0]['class']   = 'del';

$refund->showQuery($fields, $actions, $groupActions, '5%', TRUE, TRUE, '', TRUE, TRUE, 'Listado', NAV_AMOUNT_PAGES, NAV_RESULTS_PER_PAGE);

close();
?>
</body>
</html>
