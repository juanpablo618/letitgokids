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

<h1 class="add">Agregar usuario</h1>

<?php
$user = new Cuser();

if(empty($_GET['idLastProvider']) == FALSE)
{
    $provider = new Cprovider();
    $provider->setId($_GET['idLastProvider'], TRUE);
    if($provider->getData() == TRUE)
    {
    	$user->setIdProvider($provider->getId(FALSE));
    	$user->setName($provider->getName(FALSE));
    	$user->setEmail($provider->getEmail(FALSE));
    	$user->setUser($provider->getEmail(FALSE));
    	$user->setIdGroup(2);
    	$user->setActive('yes');
    }
}

$fields = 'id,name,email,user,pass,idGroup,active,idProvider,sendEmail';
$user->addForm($fields, 'user-query.php', FALSE, 'Usuario');

close();
?>
</body>
</html>
