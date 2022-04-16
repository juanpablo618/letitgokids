<?php
require_once ('connect.php');
require_once ('../include/Cprovider.php');
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

<h1 class="query">Listado de proveedores/clientes</h1>

<?php
if (isset($_GET['p']) === FALSE)
{
	$_GET['p'] = '';
}
if (isset($_GET['orderby']) === FALSE)
{
	$_GET['orderby'] = '';
}

$provider = new Cprovider();

$searchFields = '';
$provider->searchForm('get', $searchFields, $_GET['p'], 'B&uacute;squeda', TRUE);

//orderby por defecto
if ($_GET['orderby'] == '')
{
	$_GET['orderby'] = 'id';
	$_GET['ascdesc'] = 'DESC';
}

//campos que se muestran en la consulta
$i = 0;
$fields[$i]['field'] = 'id';
$fields[$i]['width'] = '2%';
$fields[$i]['strlen'] = '';

$i++;
$fields[$i]['field'] = 'name';
$fields[$i]['width'] = '29%';
$fields[$i]['strlen'] = '';

$i++;
$fields[$i]['field'] = 'email';
$fields[$i]['width'] = '29%';
$fields[$i]['strlen'] = '';

$i++;
$fields[$i]['field'] = 'phone';
$fields[$i]['width'] = '26%';
$fields[$i]['strlen'] = '';

//acciones de la consulta
$actions[0]['file']         = 'provider-update.php';
$actions[0]['image']        = 'img/update-head.png';
$actions[0]['image-over']   = 'img/update.png';
$actions[0]['image-head']   = '';
$actions[0]['class']        = 'update';
$actions[0]['text']         = 'Modificar';
$actions[0]['title']        = 'Modificar proveedor/cliente';
$actions[0]['confirm']      = FALSE;
$actions[0]['msg']          = '';
$actions[0]['width']        = '3%';

$actions[1]['file']         = 'provider-del.php';
$actions[1]['image']        = 'img/delete-head.png';
$actions[1]['image-over']   = 'img/delete.png';
$actions[1]['image-head']   = '';
$actions[1]['class']        = 'del';
$actions[1]['text']         = 'Eliminar';
$actions[1]['title']        = 'Eliminar proveedor/cliente';
$actions[1]['confirm']      = TRUE;
$actions[1]['msg']          = '¿Está seguro que desea eliminar el proveedor/cliente?';
$actions[1]['width']        = '3%';

$actions[2]['file']         = 'provider-show.php';
$actions[2]['image']        = 'img/show-head.png';
$actions[2]['image-over']   = 'img/show.png';
$actions[2]['image-head']   = '';
$actions[2]['class']        = 'show';
$actions[2]['text']         = 'Ver';
$actions[2]['title']        = 'Ver proveedor/cliente';
$actions[2]['confirm']      = FALSE;
$actions[2]['msg']          = '';
$actions[2]['width']        = '3%';

//acciones grupales de la consulta
$groupActions[0]['file']    = 'provider-del-group.php';
$groupActions[0]['image']   = '';
$groupActions[0]['text']    = 'Eliminar';
$groupActions[0]['title']   = 'Eliminar proveedores/clientes seleccionados';
$groupActions[0]['confirm'] = TRUE;
$groupActions[0]['msg']     = '¿Está seguro que desea eliminar los proveedores/clientes seleccionados?';
$groupActions[0]['button']  = TRUE;
$groupActions[0]['class']   = 'del';

$provider->showQuery($fields, $actions, $groupActions, '5%', TRUE, TRUE, '', TRUE, TRUE, 'Listado', NAV_AMOUNT_PAGES, NAV_RESULTS_PER_PAGE);

close();
?>
</body>
</html>
