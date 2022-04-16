/**
 * Archivo de funciones JavaScript generales
 *
 * @package EVOIT
 * @author {@link http://www.evoit.com/ EVO I.T.}
 * @copyright {@link http://www.evoit.com/ EVO I.T.}
 * @version v4.2:04-09-2015
 */


/**
 * Función para abrir el calendar en los campos de fechas
 *
 * @param string input Id del campo
 * @param string btn Id del botón
 * @param string format Formato de la fecha
 */
function showCalendar(input, btn, format)
{
    $(input).datepicker({
        showOtherMonths: true,
        selectOtherMonths: true,
        changeMonth: true,
        changeYear: true,
        dateFormat: format,
        gotoCurrent: true
    });
    $(btn).on('click', function () {
        $(input).datepicker('show');
        //$(input).datepicker('dialog');
        return false;
    });
}

/**
 * Función para mostrar y ocultar el formulario de búsqueda
 *
 * Esta función se utiliza para mostrar u ocultar el formulario de búsqueda y setear una variable de $_SESSION
 * mediante AJAX para mantener el estado del formulario (abierto o cerrado)
 *
 * @param object id_ob Id del objeto que se quiere ocultar o mostrar
 */
function showHideSearch(id_ob)
{
	var ob_layer = $('#container_search_' + id_ob);
	var ob_btn   = $('#btn_search_' + id_ob);

	if (ob_layer.is(":hidden"))
	{
		ob_layer.slideDown('normal');

		ob_btn.attr('class', 'btn_search_open');

		$.ajax({
			type: 'GET',
			url: 'btnsearch.php',
			data: 's=' + id_ob + '&v=open'});
	}
	else
	{
		ob_layer.slideUp('normal');

		ob_btn.attr('class', 'btn_search_closed');

		$.ajax({
			type: 'GET',
			url: 'btnsearch.php',
			data: 's=' + id_ob + '&v=closed'});
	}
}

/**
 * Función para cambiar el estilo de las filas de una consulta cuando son cliqueadas
 *
 * Estas funciones se utilizan para cambiar el estilo (CSS) de las filas de una tabla
 * que se crea llamando al método showQuery()
 *
 * @param object row DIV de la fila
 */
function rowClick(row)
{
    var table = row.attr('data-table-name');
    var id = row.attr('data-id');
    var form = row.attr('data-form-id');
    var checkbox = $('#cb_' + table + '_' + id);

    if (row.hasClass('click'))
    {
        row.removeClass('click');

        if (checkbox.val())
        {
            checkbox.prop('checked', false);
        }
    }
    else
    {
        row.addClass('click');

        if (checkbox.val())
        {
            checkbox.prop('checked', true);
        }
    }

    checkedSelectAll(form, table + '_select_all');
}

/**
 * Función para cambiar el estilo de las filas de una consulta cuando son cliqueadas
 *
 * Estas funciones se utilizan para cambiar el estilo (CSS) de las filas de una tabla
 * que se crea llamando al método showAttendanceTable()
 *
 * @param object row DIV de la fila
 */
function rowClick2(row)
{
    var table = row.attr('data-table-name');
    var id  = row.attr('data-id');
    var div = row.attr('data-form-id');
    var checkbox = $('#cb_' + table + '_' + id);

    if (row.hasClass('click'))
    {
        row.removeClass('click');

        if (checkbox.val())
        {
            checkbox.prop('checked', false);
        }
    }
    else
    {
        row.addClass('click');

        if (checkbox.val())
        {
            checkbox.prop('checked', true);
        }
    }

    //checkbox.trigger( "change" );
    if(table == 'product_back')
    {
    	updateControlBack();
    }
    if(table == 'product_pay')
    {
    	updateControlPay();
    }

    checkedSelectAll2(div, table + '_select_all');
}

/**
 * Esta función la utilizo para que el click del checkbox no interfiera con el click de la fila
 *
 * @param object _obj objeto checkbox
 */
function checkboxClick(_obj)
{
	_obj.checked = ! _obj.checked;
}

/**
 * Función para seleccionar o deseleccionar el checkbox de seleccion grupal
 *
 * Esta función se utiliza para seleccionar o deseleccionar el checkbox de selección grupal cuando se seleccionan
 * todos los checkbox de una consulta o se deselecciona al menos uno.
 *
 * @param string _form id del formulario que contiene los checkbox
 * @param string _checkbox id del checkbox que se utiliza para seleccionar todos los otros
 */
function checkedSelectAll(_form, _checkbox)
{
	var ob_form = $('#' + _form);
	var ob_chkb = $('#' + _checkbox);

	cantidad = ob_form.get(0).elements.length;
	checked_all = true;

	for (i = 0; i < cantidad; i++)
	{
		if (ob_form.get(0).elements[i].type == 'checkbox')
		{
			if (ob_form.get(0).elements[i].value)
			{
				if (!ob_form.get(0).elements[i].checked)
				{
					checked_all = false;
				}
			}
		}
	}

	ob_chkb.prop('checked', checked_all);
}

/**
 * Función para seleccionar o deseleccionar el checkbox de seleccion grupal
 *
 * Esta función se utiliza para seleccionar o deseleccionar el checkbox de selección grupal cuando se seleccionan
 * todos los checkbox de una consulta o se deselecciona al menos uno.
 *
 * @param string _form id del formulario que contiene los checkbox
 * @param string _checkbox id del checkbox que se utiliza para seleccionar todos los otros
 */
function checkedSelectAll2(_div, _checkbox)
{
    var ob_div = $('#' + _div + ' input:checkbox');
    var ob_chkb = $('#' + _checkbox);

    cantidad = ob_div.length;
    checked_all = true;

    for (i = 0; i < cantidad; i++)
    {
	if (ob_div[i].type == 'checkbox')
	{
	    if (ob_div[i].value)
	    {
		if (!ob_div[i].checked)
		{
		    checked_all = false;
		}
	    }
	}
    }

    ob_chkb.prop('checked', checked_all);
}

/**
 * Función para seleccionar o deseleccionar todos los checkbox de un formulario
 *
 * Esta función se utiliza para seleccionar o deseleccionar todos los checkbox de las filas de una tabla
 * que se crea llamando al método showQuery()
 *
 * @param string _table Tabla de la clase
 * @param string _form ID del formulario que contiene los checkbox
 */
function querySelectAll(_table, _form)
{
	var ob_form = $('#' + _form);
	var ob_chkb = $('#' + _table + '_select_all');

	cantidad = ob_form.get(0).elements.length;

    $('#' + _form + ' input[type=checkbox]').each(function( index ) {

        var row = $('#' + _table + '_tr_' + $(this).val());

        if (ob_chkb.is(':checked'))
        {
            row.addClass('click');
            $(this).prop('checked', true);
        }
        else
        {
            row.removeClass('click');
            $(this).prop('checked', false);
        }
    });
}

/**
 * Función para seleccionar o deseleccionar todos los checkbox de un div
 *
 * Esta función se utiliza para seleccionar o deseleccionar todos los checkbox de las filas de una tabla
 * que se crea llamando al método showAttendanceTable().
 *
 * NOTA: No uso la función querySelectAll() porque utiliza un form y como debo meter la tabla dentro de otro form da conflicto tener un form dentro de otro form.
 *
 * @param string _table Tabla de la clase
 * @param string _div ID del div que contiene los checkbox
 */
function querySelectAll2(_table, _div)
{
    var ob_div = $('#' + _div + ' input:checkbox');
    var ob_chkb = $('#' + _table + '_select_all');

    $('#' + _div + ' input[type=checkbox]').each(function( index ) {

        var row = $('#' + _table + '_tr_' + $(this).val());

	rowClick2(row);
    });
}

/**
 * Función para realizar las acciones de los listados (botones)
 *
 * @param string url URL de la acción
 * @param boolean confirmation indica si la acción necesita confirmación antes de ser realizada
 * @param string msg mensaje de la confirmación
 */
function queryAction(url, confirmation, msg)
{
    if (confirmation)
	{
		if (confirm(msg))
		{
			location.href = url;
		}
	}
	else
	{
		location.href = url;
	}
}

/**
 * Función para realizar el submit del formulario de las acciones grupales
 *
 * Esta función se utiliza para realizar el submit del formulario para realizar las acciones grupales
 * que se crean llamando al método show_query()
 *
 * @param string _form id del formulario
 * @param string _action archivo al que redirecciona el formulario
 * @param string _params parámetros que se envían
 * @param boolean _confirm indica si la acción necesita confirmación antes de ser realizada
 * @param string _msg mensaje de la confirmación
 */
function formQuerySubmit(_form, _action, _params, _confirm, _msg)
{
    var ob_form = $('#' + _form);

	ob_form.attr('action', _action);
	ob_form.get(0).p.value = _params;

	if (_confirm)
	{
		if (confirm(_msg))
		{
			ob_form.submit();
		}
	}
	else
	{
		ob_form.submit();
	}
}

/**
 * Corta cadenas de caracteres y les agrega un "title"
 *
 * Esta función se utiliza para cortar cadenas de caracteres muy largas.
 * Es muy común usarla cuando se muestran los resultados de una consulta en forma tabulada.
 *
 * @param string string cadena de caracteres que se corta
 * @param string lenght largo con el que queda la cadena
 * @param string last_string [opcional] caracteres que se muestran al final de la cadena si la misma es cortada
 */
function getCutString(string, length, last_string)
{
	length = parseInt(length);

	var aux = '';

	var myString = string;

	var myLastString = last_string;

	if (myString.length <= length || length == 0)
	{
		aux = myString;
	}
	else
	{
		if (myString.length < myLastString.length + length)
		{
			aux = myString;
		}
		else
		{
			aux = myString.substr(0 , length) + myLastString;
		}
	}

	return '<span title="' + htmlentities(myString) + '">' + aux + '</span>';
}

/**
 * Función para evitar el submit de un formulario cuando se presiona Enter en alguno de sus campos
 *
 * @param event e Evento
 */
function noSubmit(e)
{
	var keynum;

	if (window.event) // IE
	{
		keynum = e.keyCode;
	}
	else if (e.which) // Netscape/Firefox/Opera
	{
		keynum = e.which;
	}

	if (keynum == 13)
	{
		return false;
	}
}

/**
 * Función para transformar caracteres en sus entidades HTML correspondientes
 *
 * @param string str cadena de caracteres a transformar
 */
function htmlentities(str)
{
	return str.replace(/"/g, '&quot;');
}

/**
 * Función para darle el foco a un elemento determinado
 *
 * @param string id identificador del elemento
 */
function setFocus(id)
{
	var ob_form = $('#' + id);
	ob_form.get(0).focus();
}
/**
 * Genera un password
 *
 */
function generatePassword(id)
{
    var specials = '!@#$%^&*()_+{}:<>?\|[];,.~';
    var lowercase = 'abcdefghijklmnopqrstuvwxyz';
    var uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    var numbers = '0123456789';

    var all = specials + lowercase + uppercase + numbers;

    String.prototype.pick = function(min, max) {
	var n, chars = '';

	if (typeof max === 'undefined') {
	    n = min;
	} else {
	    n = min + Math.floor(Math.random() * (max - min));
	}

	for (var i = 0; i < n; i++) {
	    chars += this.charAt(Math.floor(Math.random() * this.length));
	}

	return chars;
    };


    // Credit to @Christoph: http://stackoverflow.com/a/962890/464744
    String.prototype.shuffle = function() {
	var array = this.split('');
	var tmp, current, top = array.length;

	if (top) while (--top) {
	    current = Math.floor(Math.random() * (top + 1));
	    tmp = array[current];
	    array[current] = array[top];
	    array[top] = tmp;
	}

	return array.join('');
    };

    password = (specials.pick(1) + lowercase.pick(1) + uppercase.pick(1) + all.pick(3, 10)).shuffle();

    $('#' + id).val(password);

}

/**
 * Esta función actualiza un contenedor en base al elemento seleccionado en un combobox
 *
 * @param object params Son los parámetros que quiero enviar a un archivo. El formato es obj = {id: 1, name: "Federico"}
 * @param string target Es el el componente que se va a actualizar con la información que devuelva el fieldToLoad.
 * @param string fileToLoad Es el archivo con el PHP que devolverá lo que se debe cargar.
 *
 */
function updateContent(params, target, fileToLoad, noAnimation)
{
    //Define si se hace o no la animación luego de llenarse el componente
    noAnimation = noAnimation || false;

    //Armo el string de parámetros en base a objeto params
    stringParams    = '';
    aux		    = '';
    for (var key in params)
    {
	if (params.hasOwnProperty(key))
	{
	    if(params[key])
	    {
		value = params[key];
	    }
	    else
	    {
		value = '';
	    }

	    stringParams = stringParams + aux + key + '=' + value;

	    aux = '&';
	}
    }

    $.ajax({
	type: 'POST',
	url: fileToLoad,
	data: stringParams,
	dataType: 'html',
	success: function (data) {
	    if(noAnimation == false)
	    {
	    	$('#'+target).html(data).hide().slideDown('slow');
	    }
	    else
	    {
	    	$('#'+target).html(data);
	    }

	    updateControlPay();
	    updateControlBack()
	},
	beforeSend: function () {
	    if(noAnimation == false)
	    {
	    	$('#'+target).html('<div class="message warning">Cargando, espere por favor...</div>').hide().slideDown('fast');
	    }
	    else
	    {
	    	$('#'+target).html('<div class="message warning">Cargando, espere por favor...</div>');
	    }
	}
     });

    return true;
}
function updateControlBack()
{
	if ($("#formQueryProductBack").length > 0)
	{
	    var amountToBack = 0;
	    $( "#formQueryProductBack .productBack" ).each(function( index ){
			if($( this ).is(":checked"))
			{
			    amountToBack++;
			}
	    });

	    $("#productToBackControl").text(amountToBack);
	}
}
function updateControlPay()
{
	if ($("#formQueryProductBack").length > 0)
	{
	    var amountToCach	= 0;
	    var amountToCteCte	= 0;
	    var amountTotal		= 0;
	    $( "#formQueryProductPay .productPay" ).each(function( index ){
			if($( this ).is(":checked"))
			{
			    amountTotal = amountTotal + parseFloat($( "#amount_" +  $( this ).val()).val());
			}
	    });

	    if(amountTotal > 0)
	    {
			amountToCach = amountTotal * parseFloat($("#cash_commission").val());
			amountToCteCte = amountTotal * parseFloat($("#current_account_commission").val());
	    }

	    $("#productToPayControlCash").text(amountToCach.toFixed(2));
	    $("#productToPayControlCtaCte").text(amountToCteCte.toFixed(2));

	    $("#total_cash").val(amountToCach.toFixed(2));
	    $("#total_cta_cte").val(amountToCteCte.toFixed(2));
	}
}