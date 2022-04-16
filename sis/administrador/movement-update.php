<?php
require_once ('connect.php');
require_once ('../include/Cmovement.php');
require_once ('../include/Cproduct.php');
require_once ('../include/Ccurrent_account.php');
require_once ('../include/Ccategory.php');
require_once ('../include/Cdate.php');
require_once ('../include/Csale.php');
require_once ('../include/Cprovider.php');

doctype();
?>
<html>
<head>
    <?php head(); ?>
    <script>
    $(document).ready(function() {
	$("#typeMovement").change(function() {


	    $("#wrapperIdClient").hide();
	    $("#wrapperIdProvider").hide();

	    $("#idClientAutocomplete").val("");
	    $("#idClient").val("");

	    $("#idProviderAutocomplete").val("");
	    $("#idProvider").val("");

	    if($(this).val() == 'cta_cte_pay')
	    {
		$("#wrapperIdClient").fadeIn();
	    }
	    else if($(this).val() == 'payment_to_provider')
	    {
		$("#wrapperIdProvider").fadeIn();
	    }
	    else if($(this).val() == 'add_cta_cte' || $(this).val() == 'del_cta_cte')
	    {
			$("#wrapperIdProvider").fadeIn();
	    }
	});
    });
    </script>
</head>
<body>
<?php
open();
?>

<h1 class="update">Modificar movimiento</h1>

<?php
if (isset($_GET['id']) === FALSE)
{
	$_GET['id'] = '';
}

$movement = new Cmovement();

$fields = 'id,dateAdded,amount,typePay,typeMovement,type,idClient,idProvider,description';
$movement->setId($_GET['id'], TRUE);

$movement->updateForm($fields, 'movement-query.php', FALSE, 'Movimiento');

close();
?>
</body>
</html>
