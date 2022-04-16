<?php
require_once ('connect.php');
require_once ('../include/Cproduct.php');
require_once ('../include/Cdate.php');


/**
 * Se utiliza para devolver los valores al autocomplete
 */

//controlo los parámetros.
if (!isset($_POST['idProduct']))
{
    $_POST['idProduct'] = '';
}
if (!isset($_POST['field']))
{
    $_POST['field'] = '';
}

$product    = new Cproduct();
if(empty($_POST['idProduct']) == FALSE)
{
    $product = new Cproduct();
    $product->setId($_POST['idProduct']);
    if ($product->getData() == TRUE)
    {
	echo 'OK';
	if($_POST['field'] == 'price')
	{
	    echo $product->getListPrice();
	}
	elseif($_POST['field'] == 'name')
	{
	    echo $product->getName();
	}
	exit ;
    }
}

echo 'KO';
?>