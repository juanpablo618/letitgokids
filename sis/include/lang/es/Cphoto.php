<?php
/**
 * Archivo de lenguaje de la clase Cphoto.php
 * 
 * @package EVOIT
 * @author {@link http://www.evoit.com/ EVO I.T.}
 * @copyright {@link http://www.evoit.com/ EVO I.T.}
 * @version v4.2:25-08-2015
 */
define('CPHOTO_SETID_PHOTO_REQUIRED_VALUE', 'Ingrese el valor &quot;ID&quot;');
define('CPHOTO_SETID_PHOTO_VALIDATE_VALUE', 'El valor &quot;ID&quot; es incorrecto');
define('CPHOTO_SETTABLE_FK_REQUIRED_VALUE', 'Ingrese el valor &quot;Tabla FK&quot;');
define('CPHOTO_SETID_FK_REQUIRED_VALUE', 'Ingrese el valor &quot;ID FK&quot;');
define('CPHOTO_SETID_FK_VALIDATE_VALUE', 'El valor &quot;ID FK&quot; es incorrecto');
define('CPHOTO_SETNAME_REQUIRED_VALUE', 'Ingrese el valor &quot;Nombre&quot;');
define('CPHOTO_SETMAIN_REQUIRED_VALUE', 'Ingrese el valor &quot;Principal&quot;');
define('CPHOTO_SETDELETED_REQUIRED_VALUE', 'Ingrese el valor &quot;Eliminada&quot;');
define('CPHOTO_SETWIDTH_VALIDATE_VALUE', 'El valor &quot;Ancho&quot; es incorrecto');
define('CPHOTO_SETHEIGHT_VALIDATE_VALUE', 'El valor &quot;Alto&quot; es incorrecto');
define('CPHOTO_SETPHOTO_TEMP_PATH_REQUIRED_VALUE', 'Ingrese el valor &quot;photo_temp_path&quot;');
define('CPHOTO_SETPHOTO_PATH_REQUIRED_VALUE', 'Ingrese el valor &quot;photo_path&quot;');
define('CPHOTO_SETPHOTO_THUMBS_TEMP_PATH_REQUIRED_VALUE', 'Ingrese el valor &quot;photo_thumbs_temp_path&quot;');
define('CPHOTO_SETPHOTO_THUMBS_PATH_REQUIRED_VALUE', 'Ingrese el valor &quot;photo_thumbs_path&quot;');
define('CPHOTO_SETPHOTO_TEMP_URL_REQUIRED_VALUE', 'Ingrese el valor &quot;photo_temp_url&quot;');
define('CPHOTO_SETPHOTO_URL_REQUIRED_VALUE', 'Ingrese el valor &quot;photo_url&quot;');
define('CPHOTO_SETPHOTO_THUMBS_TEMP_URL_REQUIRED_VALUE', 'Ingrese el valor &quot;photo_thumbs_temp_url&quot;');
define('CPHOTO_SETPHOTO_THUMBS_URL_REQUIRED_VALUE', 'Ingrese el valor &quot;photo_thumbs_url&quot;');
define('CPHOTO_SETPHOTO_THUMBS_WIDTH_REQUIRED_VALUE', 'Ingrese el valor &quot;photo_thumbs_width&quot;');
define('CPHOTO_SETPHOTO_THUMBS_HEIGHT_REQUIRED_VALUE', 'Ingrese el valor &quot;photo_thumbs_height&quot;');
define('CPHOTO_SETPHOTO_TEMP_THUMBS_WIDTH_REQUIRED_VALUE', 'Ingrese el valor &quot;photo_temp_thumbs_width&quot;');
define('CPHOTO_SETIS_TEMP_REQUIRED_VALUE', 'Ingrese el valor &quot;is_temp&quot; (TRUE / FALSE)');
define('CPHOTO_SETPHOTOS_LIMIT_VALIDATE_VALUE', 'El valor del l&iacute;mite de fotos permitido es incorrecto');
define('CPHOTO_SETCONSTANTS_REQUIRED_TABLE_FK', 'Ingrese el valor &quot;Tabla FK&quot;');
define('CPHOTO_SETCONSTANTS_CONSTANT_NOT_DEFINED', 'Constante no definida:');
define('CPHOTO_GET_VALUES_MAIN_VALUE_1', 'S&iacute;');
define('CPHOTO_GET_VALUES_MAIN_VALUE_2', 'No');
define('CPHOTO_GET_VALUES_DELETED_VALUE_1', 'S&iacute;');
define('CPHOTO_GET_VALUES_DELETED_VALUE_2', 'No');
define('CPHOTO_ADD_ERROR', 'No se pudo insertar el registro');
define('CPHOTO_UPDATE_ERROR', 'No se pudo actualizar el registro');
define('CPHOTO_UPDATE_REQUIRED_PK', 'No est&aacute; definido el identificador del registro que se quiere actualizar');
define('CPHOTO_DEL_ERROR', 'No se pudo eliminar el registro');
define('CPHOTO_DEL_REQUIRED_PK', 'No est&aacute; definido el identificador del registro que se quiere eliminar');
define('CPHOTO_GETDATA_ERROR', 'No se pudo obtener el registro');
define('CPHOTO_GETDATA_REQUIRED_PK', 'No est&aacute; definido el identificador del registro que se quiere obtener');
define('CPHOTO_GETLIST_ERROR', 'No se pudo realizar la consulta');
define('CPHOTO_GETLIST_TOTAL_LIST_ERROR', 'No se pudo obtener el n&uacute;mero total de registros de la consulta');
define('CPHOTO_GET_LAST_ID_PHOTO_ERROR', 'No se pudo obtener el &uacute;ltimo identificador');
define('CPHOTO_SHOW_IFRAME_PHOTO_DEFAULT_TITLE', 'Fotos');
define('CPHOTO_SHOW_IFRAME_PHOTO_REQUIRED_TABLE_FK', 'Ingrese el valor &quot;Tabla FK&quot;');
define('CPHOTO_SHOW_IFRAME_PHOTO_IFRAMES_ERROR', 'Debe utilizar un Navegador que permita IFRAMES');
define('CPHOTO_ADD_PHOTO_FORM_REQUIRED_TABLE_FK', 'Ingrese el valor &quot;Tabla FK&quot;');
define('CPHOTO_ADD_PHOTO_FORM_PHOTOS_LIMIT_ERROR', 'No est&aacute; permitido cargar m&aacute;s de la siguiente cantidad de im&aacute;genes: ');
define('CPHOTO_ADD_PHOTO_FORM_ADD_PHOTO_BTN', 'Agregar');
define('CPHOTO_ADD_PHOTO_FORM_LABEL_MAIN', 'principal');
define('CPHOTO_ADD_PHOTO_FORM_CROP_TITLE', 'Modificar thumb');
define('CPHOTO_ADD_PHOTO_FORM_DEL_TITLE', 'Eliminar');
define('CPHOTO_ADD_TEMP_PHOTO_UPLOAD_ERROR', 'Se produjo un error al cargar la foto');
define('CPHOTO_ADD_TEMP_PHOTO_INVALID_EXTENSION', 'La foto debe tener una de las siguientes extensiones:');
define('CPHOTO_GET_PHOTOS_REQUIRED_VALUES', 'Ingrese los valores &quot;Tabla FK&quot; y &quot;Id FK&quot;');
define('CPHOTO_ADD_PHOTOS_REQUIRED_VALUES', 'Ingrese los valores &quot;Tabla FK&quot; y &quot;Id FK&quot;');
define('CPHOTO_UPDATE_DELETED_REQUIRED_VALUES', 'Ingrese los valores &quot;Tabla FK&quot; y &quot;Id FK&quot;');
define('CPHOTO_GET_MAIN_PHOTO_REQUIRED_VALUES', 'Ingrese los valores &quot;Tabla FK&quot; y &quot;Id FK&quot;');
define('CPHOTO_UPDATE_PHOTOS_REQUIRED_VALUES', 'Ingrese los valores &quot;Tabla FK&quot; y &quot;Id FK&quot;');
define('CPHOTO_DELETE_PHOTOS_REQUIRED_VALUES', 'Ingrese los valores &quot;Tabla FK&quot; y &quot;Id FK&quot;');
define('CPHOTO_DELETE_PHOTOS_TEMPORARILY_REQUIRED_PHOTO_TEMP_PATH', 'Ingrese el directorio temporal de las fotos');
define('CPHOTO_DELETE_PHOTOS_TEMPORARILY_REQUIRED_ID_PHOTO', 'Ingrese el valor &quot;Id&quot;');
define('CPHOTO_DELETE_OLD_TEMP_PHOTOS_REQUIRED_PHOTO_TEMP_PATH', 'Ingrese el directorio temporal de las fotos');
define('CPHOTO_PATH_CONTROL_PHOTO_TEMP_PATH_REQUIRED_VALUE', 'Ingrese el valor &quot;photo_temp_path&quot;');
define('CPHOTO_PATH_CONTROL_PHOTO_PATH_REQUIRED_VALUE', 'Ingrese el valor &quot;photo_path&quot;');
define('CPHOTO_PATH_CONTROL_PHOTO_THUMBS_TEMP_PATH_REQUIRED_VALUE', 'Ingrese el valor &quot;photo_thumbs_temp_path&quot;');
define('CPHOTO_PATH_CONTROL_PHOTO_THUMBS_PATH_REQUIRED_VALUE', 'Ingrese el valor &quot;photo_thumbs_path&quot;');
define('CPHOTO_CROP_PHOTO_FORM_SELECTION_ERROR', 'Error en la selecci&oacute;n');
define('CPHOTO_CROP_PHOTO_FORM_RESIZE_ERROR', 'Error al procesar la foto');
define('CPHOTO_CROP_PHOTO_FORM_CROP_ERROR', 'Error al procesar la foto');
define('CPHOTO_CROP_PHOTO_FORM_BACK_BTN', 'Volver');
define('CPHOTO_CROP_PHOTO_FORM_CLOSE_BTN', 'Cerrar');
define('CPHOTO_CROP_PHOTO_FORM_SUBMIT_BTN', 'Aceptar');
define('CPHOTO_CROP_PHOTO_FORM_INSTRUCTION_USE', 'Instrucciones de uso:');
define('CPHOTO_CROP_PHOTO_FORM_INSTRUCTION_USE_1', 'Hacer clic y arrastrar sobre la foto para seleccionar la porci&oacute;n que desee recortar');
define('CPHOTO_CROP_PHOTO_FORM_INSTRUCTION_USE_2', 'Puede modificar el tama&ntilde;o de la selecci&oacute;n desde cualquiera de los tiradores, manteniendo presionado el bot&oacute;n del mouse mientras estira la selecci&oacute;n');
define('CPHOTO_CROP_PHOTO_FORM_INSTRUCTION_USE_3', 'Hacer clic en el bot&oacute;n Aceptar');
define('CPHOTO_LIST_PHOTO_TINYMCE_REQUIRED_TABLE_FK', 'Ingrese el valor &quot;Tabla FK&quot;');
define('CPHOTO_PHOTO_DIALOG_TITLE', 'Foto');
?>