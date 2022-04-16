<?php
require_once ('connect.php');
require_once ('../include/Cprovider.php');
require_once ('../include/Cproduct.php');
require_once ('../include/Ccategory.php');
require_once ('../include/Cmovement.php');
require_once ('../include/Cpayment.php');
require_once ('../include/Crefund.php');
require_once ('../include/Cnavigator.php');
require_once ('../include/Cdate.php');

doctype();
?>
<html>
<head>
	<?php head(); ?>

	<script>
      $( function() {
        $( "#tabs" ).tabs();
      } );
	</script>
</head>
<body>
<?php
open();
?>

<h1 class="show">Mi estado</h1>

<?php
if(empty($_GET['orderby']) == TRUE)
{
    $_GET['orderby'] = 'status';
    $_GET['ascdesc'] = 'ASC';
}

$auxUser = new Cuser($dbConn);
$auxUser->setId($_SESSION['userId'], TRUE);

if($auxUser->getData() == FALSE)
{
    exit("No tiene permisos");
}
if(empty($auxUser->getIdProvider(FALSE)) == TRUE)
{
    exit("No tiene permisos");
}

$provider = new Cprovider();

$fields = '';

$provider->setId($auxUser->getIdProvider(FALSE), TRUE);
$provider->getData();
$provider->showData($fields, TRUE, 'main.php', 'Proveedor/cliente');

close();
?>
</body>
</html>