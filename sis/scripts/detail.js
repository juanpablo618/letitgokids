/**
 * Archivo de funciones JavaScript para el manejo de relaciones
 *
 * @package EVOIT
 * @author {@link http://www.evoit.com/ EVO I.T.}
 * @copyright {@link http://www.evoit.com/ EVO I.T.}
 * @version v4.2:24-08-2015
 */

/**
 * Agrega un ítem al detalle
 *
 * @param string fileControl url del archivo que realiza las validaciones correspondientes
 * @param string table tabla del detalle
 * @param array fields contiene los campos que forman parte del detalle
 * @param string uniqueID nombre de la variable de session que tiene lo datos
 * @param strring callback nombre del la función a la que quiero llamar luego de terminar el ajax
 * @param Arary args Array con los argumentos
 */
function addItem(fileControl, table, fields, uniqueID, callback, args)
{     
    //Para copmpatibilidad con los que no lo traen
    if (typeof uniqueID == 'undefined') 
    {
		uniqueID = '';
	}
	
	if (typeof callback == 'undefined') 
    {
		callback = '';
	}
	
	if (typeof args == 'undefined') 
    {
		args = [];
    }

	//acción
    var values = 'action=addItem&uniqueID='+uniqueID;

    var amount = fields.length;
	
    for (i = 0; i < amount; i++)
    {       
		//concateno los valores de los campos para pasarlos al archivo de control mediante AJAX
        values+= '&' + fields[i] + '=' + encodeURIComponent( $('#' + table + '_' + fields[i]).val());
    }
    
    //boton agregar
    var objAddBtn = $('#' + table + '_addButton');
    
    //contenedor de la tabla del detalle
    var objDetail = $('#' + table + '_detail');

    $.ajax({
	    type: 'POST',
	    url: fileControl,
	    data: values,
	    dataType: 'html',
	    beforeSend: function () {
		    objAddBtn.attr('disabled', true);            
	    },
	    complete: function (jqXHR, textStatus) {            
			//los dos primeros caracteres de la respuesta son de control (OK: sin errores, KO: con errores)
			var result = jqXHR.responseText.substr(0, 2);
			var response = jqXHR.responseText.substr(2);

			objDetail.html(response);
			objAddBtn.attr('disabled', false);

			if(callback != "")
			{
				window[callback](args);
			}
		}
    });
}

function sumAllFields(args)
{
	var amount = 0;
	$( args[0] ).each(function( index ) {
		console.log( index + ": " + $( this ).val() );
		amount += Number($( this ).val());
	});

	$( args[1] ).each(function( index ) {
		console.log( index + ": " + $( this ).val() );
		amount -= Number($( this ).val());
	});
	$( args[2] ).html(amount);
}

/**
 * Carga los campos para modificar un ítem del detalle
 *
 * @param string table tabla del detalle
 * @param string index ID del item a modificar
 * @param array fields contiene los campos que forman parte del detalle
 */
function updateItemForm(table, index, fields)
{
    $('#' + table + '_addButton').hide();
    
    var amount = fields.length;
    
    for (i = 0; i < amount; i++)
    {
		$('#' + table + '_' + fields[i]).val($('#' + table + '_' + fields[i] + '_' + index).val());
		
		if($('#' + table + '_' + fields[i] + 'Autocomplete').length > 0)
		{
			setProductName('#' + table + '_' + fields[i]);
		}
    }

    $('html, body').animate({scrollTop: $('.fields.' + table).offset().top}, 'fast');
        
    $('#' + table + '_updateIndex').val(index);
    $('#' + table + '_updateButton').show();
	$('#' + table + '_cancelButton').show();
}

/**
 * Cancela los campos para modificar un ítem del detalle
 *
 * @param string table tabla del detalle 
 * @param array fields contiene los campos que forman parte del detalle
 */
function cancelItemForm(table, fields)
{    
    $('#' + table + '_updateIndex').val('');
    $('#' + table + '_updateButton').hide();
    $('#' + table + '_cancelButton').hide();    
    
    cleanForm(table, fields);
    
    $('#' + table + '_addButton').show();
}

/**
 * Modifica un ítem del detalle
 *
 * @param string fileControl url del archivo que realiza las validaciones correspondientes
 * @param string table tabla del detalle
 * @param array fields contiene los campos que forman parte del detalle
 * @param string uniqueID nombre de la variable de session que tiene lo datos
 */
function updateItem(fileControl, table, fields, uniqueID, callback, args)
{     
    //Para copmpatibilidad con los que no lo traen
    if (typeof uniqueID == 'undefined') 
    {
		uniqueID = '';
	}
	
	if (typeof callback == 'undefined') 
    {
		callback = '';
	}
	
	if (typeof args == 'undefined') 
    {
		args = [];
    }
	//input con el indice del array de la sesión
	var objIndex = $('#' + table + '_updateIndex');   
    
    //acción
    var values = 'action=updateItem&index=' + objIndex.val() + '&uniqueID='+uniqueID;

    var amount = fields.length;
	
    for (i = 0; i < amount; i++)
    {       
		//concateno los valores de los campos para pasarlos al archivo de control mediante AJAX
        values+= '&' + fields[i] + '=' + encodeURIComponent($('#' + table + '_' + fields[i]).val());
    }
    
    //boton modificar
    var objUpdateBtn = $('#' + table + '_updateButton');
    //contenedor de la tabla del detalle
    var objDetail = $('#' + table + '_detail');
    //boton agregar
    var objAddBtn = $('#' + table + '_addButton');
    //boton cancelar
    var objCancelBtn = $('#' + table + '_cancelButton');

    $.ajax({
	    type: 'POST',
	    url: fileControl,
	    data: values,
	    dataType: 'html',
	    beforeSend: function () {
		    objUpdateBtn.attr('disabled', true);
	    },
	    complete: function (jqXHR, textStatus) {			
			//los dos primeros caracteres de la respuesta son de control (OK: sin errores, KO: con errores)
			var result = jqXHR.responseText.substr(0, 2);
			var response = jqXHR.responseText.substr(2);

			if (result == 'OK')
			{                
				objUpdateBtn.hide();
				objCancelBtn.hide();
				objIndex.val('');
				objAddBtn.show();
			}

			objDetail.html(response);
			objUpdateBtn.attr('disabled', false);

			if(callback != "")
			{
				window[callback](args);
			}
	    }
    });
}

/**
 * Elimina un ítem del detalle
 *
 * @param string fileControl url del archivo que realiza las validaciones correspondientes
 * @param string table tabla del detalle
 * @param string index ID del item a borrar
 */
function delItem(fileControl, table, index, uniqueID, callback, args)
{
    //Para copmpatibilidad con los que no lo traen
    if (typeof uniqueID == 'undefined') 
    {
		uniqueID = '';
	}
	
	if (typeof callback == 'undefined') 
    {
		callback = '';
	}
	
	if (typeof args == 'undefined') 
    {
		args = [];
    }
    
    //contenedor de la tabla del detalle
    var objDetail = $('#' + table + '_detail');	
    
    $.ajax({
	type: 'POST',
	url: fileControl,
	data: 'action=delItem&index=' + index + '&uniqueID='+uniqueID,
	dataType: 'html',
	beforeSend: function () {
	},
	complete: function (jqXHR, textStatus) {

			//los dos primeros caracteres de la respuesta son de control (OK: sin errores, KO: con errores)
			var result = jqXHR.responseText.substr(0, 2);
			var response = jqXHR.responseText.substr(2);
			
			objDetail.html(response);

			if(callback != "")
			{
				window[callback](args);
			}
		}
	});
}

/**
 * Limpia los elementos de formulario que agregan los ítems del detalle
 *
 * @param string table tabla del detalle
 * @param array fields contiene los campos que forman parte del detalle
 */
function cleanForm(table, fields)
{   
    var amount = fields.length;
    
    for (i = 0; i < amount; i++)
    {       
        //objeto campo (cada campo del formulario)
    	$('#' + table + '_' + fields[i]).val('');
	
	var objAutocomplete = $('#' + table + '_' + fields[i] + 'Autocomplete');
	if(objAutocomplete.length > 0)
	{
	    objAutocomplete.val('');;
	}
    }
}

/**
 * Pone el dato elegido en el autocomplete
 */
function setProductName(field)
{   
    params = {idProduct: $(field).val(), field: 'name'};
	    
    $.ajax({
	type: 'POST',
	url: 'productData.php',
	data: params,
	dataType: 'html',
	complete: function (jqXHR, textStatus) {            
	    //los dos primeros caracteres de la respuesta son de control (OK: sin errores, KO: con errores)
	    var result = jqXHR.responseText.substr(0, 2);
	    var response = jqXHR.responseText.substr(2);

	    if(result == 'OK')
	    {
		$('#detail_idProductAutocomplete').val(response);
	    }
	}
    });
}