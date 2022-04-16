<?php
require_once ('connect.php');
require_once ('../include/Cproduct.php');
require_once ('../include/Cdate.php');
require_once ('../include/Cprovider.php');
require_once ('../include/Csale.php');
require_once ('../include/Cdetail.php');
require_once ('../include/Ccategory.php');
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

<h1 class="query">Listado de productos vendidos</h1>

<?php
if (isset($_GET['p']) === FALSE)
{
	$_GET['p'] = '';
}
if (isset($_GET['orderby']) === FALSE)
{
	$_GET['orderby'] = '';
}

$product = new Cproduct();

/*$searchFields = 'id,name,description,idProvider,dateAdded,idCategory,listPrice,idUserAdd,code,dateSold,dateChangeStatus';
$product->searchForm('get', $searchFields, $_GET['p'], 'B&uacute;squeda', TRUE);*/

//orderby por defecto
if ($_GET['orderby'] == '')
{
	$_GET['orderby'] = 'date_sold';
	$_GET['ascdesc'] = 'DESC';
}

//campos que se muestran en la consulta
$i = 0;
$fields[$i]['field'] = 'id';
$fields[$i]['width'] = '5%';
$fields[$i]['strlen'] = '';

$i++;
$fields[$i]['field'] = 'name';
$fields[$i]['width'] = '30%';
$fields[$i]['strlen'] = '';

$i++;
$fields[$i]['field'] = 'dateSold';
$fields[$i]['width'] = '15%';
$fields[$i]['strlen'] = '';


$i++;
$fields[$i]['field'] = 'idClient';
$fields[$i]['width'] = '30%';
$fields[$i]['strlen'] = '';


$i++;
$fields[$i]['field'] = 'saleInfo';
$fields[$i]['width'] = '15%';
$fields[$i]['strlen'] = '';


$product->showQuerySell($fields, NULL, NULL, '3%', TRUE, TRUE, '', TRUE, TRUE, 'Listado', NAV_AMOUNT_PAGES, NAV_RESULTS_PER_PAGE);

close();
?>
</body>
</html>
