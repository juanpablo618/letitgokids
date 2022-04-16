<?php
require_once ('connect.php');
require_once ('../include/Cprovider.php');
require_once ('../include/Cmovement.php');
require_once ('../include/Cproduct.php');
require_once ('../include/Ccategory.php');
require_once ('../include/Cpayment.php');
require_once ('../include/Crefund.php');
require_once ('../include/Cdate.php');


/**
 * Se utiliza para devolver la cta cte del cliente/proveedor
 */

//controlo los parámetros.
if (!isset($_POST['idClient']))
{
    $_POST['idClient'] = '';
}

$movement   = new Cmovement();
$product    = new Cproduct();
if(empty($_POST['idClient']) == FALSE)
{
    $provider = new Cprovider();
    $provider->setId($_POST['idClient']);
    if ($provider->getData() == TRUE)
    {
    	$TOTAL = $movement->getProviderStatus($_POST['idClient']);

    	echo 'OK';

    	$txtCtaCte    = '';
    	$classCtaCte  = '';
    	if($TOTAL > 0)
    	{
    	    $txtCtaCte	= 'Nos debe: $ '.numberFormat($TOTAL);
    	    $classCtaCte  = 'red';
    	}
    	elseif($TOTAL == 0)
    	{
    	    $txtCtaCte    = 'Saldo: $ 0';
    	    $classCtaCte  = 'gray';
    	}
    	else
    	{
    	    $txtCtaCte = 'Debemos: $ '.numberFormat($TOTAL * -1);
    	    $classCtaCte  = 'green';
    	}

    	echo '<label>&nbsp;</label><div class="ctaCteClientWrapper '.$classCtaCte.'"><b>Cuenta corriente:</b> '.$txtCtaCte.'</div><div class="clear"></div>';


    	$TOTAL         = $product->getProviderStatus($_POST['idClient']);
    	$txtProduct	   = '';
    	$classProduct  = '';
    	if($TOTAL[0] > 0)
    	{
    	    $txtProduct    = 'Debemos: $ '.numberFormat($TOTAL[0]).' (efvo.) / $'.numberFormat($TOTAL[1]).' (cta cte)';
    	    $classProduct  = 'green';
    	}
    	else
    	{
    	    $txtProduct = 'Saldo: $ 0';
    	    $classProduct  = 'gray';
    	}

    	echo '<label>&nbsp;</label><div class="ctaCteClientWrapper '.$classProduct.'"><b>Productos:</b> '.$txtProduct.'</div><div class="clear"></div>';


    	$product = new Cproduct();
    	$search = $product->getFieldSql('id_provider', $product->getTableName()).' = '.$product->getValueSql($provider->getId(FALSE)).' AND '.$product->getFieldSql('status').' = '.$product->getValueSql('give_back');
    	$product->getList($search);
    	$txtProductToReturn	   = '';
    	$classProductToReturn  = '';
    	if($product->getTotalList() > 0)
    	{
    	    $txtProductToReturn    = $product->getTotalList();
    	    $classProductToReturn  = 'green';
    	}
    	else
    	{
    	    $txtProductToReturn    = 0;
    	    $classProductToReturn  = 'gray';
    	}

    	echo '<label>&nbsp;</label><div class="ctaCteClientWrapper '.$classProductToReturn.'"><b>Devolver:</b> '.$txtProductToReturn.'</div><div class="clear"></div>';
    	exit;
    }
}

echo 'KO';
?>