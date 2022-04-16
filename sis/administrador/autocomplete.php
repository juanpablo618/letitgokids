<?php
require_once ('connect.php');
require_once ('../include/Cproduct.php');
require_once ('../include/Cprovider.php');
require_once ('../include/Ccategory.php');
require_once ('../include/Cdate.php');


/**
 * Se utiliza para devolver los valores al autocomplete
 */

header('Content-Type: application/json');

//controlo los parámetros.
if (!isset($_POST['id']))
{
	$_POST['id'] = '';
}
if (!isset($_POST['term']))
{
	$_POST['term'] = '';
}
if (!isset($_POST['idProvider']))
{
	$_POST['idProvider'] = '';
}
if (!isset($_POST['searchFilter']))
{
	$_POST['searchFilter'] = '';
}

$provider   = new Cprovider();
$product    = new Cproduct();
$auxUser    = new Cuser();
$filter	    = '';
$orderby    = '';
$result	    = array();
if($_POST['id'] == 'idProviderAutocomplete' or $_POST['id'] == 'idClientAutocomplete')
{
    if (empty($_POST['term']) == FALSE)
    {
    	$_POST['term'] = trim($_POST['term']);

    	$filter .= $provider->getFieldSql('name').' LIKE '.$provider->getValueSql($_POST['term'], '%%');
    	$orderby .= $provider->getFieldSql('name').' ASC';
    }

    $list = $provider->getList($filter, 0, 0, $orderby, FALSE, FALSE);

    if (is_array($list) === TRUE)
    {
    	foreach($list as $val)
    	{
    	    $obj	= new stdClass();
    	    $obj->id    = $val['id'];
    	    $obj->label = $val['name'];
    	    $obj->value = $val['name'];

    	    $result[]    = $obj;
    	}
    }
}
elseif($_POST['id'] == 'idProductAutocomplete' or $_POST['id'] == 'detail_idProductAutocomplete')
{
    $showProvider   = FALSE;
    $aux	    = '';
    if (empty($_POST['term']) == FALSE)
    {
    	$filter .= $aux.'('.$product->getFieldSql('id', $product->getTableName()).' LIKE '.$product->getValueSql($_POST['term'], '%').' OR '.$product->getFieldSql('name', $product->getTableName()).' LIKE '.$product->getValueSql($_POST['term'], '%%').' OR '.$provider->getFieldSql('name', $provider->getTableName()).' LIKE '.$product->getValueSql($_POST['term'], '%%').' OR '.$product->getFieldSql('code', $product->getTableName()).' LIKE '.$product->getValueSql($_POST['term'], '%%').')';
    	$aux = ' AND ';
    }

    //Filtro por los Proveedores si hay uno elegido
    if(empty($_POST['idProvider']) == FALSE)
    {
    	$filter .= $aux.$product->getFieldSql('id_provider').' = '.$product->getValueSql($_POST['idProvider']);
    	$aux = ' AND ';
    }
    else
    {
	   $showProvider = TRUE;
    }

    if (empty($_POST['searchFilter']) == FALSE and $_POST['searchFilter'] == 'productStatusExhibited')
    {
    	$filter .= $aux.$product->getFieldSql('status').' IN ('.$product->getValueSql('exhibited').', '.$product->getValueSql('give_back').')';
    	$aux = ' AND ';
    }


    $list = $product->getList($filter, 0, 0, 'id', FALSE, TRUE);

    if (is_array($list) === TRUE)
    {
    	foreach($list as $val)
    	{
    	    $auxProvider    = '';
    	    $auxCode	    = '';
    	    if($showProvider == TRUE)
    	    {
        		$provider->setId($val['idProvider']);
        		if($provider->getData() == TRUE)
        		{
        		    $auxProvider = ' ('.$provider->getName(FALSE).')';
        		}
    	    }
    	    if(empty($val['code']) == FALSE)
    	    {
    		  $auxCode = ' - '.$val['code'];
    	    }

    	    $obj	= new stdClass();
    	    $obj->id    = $val['id'];
    	    $obj->label = '#'.$val['id'].$auxCode.' - '.$val['name'].$auxProvider;
    	    $obj->value = '#'.$val['id'].$auxCode.' - '.$val['name'].$auxProvider;

    	    $result[]    = $obj;
    	}
    }
}
elseif($_POST['id'] == 'idUserAddAutocomplete')
{
    if (empty($_POST['term']) == FALSE)
    {
    	$_POST['term'] = trim($_POST['term']);

    	/*$filter .= $auxUser->getFieldSql('lastname').' LIKE '.$auxUser->getValueSql($_POST['term'], '%%');
    	$orderby .= $auxUser->getFieldSql('lastname').' ASC';*/

    	$filter .= $auxUser->getFieldSql('lastname', $auxUser->getTableName()).' LIKE '.$auxUser->getValueSql($_POST['term'], '%%').' OR '.$auxUser->getFieldSql('name', $auxUser->getTableName()).' LIKE '.$auxUser->getValueSql($_POST['term'], '%%');

    	//Para evitar este order by podría hacer esto SELECT id, firstname, lastname, MATCH(firstname, lastname) AGAINST ('acevedo jose' IN NATURAL LANGUAGE MODE) AS relevancia FROM `mdl_user` WHERE 1 ORDER BY relevancia DESC pero hay que definir un indice fulltext para la convinación de campos
    	$orderby .= 'Length('.$auxUser->getFieldSql('lastname', $auxUser->getTableName()).') - Length(Replace('.$auxUser->getFieldSql('lastname', $auxUser->getTableName()).', "'.$_POST['term'].'", "")) + Length('.$auxUser->getFieldSql('name', $auxUser->getTableName()).') - Length(Replace('.$auxUser->getFieldSql('name', $auxUser->getTableName()).', "'.$_POST['term'].'", ""))';
    }

    $list = $auxUser->getList($filter, 0, 0, $orderby, FALSE, FALSE);

    if (is_array($list) === TRUE)
    {
    	foreach($list as $val)
    	{
    	    $obj	    = new stdClass();
    	    $obj->id    = $val['id'];
    	    $obj->label = $val['lastname'].' '.$val['name'];
    	    $obj->value = $val['lastname'].' '.$val['name'];

    	    $result[]    = $obj;
    	}
    }
}

//Resultado
echo json_encode($result);
?>