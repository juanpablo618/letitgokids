<?php
/**
 * Muestra la tabla de los productos de un proveedor.
 */
require_once ('connect.php');
require_once ('../include/Cnavigator.php');
require_once ('../include/Cproduct.php');
require_once ('../include/Cprovider.php');
require_once ('../include/Cmovement.php');
require_once ('../include/Ccategory.php');
require_once ('../include/Csale.php');
require_once ('../include/Cdetail_payment.php');
require_once ('../include/Cdate.php');



$product   = new Cproduct();

if (isset($_POST['idProvider']) === FALSE)
{
    $_POST['idProvider'] = '';
}
if (isset($_POST['productName']) === FALSE)
{
    $_POST['productName'] = '';
}
if (isset($_POST['productGroup']) === FALSE)
{
    $_POST['productGroup'] = '';
}
if (isset($_POST['idPayment']) === FALSE)
{
    $_POST['idPayment'] = '';
}
if($_POST['orderHidden'] != '')
{
    $_GET['orderby'] = $_POST['orderHidden'];
}
if($_POST['ascDescHidden'] != '')
{
    $_GET['ascdesc'] = $_POST['ascDescHidden'];
}
if(isset($_POST['productsBackGroup']) == FALSE)
{
    $_POST['productsBackGroup'] = '';
}
if(isset($_POST['productsPayGroup']) == FALSE)
{
    $_POST['productsPayGroup'] = '';
}
if(isset($_POST['addPayment']) == FALSE)
{
    $_POST['addPayment'] = '';
}
if(isset($_POST['type_pay']) == FALSE)
{
    $_POST['type_pay'] = '';
}

$selectedValuesBack = '';
if(empty($_POST['productsBackGroup']) == FALSE)
{
    $selectedValuesBack = explode(',', $_POST['productsBackGroup']);
}
$selectedValuesPay = '';
if(empty($_POST['productsPayGroup']) == FALSE)
{
    $selectedValuesPay = explode(',', $_POST['productsPayGroup']);
}

$auxFilter  = '';
$aux	    = '';
if (empty($_POST['productName']) === FALSE)
{
    //Limpio si hay doble espacios
    $_POST['productName'] = str_replace('  ', ' ', $_POST['productName']);

    $auxFilter .= $aux.$product->getFieldSql('name', $product->getTableName()).' LIKE '.$product->getValueSql($_POST['productName'], '%%');
    $aux = ' AND ';
}

if(empty($_POST['idProvider']) == FALSE)
{
    $product->showProviderProductTable($_POST['idProvider'], $selectedValuesBack, $selectedValuesPay, $auxFilter);
}
else
{
    ?>
    <div class="message warning">Debe seleccionar un proveedor</div>
    <?php
}

?>