<?php
require_once ('connect.php');

if (isset($_GET['s']) === FALSE)
{
	$_GET['s'] = '';
}
if (isset($_GET['v']) === FALSE)
{
	$_GET['v'] = '';
}

$_SESSION['main_tr_search_'.$_GET['s']] = $_GET['v'];
?>