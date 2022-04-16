<?php
require_once ('connect.php');
require_once ('../include/Cdetail.php');
require_once ('../include/Cdetail_payment.php');
require_once ('../include/Cproduct.php');
require_once ('../include/Crefund.php');
require_once ('../include/Cdetail_refund.php');
require_once ('../include/Csale.php');
require_once ('../include/Cdate.php');

if (isset($_POST['action']) === FALSE)
{
    $_POST['action'] = '';
}
if (isset($_POST['uniqueID']) === FALSE)
{
    $_POST['uniqueID'] = '';
}

$detail = new Cdetail();

$i = 0;
$fieldsDetail[$i]['field'] = 'idProduct';
$fieldsDetail[$i]['width'] = '70%';
$fieldsDetail[$i]['strlen'] = '';

$i++;
$fieldsDetail[$i]['field'] = 'amount';
$fieldsDetail[$i]['width'] = '20%';
$fieldsDetail[$i]['strlen'] = '';

$updateAction['image']      = 'img/update-head.png';
$updateAction['image-over'] = 'img/update.png';
$updateAction['image-head'] = '';
$updateAction['class']      = 'update';
$updateAction['title']      = 'Modificar producto';
$updateAction['width']      = '5%';

$delAction['image']         = 'img/delete-head.png';
$delAction['image-over']    = 'img/delete.png';
$delAction['image-head']    = '';
$delAction['class']         = 'del';
$delAction['title']         = 'Eliminar producto';
$delAction['width']         = '5%';

$detail->controlFormDetail($_POST['action'], 'sale-detail.php', $fieldsDetail, $updateAction, $delAction, TRUE, $_POST['uniqueID']);
?>