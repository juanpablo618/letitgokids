<?php
require_once ('connect.php');
require_once ('../include/Csale.php');
require_once ('../include/Cdetail.php');
require_once ('../include/Ccurrent_account.php');
require_once ('../include/Cprovider.php');
require_once ('../include/Ccategory.php');
require_once ('../include/Cmovement.php');
require_once ('../include/Cproduct.php');
require_once ('../include/Crefund.php');
require_once ('../include/Cdetail_refund.php');
require_once ('../include/Cdetail_payment.php');
require_once ('../include/Cdate.php');

doctype();
?>
<html>
<head>
    <?php head(); ?>
    <script type="text/javascript" src="../scripts/detail.js"></script>
    <script>
    $(document).ready(function() {
    	$( "#detail_idProduct" ).change(function() {

    	    params = {idProduct: $('#detail_idProduct').val(), field: 'price'};

    	    $.ajax({
    		type: 'POST',
    		url: 'productData.php',
    		data: params,
    		dataType: 'html',
    		complete: function (jqXHR, textStatus){
    		    //los dos primeros caracteres de la respuesta son de control (OK: sin errores, KO: con errores)
    		    var result = jqXHR.responseText.substr(0, 2);
    		    var response = jqXHR.responseText.substr(2);

    		    if(result == 'OK')
    		    {
    				$('#detail_amount').val(response);
    		    }
    		}
    	    });
    	});

    	$( "#idClient" ).change(function() {

    	    params = {idClient: $('#idClient').val()};

    	    $.ajax({
    		type: 'POST',
    		url: 'clientCtaCte.php',
    		data: params,
    		dataType: 'html',
    		complete: function (jqXHR, textStatus){
    		    //los dos primeros caracteres de la respuesta son de control (OK: sin errores, KO: con errores)
    		    var result = jqXHR.responseText.substr(0, 2);
    		    var response = jqXHR.responseText.substr(2);

    		    if(result == 'OK')
    		    {
    				$('#ctaCteClient').html(response).fadeIn();
    		    }
    		    else
    		    {
    				$('#ctaCteClient').html("").fadeOut();
    		    }
    		}
    	    });
		});
    });
    </script>
</head>
<body>
<?php
open();
?>

<h1 class="add">Agregar venta</h1>

<?php
$sale = new Csale();

$fields = 'id,dateAdded,idClient,casualCustomer';

$i = 0;
$fieldsDetail[$i]['field']  = 'idProduct';
$fieldsDetail[$i]['width']  = '70%';
$fieldsDetail[$i]['strlen'] = '';

$i++;
$fieldsDetail[$i]['field']  = 'amount';
$fieldsDetail[$i]['width']  = '20%';
$fieldsDetail[$i]['strlen'] = '';

$updateAction['image']      = 'img/update-head.png';
$updateAction['image-over'] = 'img/update.png';
$updateAction['image-head'] = '';
$updateAction['class']      = 'update';
$updateAction['title']      = 'Modificar producto';
$updateAction['width']      = '5%';

$delAction['image']         = 'img/delete-head.png';
$delAction['image-over']    = 'img/delete.png';
$delAction['image-head']    = '';
$delAction['class']         = 'del';
$delAction['title']         = 'Eliminar producto';
$delAction['width']         = '5%';

$configDetail['detail']['control_file'] = 'sale-detail.php';
$configDetail['detail']['fields']       = $fieldsDetail;
$configDetail['detail']['update']       = $updateAction;
$configDetail['detail']['delete']       = $delAction;
$configDetail['detail']['title']        = 'Productos de la venta';

$sale->addForm($fields, 'sale-query.php', FALSE, 'Venta', $configDetail);

close();
?>
</body>
</html>
