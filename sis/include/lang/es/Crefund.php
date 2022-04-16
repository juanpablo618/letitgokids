<?php
/**
 * Archivo de lenguaje de la clase Crefund.php
 *
 * @package EVOIT
 * @author {@link http://www.evoit.com/ EVO I.T.}
 * @copyright {@link http://www.evoit.com/ EVO I.T.}
 * @version v4.4:17-10-2019
 */
define('CREFUND_SETID_REQUIRED_VALUE', 'Ingrese el valor &quot;ID&quot;');
define('CREFUND_SETID_VALIDATE_VALUE', 'El valor &quot;ID&quot; es incorrecto');
define('CREFUND_SETDATE_ADDED_REQUIRED_VALUE', 'Ingrese el valor &quot;Fecha&quot;');
define('CREFUND_SETDATE_ADDED_VALIDATE_VALUE', 'El valor &quot;Fecha&quot; es incorrecto');
define('CREFUND_SETDATE_ADDED_ERROR', 'Se produjo un error en el campo &quot;Fecha&quot;');
define('CREFUND_SETID_USER_ADD_REQUIRED_VALUE', 'Ingrese el valor &quot;Usuario&quot;');
define('CREFUND_SETID_USER_ADD_VALIDATE_VALUE', 'El valor &quot;Usuario&quot; es incorrecto');
define('CREFUND_SETID_SALE_REQUIRED_VALUE', 'Ingrese el valor &quot;Venta&quot;');
define('CREFUND_SETID_SALE_VALIDATE_VALUE', 'El valor &quot;Venta&quot; es incorrecto');
define('CREFUND_SETREASON_REQUIRED_VALUE', 'Ingrese el valor &quot;Motivo&quot;');
define('CREFUND_SETAMOUNT_REQUIRED_VALUE', 'Ingrese el valor &quot;Monto&quot;');
define('CREFUND_SETAMOUNT_VALIDATE_VALUE', 'El valor &quot;Monto&quot; es incorrecto');
define('CREFUND_GET_VALUES_REASON_VALUE_1', 'Falla');
define('CREFUND_GET_VALUES_REASON_VALUE_2', 'Varios');
define('CREFUND_GET_VALUES_TYPE_VALUE_1', 'Efectivo');
define('CREFUND_GET_VALUES_TYPE_VALUE_2', 'Cta. Cte.');
define('CREFUND_ADD_ERROR', 'No se pudo insertar el registro');
define('CREFUND_UPDATE_ERROR', 'No se pudo actualizar el registro');
define('CREFUND_UPDATE_REQUIRED_PK', 'No est&aacute; definido el identificador del registro que se quiere actualizar');
define('CREFUND_DEL_ERROR', 'No se pudo eliminar el registro');
define('CREFUND_DEL_REQUIRED_PK', 'No est&aacute; definido el identificador del registro que se quiere eliminar');
define('CREFUND_GETDATA_ERROR', 'No se pudo obtener el registro');
define('CREFUND_GETDATA_REQUIRED_PK', 'No est&aacute; definido el identificador del registro que se quiere obtener');
define('CREFUND_GETLIST_ERROR', 'No se pudo realizar la consulta');
define('CREFUND_GETLIST_TOTAL_LIST_ERROR', 'No se pudo obtener el n&uacute;mero total de registros de la consulta');
define('CREFUND_GET_LAST_ID_ERROR', 'No se pudo obtener el &uacute;ltimo identificador');
define('CREFUND_ADD_FORM_OK', 'El registro fue insertado correctamente');
define('CREFUND_ADD_FORM_OK_BTN', 'Continuar');
define('CREFUND_ADD_FORM_BACK_BTN', 'Volver');
define('CREFUND_ADD_FORM_LABEL_FIELD_DATE_ADDED', 'Fecha');
define('CREFUND_ADD_FORM_LABEL_FIELD_ID_USER_ADD', 'Usuario');
define('CREFUND_ADD_FORM_LABEL_FIELD_ID_SALE', 'Venta');
define('CREFUND_ADD_FORM_LABEL_FIELD_REASON', 'Motivo');
define('CREFUND_ADD_FORM_LABEL_FIELD_DETAIL', 'Descripci&oacute;n');
define('CREFUND_ADD_FORM_LABEL_FIELD_TYPE', 'Tipo');
define('CREFUND_ADD_FORM_LABEL_FIELD_AMOUNT', 'Monto');
define('CREFUND_ADD_FORM_SUBMIT_BTN', 'Aceptar');
define('CREFUND_ADD_FORM_CANCEL_BTN', 'Cancelar');
define('CREFUND_ADD_FORM_LABEL_REQUIRED', 'Requeridos');
define('CREFUND_ADD_FORM_REQUIRED_DETAIL', 'Debe seleccionar al menos un producto a devolver');
define('CREFUND_ADD_FORM_CTA_CTE_MUST_BE_CLIENT', 'Para devolver con cta cte, la venta debe haber sido de un cliente');
define('CREFUND_ADD_FORM_SALE_NOT_FOUND', 'No se encontró la venta que se quiere devolver');
define('CREFUND_ADD_DETAIL_MOVEMENT_DESCRIPTION', 'Movimiento agregado por la devolución #');
define('CREFUND_UPDATE_FORM_OK', 'El registro fue actualizado correctamente');
define('CREFUND_UPDATE_FORM_OK_BTN', 'Continuar');
define('CREFUND_UPDATE_FORM_BACK_BTN', 'Volver');
define('CREFUND_UPDATE_FORM_LABEL_FIELD_ID', 'ID');
define('CREFUND_UPDATE_FORM_LABEL_FIELD_DATE_ADDED', 'Fecha');
define('CREFUND_UPDATE_FORM_LABEL_FIELD_ID_USER_ADD', 'Usuario');
define('CREFUND_UPDATE_FORM_LABEL_FIELD_ID_SALE', 'Venta');
define('CREFUND_UPDATE_FORM_LABEL_FIELD_REASON', 'Motivo');
define('CREFUND_UPDATE_FORM_LABEL_FIELD_DETAIL', 'Descripci&oacute;n');
define('CREFUND_UPDATE_FORM_LABEL_FIELD_TYPE', 'Tipo');
define('CREFUND_UPDATE_FORM_LABEL_FIELD_AMOUNT', 'Monto');
define('CREFUND_UPDATE_FORM_SUBMIT_BTN', 'Aceptar');
define('CREFUND_UPDATE_FORM_CANCEL_BTN', 'Cancelar');
define('CREFUND_UPDATE_FORM_LABEL_REQUIRED', 'Requeridos');
define('CREFUND_DEL_FORM_OK', 'El registro fue eliminado correctamente');
define('CREFUND_DEL_FORM_OK_BTN', 'Continuar');
define('CREFUND_DEL_FORM_BACK_BTN', 'Volver');
define('CREFUND_DEL_GROUP_FORM_REQUIRED_PK', 'Debe seleccionar uno a m&aacute;s registros para eliminar');
define('CREFUND_DEL_GROUP_FORM_OK', 'Los registros fueron eliminados correctamente');
define('CREFUND_DEL_GROUP_FORM_OK_BTN', 'Continuar');
define('CREFUND_DEL_GROUP_FORM_CANT_DELETE_ALL', 'Algunos registros no fueron eliminados');
define('CREFUND_DEL_GROUP_FORM_BACK_BTN', 'Volver');
define('CREFUND_SHOW_DATA_LABEL_FIELD_ID', 'ID');
define('CREFUND_SHOW_DATA_LABEL_FIELD_DATE_ADDED', 'Fecha');
define('CREFUND_SHOW_DATA_LABEL_FIELD_ID_USER_ADD', 'Usuario');
define('CREFUND_SHOW_DATA_LABEL_FIELD_ID_SALE', 'Venta');
define('CREFUND_SHOW_DATA_LABEL_FIELD_REASON', 'Motivo');
define('CREFUND_SHOW_DATA_LABEL_FIELD_DETAIL', 'Descripci&oacute;n');
define('CREFUND_SHOW_DATA_LABEL_FIELD_TYPE', 'Tipo');
define('CREFUND_SHOW_DATA_LABEL_FIELD_AMOUNT', 'Monto');
define('CREFUND_SHOW_DATA_LABEL_FIELD_PRODUCTS', 'Productos');
define('CREFUND_SHOW_DATA_BACK_BTN', 'Volver');
define('CREFUND_SEARCH_FORM_LABEL_FIELD_ID', 'ID');
define('CREFUND_SEARCH_FORM_LABEL_FIELD_DATE_ADDED', 'Fecha');
define('CREFUND_SEARCH_FORM_LABEL_FIELD_ID_USER_ADD', 'Usuario');
define('CREFUND_SEARCH_FORM_LABEL_FIELD_ID_SALE', 'Venta');
define('CREFUND_SEARCH_FORM_LABEL_FIELD_REASON', 'Motivo');
define('CREFUND_SEARCH_FORM_LABEL_FIELD_DETAIL', 'Descripci&oacute;n');
define('CREFUND_SEARCH_FORM_LABEL_FIELD_TYPE', 'Tipo');
define('CREFUND_SEARCH_FORM_LABEL_FIELD_AMOUNT', 'Monto');
define('CREFUND_SEARCH_FORM_SUBMIT_BTN', 'Buscar');
define('CREFUND_SHOW_QUERY_HEAD_FIELD_ID', 'ID');
define('CREFUND_SHOW_QUERY_HEAD_FIELD_DATE_ADDED', 'Fecha');
define('CREFUND_SHOW_QUERY_HEAD_FIELD_ID_USER_ADD', 'Usuario');
define('CREFUND_SHOW_QUERY_HEAD_FIELD_ID_SALE', 'Venta');
define('CREFUND_SHOW_QUERY_HEAD_FIELD_REASON', 'Motivo');
define('CREFUND_SHOW_QUERY_HEAD_FIELD_DETAIL', 'Descripci&oacute;n');
define('CREFUND_SHOW_QUERY_HEAD_FIELD_TYPE', 'Tipo');
define('CREFUND_SHOW_QUERY_HEAD_FIELD_AMOUNT', 'Monto');
define('CREFUND_SHOW_QUERY_NOT_FOUND', 'No se encontraron registros');
define('CREFUND_SHOW_QUERY_SELECT_ALL', 'Seleccionar todos');
define('CREFUND_SHOW_QUERY_HEAD_FIELD_PRODUCTS', 'Productos');

define('CREFUND_PRODUCT_HAS_SALE_AFTER_REFUND', 'No est&aacute; definido el identificador de la venta o del producto');
?>