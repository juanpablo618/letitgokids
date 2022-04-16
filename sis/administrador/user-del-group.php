<?php
require_once ('connect.php');
require_once ('../include/Cuser.php');
require_once ('../include/Cmovement.php');
require_once ('../include/Cproduct.php');
require_once ('../include/Csale.php');
require_once ('../include/Cprovider.php');
require_once ('../include/Ccategory.php');
require_once ('../include/Cdate.php');

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

<h1 class="del-group">Eliminar user</h1>

<?php
if (isset($_POST['userGroup']) === FALSE)
{
	$_POST['userGroup'] = '';
}

$user = new Cuser();

$user->delGroupForm($_POST['userGroup'], 'user-query.php', FALSE, 'user');

close();
?>
</body>
</html>
