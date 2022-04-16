<?php
/**
 * Archivo de lenguaje de la clase Csale.php
 * 
 * @package EVOIT
 * @author {@link http://www.evoit.com/ EVO I.T.}
 * @copyright {@link http://www.evoit.com/ EVO I.T.}
 * @version v4.4:28-09-2019
 */
define('CSALE_SETID_REQUIRED_VALUE', 'Ingrese el valor &quot;ID&quot;');
define('CSALE_SETID_VALIDATE_VALUE', 'El valor &quot;ID&quot; es incorrecto');
define('CSALE_SETDATE_ADDED_REQUIRED_VALUE', 'Ingrese el valor &quot;Fecha&quot;');
define('CSALE_SETDATE_ADDED_VALIDATE_VALUE', 'El valor &quot;Fecha&quot; es incorrecto');
define('CSALE_SETDATE_ADDED_ERROR', 'Se produjo un error en el campo &quot;Fecha&quot;');
define('CSALE_SETTOTAL_AMOUNT_GROSS_REQUIRED_VALUE', 'Ingrese el valor &quot;Bruto&quot;');
define('CSALE_SETTOTAL_AMOUNT_GROSS_VALIDATE_VALUE', 'El valor &quot;Bruto&quot; es incorrecto');
define('CSALE_SETDISCOUNT_VALIDATE_VALUE', 'El valor &quot;Descuento&quot; es incorrecto');
define('CSALE_SETTOTAL_AMOUNT_NET_VALIDATE_VALUE', 'El valor &quot;Neto&quot; es incorrecto');
define('CSALE_SETID_USER_ADD_REQUIRED_VALUE', 'Ingrese el valor &quot;Usuario&quot;');
define('CSALE_SETID_USER_ADD_VALIDATE_VALUE', 'El valor &quot;Usuario&quot; es incorrecto');
define('CSALE_SETID_CLIENT_VALIDATE_VALUE', 'El valor &quot;Cliente&quot; es incorrecto');
define('CSALE_ADD_ERROR', 'No se pudo insertar el registro');
define('CSALE_UPDATE_ERROR', 'No se pudo actualizar el registro');
define('CSALE_UPDATE_REQUIRED_PK', 'No est&aacute; definido el identificador del registro que se quiere actualizar');
define('CSALE_DEL_ERROR', 'No se pudo eliminar el registro');
define('CSALE_DEL_REQUIRED_PK', 'No est&aacute; definido el identificador del registro que se quiere eliminar');
define('CSALE_GETDATA_ERROR', 'No se pudo obtener el registro');
define('CSALE_GETDATA_REQUIRED_PK', 'No est&aacute; definido el identificador del registro que se quiere obtener');
define('CSALE_GETLIST_ERROR', 'No se pudo realizar la consulta');
define('CSALE_GETLIST_TOTAL_LIST_ERROR', 'No se pudo obtener el n&uacute;mero total de registros de la consulta');
define('CSALE_GET_LAST_ID_ERROR', 'No se pudo obtener el &uacute;ltimo identificador');
define('CSALE_ADD_FORM_REQUIRED_DETAIL_DETAIL', 'Debe seleccionar al menos un producto para la venta');
define('CSALE_ADD_FORM_REQUIRED_DETAIL_MOVEMENT', 'Debe seleccionar al menos una forma de pago');
define('CSALE_ADD_FORM_ID_CLIENT_DETAIL_MOVEMENT', 'Si paga con cta cte debe seleccionar un cliente');
define('CSALE_ADD_FORM_NOT_MATCH_DETAIL_MOVEMENT', 'Los montos de los pagos seleccionados no son iguales a los de los productos');
define('CSALE_ADD_FORM_OK', 'El registro fue insertado correctamente');
define('CSALE_ADD_FORM_OK_BTN', 'Continuar');
define('CSALE_ADD_FORM_BACK_BTN', 'Volver');
define('CSALE_ADD_FORM_LABEL_FIELD_DATE_ADDED', 'Fecha');
define('CSALE_ADD_FORM_LABEL_FIELD_TOTAL_AMOUNT_GROSS', 'Bruto');
define('CSALE_ADD_FORM_LABEL_FIELD_DISCOUNT', 'Descuento');
define('CSALE_ADD_FORM_LABEL_FIELD_TOTAL_AMOUNT_NET', 'Neto');
define('CSALE_ADD_FORM_LABEL_FIELD_ID_USER_ADD', 'Usuario');
define('CSALE_ADD_FORM_LABEL_FIELD_ID_CLIENT', 'Cliente');
define('CSALE_ADD_FORM_LABEL_FIELD_CASUAL_CUSTOMER', 'Nombre');
define('CSALE_ADD_FORM_SUBMIT_BTN', 'Aceptar');
define('CSALE_ADD_FORM_CANCEL_BTN', 'Cancelar');
define('CSALE_ADD_FORM_LABEL_REQUIRED', 'Requeridos');
define('CSALE_UPDATE_FORM_REQUIRED_DETAIL_DETAIL', 'Debe insertar al menos un &iacute;tem');
define('CSALE_UPDATE_FORM_ID_CLIENT_DETAIL_MOVEMENT', 'Si paga con cta cte debe seleccionar un cliente');
define('CSALE_UPDATE_FORM_OK', 'El registro fue actualizado correctamente');
define('CSALE_UPDATE_FORM_OK_BTN', 'Continuar');
define('CSALE_UPDATE_FORM_BACK_BTN', 'Volver');
define('CSALE_UPDATE_FORM_LABEL_FIELD_ID', 'ID');
define('CSALE_UPDATE_FORM_LABEL_FIELD_DATE_ADDED', 'Fecha');
define('CSALE_UPDATE_FORM_LABEL_FIELD_TOTAL_AMOUNT_GROSS', 'Bruto');
define('CSALE_UPDATE_FORM_LABEL_FIELD_DISCOUNT', 'Descuento');
define('CSALE_UPDATE_FORM_LABEL_FIELD_TOTAL_AMOUNT_NET', 'Neto');
define('CSALE_UPDATE_FORM_LABEL_FIELD_ID_USER_ADD', 'Usuario');
define('CSALE_UPDATE_FORM_LABEL_FIELD_ID_CLIENT', 'Cliente');
define('CSALE_UPDATE_FORM_LABEL_FIELD_CASUAL_CUSTOMER', 'Nombre');
define('CSALE_UPDATE_FORM_SUBMIT_BTN', 'Aceptar');
define('CSALE_UPDATE_FORM_CANCEL_BTN', 'Cancelar');
define('CSALE_UPDATE_FORM_LABEL_REQUIRED', 'Requeridos');
define('CSALE_DEL_FORM_OK', 'El registro fue eliminado correctamente');
define('CSALE_DEL_FORM_OK_BTN', 'Continuar');
define('CSALE_DEL_FORM_BACK_BTN', 'Volver');
define('CSALE_DEL_GROUP_FORM_REQUIRED_PK', 'Debe seleccionar uno a m&aacute;s registros para eliminar');
define('CSALE_DEL_GROUP_FORM_OK', 'Los registros fueron eliminados correctamente');
define('CSALE_DEL_GROUP_FORM_OK_BTN', 'Continuar');
define('CSALE_DEL_GROUP_FORM_CANT_DELETE_ALL', 'Algunos registros no fueron eliminados');
define('CSALE_DEL_GROUP_FORM_BACK_BTN', 'Volver');
define('CSALE_SHOW_DATA_LABEL_FIELD_ID', 'ID');
define('CSALE_SHOW_DATA_LABEL_FIELD_DATE_ADDED', 'Fecha');
define('CSALE_SHOW_DATA_LABEL_FIELD_TOTAL_AMOUNT_GROSS', 'Bruto');
define('CSALE_SHOW_DATA_LABEL_FIELD_DISCOUNT', 'Descuento');
define('CSALE_SHOW_DATA_LABEL_FIELD_TOTAL_AMOUNT_NET', 'Neto');
define('CSALE_SHOW_DATA_LABEL_FIELD_ID_USER_ADD', 'Usuario');
define('CSALE_SHOW_DATA_LABEL_FIELD_ID_CLIENT', 'Cliente');
define('CSALE_SHOW_DATA_LABEL_FIELD_CASUAL_CUSTOMER', 'Nombre');
define('CSALE_SHOW_DATA_BACK_BTN', 'Volver');
define('CSALE_SEARCH_FORM_LABEL_FIELD_ID', 'ID');
define('CSALE_SEARCH_FORM_LABEL_FIELD_DATE_ADDED', 'Fecha');
define('CSALE_SEARCH_FORM_LABEL_FIELD_TOTAL_AMOUNT_GROSS', 'Bruto');
define('CSALE_SEARCH_FORM_LABEL_FIELD_DISCOUNT', 'Descuento');
define('CSALE_SEARCH_FORM_LABEL_FIELD_TOTAL_AMOUNT_NET', 'Neto');
define('CSALE_SEARCH_FORM_LABEL_FIELD_ID_USER_ADD', 'Usuario');
define('CSALE_SEARCH_FORM_LABEL_FIELD_ID_CLIENT', 'Cliente');
define('CSALE_SEARCH_FORM_LABEL_FIELD_CASUAL_CUSTOMER', 'Nombre');
define('CSALE_SEARCH_FORM_SUBMIT_BTN', 'Buscar');
define('CSALE_SHOW_QUERY_HEAD_FIELD_ID', 'ID');
define('CSALE_SHOW_QUERY_HEAD_FIELD_DATE_ADDED', 'Fecha');
define('CSALE_SHOW_QUERY_HEAD_FIELD_TOTAL_AMOUNT_GROSS', 'Bruto');
define('CSALE_SHOW_QUERY_HEAD_FIELD_DISCOUNT', 'Descuento');
define('CSALE_SHOW_QUERY_HEAD_FIELD_TOTAL_AMOUNT_NET', 'Neto');
define('CSALE_SHOW_QUERY_HEAD_FIELD_ID_USER_ADD', 'Usuario');
define('CSALE_SHOW_QUERY_HEAD_FIELD_ID_CLIENT', 'Cliente');
define('CSALE_SHOW_QUERY_HEAD_FIELD_CASUAL_CUSTOMER', 'Nombre');
define('CSALE_SHOW_QUERY_HEAD_FIELD_PRODUCTS', 'Productos');
define('CSALE_SHOW_QUERY_NOT_FOUND', 'No se encontraron registros');
define('CSALE_SHOW_QUERY_SELECT_ALL', 'Seleccionar todos');
?>