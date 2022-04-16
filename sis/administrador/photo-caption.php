<?php
require_once ('connect.php');

if (isset($_GET['id']) === FALSE)   $_GET['id'] = '';
if (isset($_GET['c']) === FALSE)    $_GET['c']  = '';

if (get_magic_quotes_gpc())
{
	$_GET['c'] = stripslashes($_GET['c']);
}

$_SESSION[$_GET['id']] = $_GET['c'];
?>