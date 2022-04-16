/**
 * Archivo js creado por EVO I.T.
 *
 * Este archivo contiene funciones para el funcionamiento de la clase Cphoto.php
 *
 * @package EVOIT
 * @author {@link http://www.evoit.com/ EVO I.T.}
 * @copyright {@link http://www.evoit.com/ EVO I.T.}
 * @version v4.1:30-12-2014
 */


/**
 * Esta función se utiliza para abrir la foto con el Dialog Widget de jQuery UI
 *
 * @param string url Url de la foto
 * @param integer width Ancho de la foto
 * @param integer height Alto de la foto
 */
function openPhotoDialog(url, width, height)
{
    var limitWidth  = $(parent.window).width();
    var limitHeight = $(parent.window).height();
    
    var photoWidth  = width + 20;
    var photoHeight = height + 50;
    
    if (photoWidth > limitWidth)
    {
        photoWidth = limitWidth - 20;
    }    
    if (photoHeight > limitHeight)
    {
        photoHeight = limitHeight - 20;
    }
    
    parent.$('#photoDialogImg').prop('src', url);        
    parent.$('#photoDialog').dialog('option', 'width', photoWidth);
    parent.$('#photoDialog').dialog('option', 'height', photoHeight);
    parent.$('#photoDialog').dialog('open');
        
    return false;
}

/**
 * Función para marcar la foto principal
 *
 * Esta función se utiliza para marcar el componente checkbox de la foto principal en el formulario
 * del método addPhotoForm()
 *
 */
function checkedMain()
{   
	var objMain = $('#tempMain', parent.document);
    
	amount = document.photoForm.elements.length;

	for (i = 0; i < amount; i++)
	{
		if (document.photoForm.elements[i].type == 'radio')
		{
			if (document.photoForm.elements[i].value == objMain.val())
			{
				document.photoForm.elements[i].checked = true;
			}
		}
	}
}

/**
 * Función para actualizar la foto principal en el formulario principal
 *
 * Esta función se utiliza para actualizar en el formulario principal, cual es la foto principal seleccionada.
 * El formulario principal sería el formulario del método addForm o updateForm de la clase que implementa a Cphoto.php
 *
 * @param string value foto seleccionada
 */
function updateMain(value)
{
	var objMain = $('#tempMain', parent.document);
    
	objMain.val(value);
}

/**
 * Función que realiza el submit del formulario para agregar una foto
 *
 */
function addPhotoSubmit()
{
	var objBtn = $('#btnAddPhoto');
	objBtn.attr('disabled', true);
	objBtn.val('Cargando...');

	$('#photoForm').submit();
}

/**
 * Abre en un popup el formulario para realizar el crop de los thumbs
 *
 * @param string location url del archivo donde se implementa el crop form
 */
function openCropPhotoForm(location)
{
	popup = window.open(location, 'cropForm', 'toolbar=0,location=0,directories=0,menubar=0,scrollbars=0,resizable=0,width=700,height=570,channelmode=0,fullscreen=0,status=0,titlebar=0');
}

/**
 * Esta función actualiza el thumb después de que se utiliza la herramienta crop
 *
 * @param string img nombre de la imagen que se está procesando
 * @param string urlNewImg url de la imagen procesada (src)
 */
function refreshCropThumb(img, urlNewImg)
{
	var imagen = window.opener.document.getElementById(img);
	imagen.src = urlNewImg;
}

/**
 * Esta función se utiliza para indicar que foto se agrega con el script TinyMCE
 *
 * @param string u Url de la foto
 * @param string tfk Tabla FK
 * @param string n Nombre de la foto
 */
function addPhotoTinyMCE(u, tfk, n)
{
	var objSrc = $('#src', parent.document);
	objSrc.val(u);

	var objTableFk = $('#tableFk', parent.document);
	objTableFk.val(tfk);

	var objName = $('#photo_name', parent.document);
	var p = objName.val();
	objName.val(n);

	selectPhotoTinyMCE('cont_' + n, p);
}

/**
 * Esta función se utiliza para marcar la foto que se selecciona del listado que se muestra con el script TinyMCE
 *
 * @param string id identificador del contenedor de la foto
 * @param string prev contenedor de la foto seleccionada anteriormente
 */
function selectPhotoTinyMCE(id, prev)
{
	if (prev != '')
	{
		var objPrev = document.getElementById('cont_' + prev);
		objPrev.className = 'tinymce_photo';
	}

	var objPhoto = document.getElementById(id);
	objPhoto.className = 'tinymce_photo_selected';
}

/**
 * Esta función se utiliza para marcar la foto seleccionada cuando se abre el popup del listado que se muestra con el script TinyMCE
 *
 */
function checkedSelectedPhotoTinyMCE()
{
	var objName = parent.document.getElementById('photo_name');
	var p = objName.value;
	if (p != '')
	{
		selectPhotoTinyMCE('cont_' + p, '');
	}
}


/**
 * Esta función llama a un AJAX para que se guarde el caption de la foto en una variable de sesión
 *
 * @param string id identificador del input text del caption la foto
 */
function saveCaption(id)
{
    var objText = $('#' + id);

	$.ajax({
		type: 'GET',
		url: 'photo-caption.php',
		data: 'id=' + id + '&c=' + objText.val()
    });
}