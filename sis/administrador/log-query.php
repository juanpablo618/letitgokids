<?php
require_once ('connect.php');
require_once ('../include/Clog.php');
require_once ('../include/Cprovider.php');
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

<h1 class="query">Listado de ingresos</h1>

<?php
if (isset($_GET['p']) === FALSE)
{
	$_GET['p'] = '';
}
if (isset($_GET['orderby']) === FALSE)
{
	$_GET['orderby'] = '';
}

$log = new Clog();

$searchFields = 'id,idUser,date,hour';
$log->searchForm('get', $searchFields, $_GET['p'], 'B&uacute;squeda', TRUE);

//orderby por defecto
if ($_GET['orderby'] == '')
{
	$_GET['orderby'] = 'id';
	$_GET['ascdesc'] = 'DESC';
}

//campos que se muestran en la consulta
$i = 0;
$fields[$i]['field'] = 'id';
$fields[$i]['width'] = '6%';
$fields[$i]['strlen'] = '';

$i++;
$fields[$i]['field'] = 'idUser';
$fields[$i]['width'] = '27%';
$fields[$i]['strlen'] = '';

$i++;
$fields[$i]['field'] = 'date';
$fields[$i]['width'] = '27%';
$fields[$i]['strlen'] = '';

$i++;
$fields[$i]['field'] = 'hour';
$fields[$i]['width'] = '27%';
$fields[$i]['strlen'] = '';



$log->showQuery($fields, NULL, NULL, '5%', TRUE, TRUE, '', TRUE, TRUE, 'Listado', NAV_AMOUNT_PAGES, NAV_RESULTS_PER_PAGE);

close();
?>
</body>
</html>
