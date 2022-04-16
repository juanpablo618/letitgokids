<?php
require_once ('connect.php');
require_once ('../include/Cprovider.php');
require_once ('../include/Cproduct.php');
require_once ('../include/Ccategory.php');
require_once ('../include/Cmovement.php');
require_once ('../include/Cpayment.php');
require_once ('../include/Crefund.php');
require_once ('../include/Clog.php');
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

<h1 class="show">Ver proveedor/cliente</h1>

<?php
if (isset($_GET['id']) === FALSE)
{
	$_GET['id'] = '';
}

$provider = new Cprovider();

if(empty($_GET['orderby']) == TRUE)
{
    $_GET['orderby'] = 'status';
    $_GET['ascdesc'] = 'ASC';
}

$fields = '';

$provider->setId($_GET['id'], TRUE);
$provider->getData();
$provider->showData($fields, TRUE, 'provider-query.php', 'Proveedor/cliente');

close();
?>
</body>
</html>