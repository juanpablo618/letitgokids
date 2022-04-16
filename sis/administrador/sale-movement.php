<?php
require_once ('connect.php');

require_once ('../include/Cmovement.php');

if (isset($_POST['action']) === FALSE)
{
    $_POST['action'] = '';
}
if (isset($_POST['uniqueID']) === FALSE)
{
    $_POST['uniqueID'] = '';
}

$movement = new Cmovement();
$movement->controlFormDetail($_POST['action'], 'sale-movement.php', TRUE, $_POST['uniqueID']);
?>