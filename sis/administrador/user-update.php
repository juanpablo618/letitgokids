<?php
require_once ('connect.php');
require_once ('../include/Cuser.php');
require_once ('../include/Cprovider.php');
require_once ('../include/phpmailer/class.phpmailer.php');

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

<h1 class="update">Modificar usuario</h1>

<?php
if (isset($_GET['id']) === FALSE)
{
	$_GET['id'] = '';
}

$user = new Cuser();

$fields = 'id,name,email,user,pass,idGroup,active,idProvider,sendEmail';
$user->setId($_GET['id'], TRUE);
$user->updateForm($fields, 'user-query.php', FALSE, 'Usuario');

close();
?>
</body>
</html>
