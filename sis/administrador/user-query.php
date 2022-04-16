<?php
require_once ('connect.php');
require_once ('../include/Cuser.php');
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

<h1 class="query">Listado de usuarios</h1>

<?php
if (isset($_GET['p']) === FALSE)
{
	$_GET['p'] = '';
}
if (isset($_GET['orderby']) === FALSE)
{
	$_GET['orderby'] = '';
}

$user = new Cuser();

$searchFields = 'id,user,idGroup,active,name,email,idProvider';
$user->searchForm('get', $searchFields, $_GET['p'], 'B&uacute;squeda', TRUE);

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
$fields[$i]['field'] = 'user';
$fields[$i]['width'] = '28%';
$fields[$i]['strlen'] = '';

$i++;
$fields[$i]['field'] = 'name';
$fields[$i]['width'] = '56%';
$fields[$i]['strlen'] = '';


//acciones de la consulta
$actions[0]['file']         = 'user-update.php';
$actions[0]['image']        = 'img/update-head.png';
$actions[0]['image-over']   = 'img/update.png';
$actions[0]['image-head']   = '';
$actions[0]['class']        = 'update';
$actions[0]['text']         = 'Modificar';
$actions[0]['title']        = 'Modificar usuario';
$actions[0]['confirm']      = FALSE;
$actions[0]['msg']          = '';
$actions[0]['width']        = '3%';

$actions[1]['file']         = 'user-del.php';
$actions[1]['image']        = 'img/delete-head.png';
$actions[1]['image-over']   = 'img/delete.png';
$actions[1]['image-head']   = '';
$actions[1]['class']        = 'del';
$actions[1]['text']         = 'Eliminar';
$actions[1]['title']        = 'Eliminar usuario';
$actions[1]['confirm']      = TRUE;
$actions[1]['msg']          = '¿Está seguro que desea eliminar el usuario?';
$actions[1]['width']        = '3%';

//acciones grupales de la consulta
$groupActions[0]['file']    = 'user-del-group.php';
$groupActions[0]['image']   = '';
$groupActions[0]['text']    = 'Eliminar';
$groupActions[0]['title']   = 'Eliminar usuarios seleccionados';
$groupActions[0]['confirm'] = TRUE;
$groupActions[0]['msg']     = '¿Está seguro que desea eliminar los usuarios seleccionados?';
$groupActions[0]['button']  = TRUE;
$groupActions[0]['class']   = 'del';

$user->showQuery($fields, $actions, $groupActions, '5%', TRUE, TRUE, '', TRUE, TRUE, 'Listado', NAV_AMOUNT_PAGES, NAV_RESULTS_PER_PAGE);

close();
?>
</body>
</html>
