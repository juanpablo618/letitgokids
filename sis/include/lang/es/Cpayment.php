<?php
/**
 * Archivo de lenguaje de la clase Cpayment.php
 *
 * @package EVOIT
 * @author {@link http://www.evoit.com/ EVO I.T.}
 * @copyright {@link http://www.evoit.com/ EVO I.T.}
 * @version v4.4:28-05-2020
 */
define('CPAYMENT_SETID_REQUIRED_VALUE', 'Ingrese el valor &quot;ID&quot;');
define('CPAYMENT_SETID_VALIDATE_VALUE', 'El valor &quot;ID&quot; es incorrecto');
define('CPAYMENT_SETDATE_ADDED_REQUIRED_VALUE', 'Ingrese el valor &quot;Fecha&quot;');
define('CPAYMENT_SETDATE_ADDED_VALIDATE_VALUE', 'El valor &quot;Fecha&quot; es incorrecto');
define('CPAYMENT_SETDATE_ADDED_ERROR', 'Se produjo un error en el campo &quot;Fecha&quot;');
define('CPAYMENT_SETTOTAL_AMOUNT_BACK_VALIDATE_VALUE', 'El valor &quot;Devuelto&quot; es incorrecto');
define('CPAYMENT_SETTOTAL_AMOUNT_PAY_VALIDATE_VALUE', 'El valor &quot;Pagado&quot; es incorrecto');
define('CPAYMENT_SETID_USER_ADD_REQUIRED_VALUE', 'Ingrese el valor &quot;Usuario&quot;');
define('CPAYMENT_SETID_USER_ADD_VALIDATE_VALUE', 'El valor &quot;Usuario&quot; es incorrecto');
define('CPAYMENT_SETID_PROVIDER_REQUIRED_VALUE', 'Ingrese el valor &quot;Proveedor&quot;');
define('CPAYMENT_SETID_PROVIDER_VALIDATE_VALUE', 'El valor &quot;Proveedor&quot; es incorrecto');
define('CPAYMENT_SETTOTAL_AMOUNT_DONATE_VALIDATE_VALUE', 'El valor &quot;Donado&quot; es incorrecto');
define('CPAYMENT_ADD_ERROR', 'No se pudo insertar el registro');
define('CPAYMENT_UPDATE_ERROR', 'No se pudo actualizar el registro');
define('CPAYMENT_UPDATE_REQUIRED_PK', 'No est&aacute; definido el identificador del registro que se quiere actualizar');
define('CPAYMENT_DEL_ERROR', 'No se pudo eliminar el registro');
define('CPAYMENT_DEL_REQUIRED_PK', 'No est&aacute; definido el identificador del registro que se quiere eliminar');
define('CPAYMENT_GETDATA_ERROR', 'No se pudo obtener el registro');
define('CPAYMENT_GETDATA_REQUIRED_PK', 'No est&aacute; definido el identificador del registro que se quiere obtener');
define('CPAYMENT_GETLIST_ERROR', 'No se pudo realizar la consulta');
define('CPAYMENT_GETLIST_TOTAL_LIST_ERROR', 'No se pudo obtener el n&uacute;mero total de registros de la consulta');
define('CPAYMENT_GET_LAST_ID_ERROR', 'No se pudo obtener el &uacute;ltimo identificador');
define('CPAYMENT_ADD_FORM_REQUIRED_DETAIL_DETAIL_PAYMENT', 'Debe insertar al menos un &iacute;tem');
define('CPAYMENT_ADD_FORM_OK', 'El registro fue insertado correctamente');
define('CPAYMENT_ADD_FORM_OK_BTN', 'Continuar');
define('CPAYMENT_ADD_FORM_BACK_BTN', 'Volver');
define('CPAYMENT_ADD_FORM_LABEL_FIELD_DATE_ADDED', 'Fecha');
define('CPAYMENT_ADD_FORM_LABEL_FIELD_TOTAL_AMOUNT_BACK', 'Devuelto');
define('CPAYMENT_ADD_FORM_LABEL_FIELD_TOTAL_AMOUNT_PAY', 'Pagado');
define('CPAYMENT_ADD_FORM_LABEL_FIELD_ID_USER_ADD', 'Usuario');
define('CPAYMENT_ADD_FORM_LABEL_FIELD_ID_PROVIDER', 'Proveedor');
define('CPAYMENT_ADD_FORM_LABEL_FIELD_TOTAL_AMOUNT_DONATE', 'Donado');
define('CPAYMENT_ADD_FORM_SUBMIT_BTN', 'Aceptar');
define('CPAYMENT_ADD_FORM_CANCEL_BTN', 'Cancelar');
define('CPAYMENT_ADD_FORM_LABEL_REQUIRED', 'Requeridos');
define('CPAYMENT_UPDATE_FORM_REQUIRED_DETAIL_DETAIL_PAYMENT', 'Debe insertar al menos un &iacute;tem');
define('CPAYMENT_UPDATE_FORM_OK', 'El registro fue actualizado correctamente');
define('CPAYMENT_UPDATE_FORM_OK_BTN', 'Continuar');
define('CPAYMENT_UPDATE_FORM_BACK_BTN', 'Volver');
define('CPAYMENT_UPDATE_FORM_LABEL_FIELD_ID', 'ID');
define('CPAYMENT_UPDATE_FORM_LABEL_FIELD_DATE_ADDED', 'Fecha');
define('CPAYMENT_UPDATE_FORM_LABEL_FIELD_TOTAL_AMOUNT_BACK', 'Devuelto');
define('CPAYMENT_UPDATE_FORM_LABEL_FIELD_TOTAL_AMOUNT_PAY', 'Pagado');
define('CPAYMENT_UPDATE_FORM_LABEL_FIELD_ID_USER_ADD', 'Usuario');
define('CPAYMENT_UPDATE_FORM_LABEL_FIELD_ID_PROVIDER', 'Proveedor');
define('CPAYMENT_UPDATE_FORM_LABEL_FIELD_TOTAL_AMOUNT_DONATE', 'Donado');
define('CPAYMENT_UPDATE_FORM_SUBMIT_BTN', 'Aceptar');
define('CPAYMENT_UPDATE_FORM_CANCEL_BTN', 'Cancelar');
define('CPAYMENT_UPDATE_FORM_LABEL_REQUIRED', 'Requeridos');
define('CPAYMENT_DEL_FORM_OK', 'El registro fue eliminado correctamente');
define('CPAYMENT_DEL_FORM_OK_BTN', 'Continuar');
define('CPAYMENT_DEL_FORM_BACK_BTN', 'Volver');
define('CPAYMENT_DEL_GROUP_FORM_REQUIRED_PK', 'Debe seleccionar uno a m&aacute;s registros para eliminar');
define('CPAYMENT_DEL_GROUP_FORM_OK', 'Los registros fueron eliminados correctamente');
define('CPAYMENT_DEL_GROUP_FORM_OK_BTN', 'Continuar');
define('CPAYMENT_DEL_GROUP_FORM_CANT_DELETE_ALL', 'Algunos registros no fueron eliminados');
define('CPAYMENT_DEL_GROUP_FORM_BACK_BTN', 'Volver');
define('CPAYMENT_SHOW_DATA_LABEL_FIELD_ID', 'ID');
define('CPAYMENT_SHOW_DATA_LABEL_FIELD_DATE_ADDED', 'Fecha');
define('CPAYMENT_SHOW_DATA_LABEL_FIELD_TOTAL_AMOUNT_BACK', 'Devuelto');
define('CPAYMENT_SHOW_DATA_LABEL_FIELD_TOTAL_AMOUNT_PAY', 'Pagado');
define('CPAYMENT_SHOW_DATA_LABEL_FIELD_ID_USER_ADD', 'Usuario');
define('CPAYMENT_SHOW_DATA_LABEL_FIELD_ID_PROVIDER', 'Proveedor');
define('CPAYMENT_SHOW_DATA_LABEL_FIELD_TOTAL_AMOUNT_DONATE', 'Donado');
define('CPAYMENT_SHOW_DATA_BACK_BTN', 'Volver');
define('CPAYMENT_SEARCH_FORM_LABEL_FIELD_ID', 'ID');
define('CPAYMENT_SEARCH_FORM_LABEL_FIELD_DATE_ADDED', 'Fecha');
define('CPAYMENT_SEARCH_FORM_LABEL_FIELD_TOTAL_AMOUNT_BACK', 'Devuelto');
define('CPAYMENT_SEARCH_FORM_LABEL_FIELD_TOTAL_AMOUNT_PAY', 'Pagado');
define('CPAYMENT_SEARCH_FORM_LABEL_FIELD_ID_USER_ADD', 'Usuario');
define('CPAYMENT_SEARCH_FORM_LABEL_FIELD_ID_PROVIDER', 'Proveedor');
define('CPAYMENT_SEARCH_FORM_LABEL_FIELD_TOTAL_AMOUNT_DONATE', 'Donado');
define('CPAYMENT_SEARCH_FORM_SUBMIT_BTN', 'Buscar');
define('CPAYMENT_SHOW_QUERY_HEAD_FIELD_ID', 'ID');
define('CPAYMENT_SHOW_QUERY_HEAD_FIELD_DATE_ADDED', 'Fecha');
define('CPAYMENT_SHOW_QUERY_HEAD_FIELD_TOTAL_AMOUNT_BACK', 'Devuelto');
define('CPAYMENT_SHOW_QUERY_HEAD_FIELD_TOTAL_AMOUNT_PAY', 'Pagado');
define('CPAYMENT_SHOW_QUERY_HEAD_FIELD_ID_USER_ADD', 'Usuario');
define('CPAYMENT_SHOW_QUERY_HEAD_FIELD_ID_PROVIDER', 'Proveedor');
define('CPAYMENT_SHOW_QUERY_HEAD_FIELD_TOTAL_AMOUNT_DONATE', 'Donado');
define('CPAYMENT_SHOW_QUERY_NOT_FOUND', 'No se encontraron registros');
define('CPAYMENT_SHOW_QUERY_SELECT_ALL', 'Seleccionar todos');
define('CPAYMENT_SHOW_QUERY_HEAD_FIELD_PRODUCTS', 'Productos');

define('CPAYMENT_PAY_PRODUCT_FORM_LABEL_FIELD_DATE', 'Fecha');
define('CPAYMENT_PAY_PRODUCT_FORM_LABEL_FIELD_PROVIDER', 'Proveedor');
define('CPAYMENT_PAY_PRODUCT_FORM_SUBMIT_BTN', 'Aceptar');
define('CPAYMENT_PAY_PRODUCT_FORM_CANCEL_BTN', 'Cancelar');
define('CPAYMENT_PAY_PRODUCT_FORM_LABEL_REQUIRED', 'Requeridos');
define('CPAYMENT_PAY_PRODUCT_FORM_REQUIRED_VALUE', 'Debe elegir un &quot;Proveedor&quot;');
define('CPAYMENT_PAY_PRODUCT_FORM_MOVEMENT_DESCRIPTION', 'Movimiento agregado por el pago de producto/s');
define('CPAYMENT_PAY_PRODUCT_FORM_REQUIRED_ITEM', 'Debe elegir al menos un producto a pagar o devolver');
define('CPAYMENT_PAY_PRODUCT_FORM_NOT_ALLOWED', 'No tiene permiso para realizar esta acción');
?>