<?php
require_once ('connect.php');
require_once ('../include/Cprovider.php');

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

<h1>Perfil</h1>

<?php
$user->setId($_SESSION['userId']);
$user->updateProfileForm('main.php', FALSE, '');

close();
?>
</body>
</html>