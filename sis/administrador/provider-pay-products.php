<?php
require_once ('connect.php');
require_once ('../include/Cdate.php');
require_once ('../include/Cprovider.php');
require_once ('../include/Cproduct.php');
require_once ('../include/Cmovement.php');
require_once ('../include/Cpayment.php');
require_once ('../include/Cdetail.php');
require_once ('../include/Csale.php');
require_once ('../include/Cdetail_payment.php');

doctype();

if (isset($_GET['id']) === FALSE)
{
    $_GET['id'] = '';
}

$auxParam = '';
if (empty($_GET['id']) == FALSE)
{
    $auxParam = ', idPayment: '.$_GET['id'];
}
if(empty($_POST['productsBackGroup']) == FALSE)
{
    if(is_array($_POST['productsBackGroup']) == TRUE and count($_POST['productsBackGroup']) > 0)
    {
        $auxParam .= ', productsBackGroup: "'.implode(',', $_POST['productsBackGroup']).'"';
    }
    else
    {
        $auxParam .= ', productsBackGroup: "'.$_POST['productsBackGroup'].'"';
    }
}
if(empty($_POST['productsPayGroup']) == FALSE)
{
    if(is_array($_POST['productsPayGroup']) == TRUE and count($_POST['productsPayGroup']) > 0)
    {
        $auxParam .= ', productsPayGroup: "'.implode(',', $_POST['productsPayGroup']).'"';
    }
    else
    {
        $auxParam .= ', productsPayGroup: "'.$_POST['productsPayGroup'].'"';
    }
}
if(empty($_POST['addPayment']) == FALSE)
{
    $auxParam .= ', addPayment: "'.$_POST['addPayment'].'"';
}
if(empty($_POST['type_pay']) == FALSE)
{
    $auxParam .= ', type_pay: "'.$_POST['type_pay'].'"';
}
?>
<html>
<head>
    <?php head(); ?>

    <script type="text/javascript">
    $(document).ready(function(){

    	params = {idProvider: $('#idProvider').val(), productGroup: $('#productGroup').val(), orderHidden: $('#orderHidden').val(), ascDescHidden: $('#ascDescHidden').val() <?php echo $auxParam; ?>};
    	updateContent(params, 'providerProductList', 'provider-products.php', false);

    	$( "#idProvider" ).change(function(){
    	    params = {idProvider: $('#idProvider').val(), productGroup: $('#productGroup').val(), orderHidden: $('#orderHidden').val(), ascDescHidden: $('#ascDescHidden').val() <?php echo $auxParam; ?>};
    	    updateContent(params, 'providerProductList', 'provider-products.php', false);
    	});

    	$('#providerProductList').on('click', '.amountInput', function (e){
    	    e.stopPropagation();
    	});
    	$('#providerProductList').on('change', '.amountInput', function (e){

    	    var target 	= $(e.target);
    	    rowId 	= target.parents(".row").first().attr("id");

    	    //Le saco el click apra que siempre lo maque si lo cambió
    	    $("#" + rowId).removeClass('click');

    	    rowClick2($("#" + rowId));
    	});

    	$('#providerProductList').on('change', '.btnPay', function (e){
    	    $("#type_pay").val($(this).attr('id'));
    	});
    });
    </script>
</head>
<body>
<?php
open();
?>

<h1 class="add">Rendir productos</h1>

<?php
$payment = new Cpayment();
$payment->payProductsForm('payment-query.php', FALSE, 'Productos');
close();
?>
</body>
</html>