<?php
/**
 * Archivo de lenguaje de la clase Cprovider.php
 *
 * @package EVOIT
 * @author {@link http://www.evoit.com/ EVO I.T.}
 * @copyright {@link http://www.evoit.com/ EVO I.T.}
 * @version v4.3:29-05-2019
 */
define('CPROVIDER_SETID_REQUIRED_VALUE', 'Ingrese el valor &quot;ID&quot;');
define('CPROVIDER_SETID_VALIDATE_VALUE', 'El valor &quot;ID&quot; es incorrecto');
define('CPROVIDER_SETNAME_REQUIRED_VALUE', 'Ingrese el valor &quot;Nombre&quot;');
define('CPROVIDER_SETEMAIL_REQUIRED_VALUE', 'Ingrese el valor &quot;Email&quot;');
define('CPROVIDER_SETEMAIL_VALIDATE_VALUE', 'El valor &quot;Email&quot; es incorrecto');
define('CPROVIDER_SETPHONE_REQUIRED_VALUE', 'Ingrese el valor &quot;Tel&eacute;fono&quot;');
define('CPROVIDER_ADD_ERROR', 'No se pudo insertar el registro');
define('CPROVIDER_UPDATE_ERROR', 'No se pudo actualizar el registro');
define('CPROVIDER_UPDATE_REQUIRED_PK', 'No est&aacute; definido el identificador del registro que se quiere actualizar');
define('CPROVIDER_DEL_ERROR', 'No se pudo eliminar el registro');
define('CPROVIDER_DEL_REQUIRED_PK', 'No est&aacute; definido el identificador del registro que se quiere eliminar');
define('CPROVIDER_GETDATA_ERROR', 'No se pudo obtener el registro');
define('CPROVIDER_GETDATA_REQUIRED_PK', 'No est&aacute; definido el identificador del registro que se quiere obtener');
define('CPROVIDER_GETLIST_ERROR', 'No se pudo realizar la consulta');
define('CPROVIDER_GETLIST_TOTAL_LIST_ERROR', 'No se pudo obtener el n&uacute;mero total de registros de la consulta');
define('CPROVIDER_EXIST_EMAIL_EXIST', 'El valor &quot;Email&quot; ingresado ya existe');
define('CPROVIDER_EXIST_EMAIL_ERROR', 'No se pudo verificar la existencia del valor &quot;Email&quot; ingresado');
define('CPROVIDER_CAN_DELETE_ERROR', 'No se pudo verificar si se puede eliminar el registro');
define('CPROVIDER_CAN_DELETE_CANT_MOVEMENT', 'El registro no se pudo eliminar porque est&aacute; relacionado con uno o m&aacute;s registros de la tabla &quot;movement&quot;');
define('CPROVIDER_CAN_DELETE_CANT_PRODUCT', 'El registro no se pudo eliminar porque est&aacute; relacionado con uno o m&aacute;s registros de la tabla &quot;product&quot;');
define('CPROVIDER_CAN_DELETE_REQUIRED_PK', 'No est&aacute; definido el identificador del registro');
define('CPROVIDER_GET_LAST_ID_ERROR', 'No se pudo obtener el &uacute;ltimo identificador');
define('CPROVIDER_ADD_FORM_OK', 'El registro fue insertado correctamente');
define('CPROVIDER_ADD_FORM_OK_BTN', 'Continuar');
define('CPROVIDER_ADD_FORM_NEW_BTN', 'Agregar un usuario');
define('CPROVIDER_ADD_FORM_BACK_BTN', 'Volver');
define('CPROVIDER_ADD_FORM_LABEL_FIELD_NAME', 'Nombre');
define('CPROVIDER_ADD_FORM_LABEL_FIELD_EMAIL', 'Email');
define('CPROVIDER_ADD_FORM_LABEL_FIELD_PHONE', 'Tel&eacute;fono');
define('CPROVIDER_ADD_FORM_SUBMIT_BTN', 'Aceptar');
define('CPROVIDER_ADD_FORM_CANCEL_BTN', 'Cancelar');
define('CPROVIDER_ADD_FORM_LABEL_REQUIRED', 'Requeridos');
define('CPROVIDER_UPDATE_FORM_OK', 'El registro fue actualizado correctamente');
define('CPROVIDER_UPDATE_FORM_OK_BTN', 'Continuar');
define('CPROVIDER_UPDATE_FORM_BACK_BTN', 'Volver');
define('CPROVIDER_UPDATE_FORM_LABEL_FIELD_ID', 'ID');
define('CPROVIDER_UPDATE_FORM_LABEL_FIELD_NAME', 'Nombre');
define('CPROVIDER_UPDATE_FORM_LABEL_FIELD_EMAIL', 'Email');
define('CPROVIDER_UPDATE_FORM_LABEL_FIELD_PHONE', 'Tel&eacute;fono');
define('CPROVIDER_UPDATE_FORM_SUBMIT_BTN', 'Aceptar');
define('CPROVIDER_UPDATE_FORM_CANCEL_BTN', 'Cancelar');
define('CPROVIDER_UPDATE_FORM_LABEL_REQUIRED', 'Requeridos');
define('CPROVIDER_DEL_FORM_OK', 'El registro fue eliminado correctamente');
define('CPROVIDER_DEL_FORM_OK_BTN', 'Continuar');
define('CPROVIDER_DEL_FORM_BACK_BTN', 'Volver');
define('CPROVIDER_DEL_GROUP_FORM_REQUIRED_PK', 'Debe seleccionar uno a m&aacute;s registros para eliminar');
define('CPROVIDER_DEL_GROUP_FORM_OK', 'Los registros fueron eliminados correctamente');
define('CPROVIDER_DEL_GROUP_FORM_OK_BTN', 'Continuar');
define('CPROVIDER_DEL_GROUP_FORM_CANT_DELETE_ALL', 'Algunos registros no fueron eliminados');
define('CPROVIDER_DEL_GROUP_FORM_BACK_BTN', 'Volver');
define('CPROVIDER_SHOW_DATA_LABEL_FIELD_ID', 'ID');
define('CPROVIDER_SHOW_DATA_LABEL_FIELD_NAME', 'Nombre');
define('CPROVIDER_SHOW_DATA_LABEL_FIELD_EMAIL', 'Email');
define('CPROVIDER_SHOW_DATA_LABEL_FIELD_PHONE', 'Tel&eacute;fono');
define('CPROVIDER_SHOW_DATA_BACK_BTN', 'Volver');
define('CPROVIDER_SEARCH_FORM_LABEL_FIELD_ID', 'ID');
define('CPROVIDER_SEARCH_FORM_LABEL_FIELD_NAME', 'Nombre');
define('CPROVIDER_SEARCH_FORM_LABEL_FIELD_EMAIL', 'Email');
define('CPROVIDER_SEARCH_FORM_LABEL_FIELD_PHONE', 'Tel&eacute;fono');
define('CPROVIDER_SEARCH_FORM_SUBMIT_BTN', 'Buscar');
define('CPROVIDER_SHOW_QUERY_HEAD_FIELD_ID', 'ID');
define('CPROVIDER_SHOW_QUERY_HEAD_FIELD_NAME', 'Nombre');
define('CPROVIDER_SHOW_QUERY_HEAD_FIELD_EMAIL', 'Email');
define('CPROVIDER_SHOW_QUERY_HEAD_FIELD_PHONE', 'Tel&eacute;fono');
define('CPROVIDER_SHOW_QUERY_NOT_FOUND', 'No se encontraron registros');
define('CPROVIDER_SHOW_QUERY_SELECT_ALL', 'Seleccionar todos');
define('CPROVIDER_REPORT_PRODUCT_TO_BACK_NOT_ROWS', 'No hay productos a devolver');
?>