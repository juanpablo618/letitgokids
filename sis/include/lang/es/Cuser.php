<?php
/**
 * Archivo de lenguaje de la clase Cuser.php
 * 
 * @package EVOIT
 * @author {@link http://www.evoit.com/ EVO I.T.}
 * @copyright {@link http://www.evoit.com/ EVO I.T.}
 * @version v4.4:03-07-2019
 */
define('CUSER_SETID_REQUIRED_VALUE', 'Ingrese el valor &quot;ID&quot;');
define('CUSER_SETID_VALIDATE_VALUE', 'El valor &quot;ID&quot; es incorrecto');
define('CUSER_SETUSER_REQUIRED_VALUE', 'Ingrese el valor &quot;Usuario&quot;');
define('CUSER_SETUSER_VALIDATE_VALUE', 'El valor &quot;Usuario&quot; es incorrecto');
define('CUSER_SETPASS_REQUIRED_VALUE', 'Ingrese el valor &quot;Contrase&ntilde;a&quot;');
define('CUSER_SETID_GROUP_REQUIRED_VALUE', 'Ingrese el valor &quot;Grupo&quot;');
define('CUSER_SETID_GROUP_VALIDATE_VALUE', 'El valor &quot;Grupo&quot; es incorrecto');
define('CUSER_SETACTIVE_REQUIRED_VALUE', 'Ingrese el valor &quot;Activo&quot;');
define('CUSER_SETNAME_REQUIRED_VALUE', 'Ingrese el valor &quot;Nombre&quot;');
define('CUSER_SETLASTNAME_REQUIRED_VALUE', 'Ingrese el valor &quot;Apellido&quot;');
define('CUSER_SETEMAIL_REQUIRED_VALUE', 'Ingrese el valor &quot;Email&quot;');
define('CUSER_SETEMAIL_VALIDATE_VALUE', 'El valor &quot;Email&quot; es incorrecto');
define('CUSER_SETID_PROVIDER_VALIDATE_VALUE', 'El valor &quot;Proveedor/Cliente&quot; es incorrecto');
define('CUSER_GET_VALUES_ACTIVE_VALUE_1', 'S&iacute;');
define('CUSER_GET_VALUES_ACTIVE_VALUE_2', 'No');
define('CUSER_ADD_ERROR', 'No se pudo insertar el registro');
define('CUSER_UPDATE_ERROR', 'No se pudo actualizar el registro');
define('CUSER_UPDATE_REQUIRED_PK', 'No est&aacute; definido el identificador del registro que se quiere actualizar');
define('CUSER_DEL_ERROR', 'No se pudo eliminar el registro');
define('CUSER_DEL_REQUIRED_PK', 'No est&aacute; definido el identificador del registro que se quiere eliminar');
define('CUSER_GETDATA_ERROR', 'No se pudo obtener el registro');
define('CUSER_GETDATA_REQUIRED_PK', 'No est&aacute; definido el identificador del registro que se quiere obtener');
define('CUSER_GETLIST_ERROR', 'No se pudo realizar la consulta');
define('CUSER_GETLIST_TOTAL_LIST_ERROR', 'No se pudo obtener el n&uacute;mero total de registros de la consulta');
define('CUSER_EXIST_USER_EXIST', 'El valor &quot;Usuario&quot; ingresado ya existe');
define('CUSER_EXIST_USER_ERROR', 'No se pudo verificar la existencia del valor &quot;Usuario&quot; ingresado');
define('CUSER_EXIST_EMAIL_EXIST', 'El valor &quot;Email&quot; ingresado ya existe');
define('CUSER_EXIST_EMAIL_ERROR', 'No se pudo verificar la existencia del valor &quot;Email&quot; ingresado');
define('CUSER_EXIST_ID_PROVIDER_EXIST', 'El valor &quot;Proveedor/Cliente&quot; ingresado ya existe');
define('CUSER_EXIST_ID_PROVIDER_ERROR', 'No se pudo verificar la existencia del valor &quot;Proveedor/Cliente&quot; ingresado');
define('CUSER_CAN_DELETE_ERROR', 'No se pudo verificar si se puede eliminar el registro');
define('CUSER_CAN_DELETE_ADMIN', 'No se pude borrar este usuario porque es el administrador general');
define('CUSER_CAN_DELETE_CANT_MOVEMENT', 'El registro no se pudo eliminar porque est&aacute; relacionado con uno o m&aacute;s &quot;movimientos&quot;');
define('CUSER_CAN_DELETE_CANT_PRODUCT', 'El registro no se pudo eliminar porque est&aacute; relacionado con uno o m&aacute;s &quot;productos&quot;');
define('CUSER_CAN_DELETE_CANT_SALE', 'El registro no se pudo eliminar porque est&aacute; relacionado con uno o m&aacute;s &quot;ventas&quot;');
define('CUSER_CAN_DELETE_REQUIRED_PK', 'No est&aacute; definido el identificador del registro');
define('CUSER_GET_LAST_ID_ERROR', 'No se pudo obtener el &uacute;ltimo identificador');
define('CUSER_ADD_FORM_OK', 'El registro fue insertado correctamente');
define('CUSER_ADD_FORM_OK_BTN', 'Continuar');
define('CUSER_ADD_FORM_BACK_BTN', 'Volver');
define('CUSER_ADD_FORM_LABEL_FIELD_USER', 'Usuario');
define('CUSER_ADD_FORM_LABEL_FIELD_PASS', 'Contrase&ntilde;a');
define('CUSER_ADD_FORM_LABEL_FIELD_ID_GROUP', 'Grupo');
define('CUSER_ADD_FORM_LABEL_FIELD_ACTIVE', 'Activo');
define('CUSER_ADD_FORM_LABEL_FIELD_TOKEN', 'Token');
define('CUSER_ADD_FORM_LABEL_FIELD_NAME', 'Nombre');
define('CUSER_ADD_FORM_LABEL_FIELD_LASTNAME', 'Apellido');
define('CUSER_ADD_FORM_LABEL_FIELD_EMAIL', 'Email');
define('CUSER_ADD_FORM_LABEL_FIELD_ID_PROVIDER', 'Proveedor/Cliente');
define('CUSER_ADD_FORM_LABEL_FIELD_SENDEMAIL', 'Enviar un email informando el usuario y contraseña.');
define('CUSER_ADD_FORM_SUBMIT_BTN', 'Aceptar');
define('CUSER_ADD_FORM_CANCEL_BTN', 'Cancelar');
define('CUSER_ADD_FORM_LABEL_REQUIRED', 'Requeridos');
define('CUSER_UPDATE_FORM_OK', 'El registro fue actualizado correctamente');
define('CUSER_UPDATE_FORM_OK_BTN', 'Continuar');
define('CUSER_UPDATE_FORM_BACK_BTN', 'Volver');
define('CUSER_UPDATE_FORM_LABEL_FIELD_ID', 'ID');
define('CUSER_UPDATE_FORM_LABEL_FIELD_USER', 'Usuario');
define('CUSER_UPDATE_FORM_LABEL_FIELD_PASS', 'Contrase&ntilde;a');
define('CUSER_UPDATE_FORM_LABEL_FIELD_ID_GROUP', 'Grupo');
define('CUSER_UPDATE_FORM_LABEL_FIELD_ACTIVE', 'Activo');
define('CUSER_UPDATE_FORM_LABEL_FIELD_TOKEN', 'Token');
define('CUSER_UPDATE_FORM_LABEL_FIELD_NAME', 'Nombre');
define('CUSER_UPDATE_FORM_LABEL_FIELD_LASTNAME', 'Apellido');
define('CUSER_UPDATE_FORM_LABEL_FIELD_EMAIL', 'Email');
define('CUSER_UPDATE_FORM_LABEL_FIELD_ID_PROVIDER', 'Proveedor/Cliente');
define('CUSER_UPDATE_FORM_SUBMIT_BTN', 'Aceptar');
define('CUSER_UPDATE_FORM_CANCEL_BTN', 'Cancelar');
define('CUSER_UPDATE_FORM_LABEL_REQUIRED', 'Requeridos');
define('CUSER_UPDATE_FORM_ADMIN', 'El administrador no puede cambiar de grupo');
define('CUSER_UPDATE_FORM_SET_PASSWORD', 'Si quiere enviar los datos de acceso debe ingresar una contraseña nueva.');
define('CUSER_DEL_FORM_OK', 'El registro fue eliminado correctamente');
define('CUSER_DEL_FORM_OK_BTN', 'Continuar');
define('CUSER_DEL_FORM_ADMIN', 'No se puede borrar el usuario administrador');
define('CUSER_DEL_FORM_BACK_BTN', 'Volver');
define('CUSER_DEL_GROUP_FORM_REQUIRED_PK', 'Debe seleccionar uno a m&aacute;s registros para eliminar');
define('CUSER_DEL_GROUP_FORM_OK', 'Los registros fueron eliminados correctamente');
define('CUSER_DEL_GROUP_FORM_OK_BTN', 'Continuar');
define('CUSER_DEL_GROUP_FORM_CANT_DELETE_ALL', 'Algunos registros no fueron eliminados');
define('CUSER_DEL_GROUP_FORM_BACK_BTN', 'Volver');
define('CUSER_DEL_GROUP_FORM_ADMIN', 'No se puede borrar el usuario administrador');
define('CUSER_SHOW_DATA_LABEL_FIELD_ID', 'ID');
define('CUSER_SHOW_DATA_LABEL_FIELD_USER', 'Usuario');
define('CUSER_SHOW_DATA_LABEL_FIELD_PASS', 'Contrase&ntilde;a');
define('CUSER_SHOW_DATA_LABEL_FIELD_ID_GROUP', 'Grupo');
define('CUSER_SHOW_DATA_LABEL_FIELD_ACTIVE', 'Activo');
define('CUSER_SHOW_DATA_LABEL_FIELD_TOKEN', 'Token');
define('CUSER_SHOW_DATA_LABEL_FIELD_NAME', 'Nombre');
define('CUSER_SHOW_DATA_LABEL_FIELD_LASTNAME', 'Apellido');
define('CUSER_SHOW_DATA_LABEL_FIELD_EMAIL', 'Email');
define('CUSER_SHOW_DATA_LABEL_FIELD_ID_PROVIDER', 'Proveedor/Cliente');
define('CUSER_SHOW_DATA_BACK_BTN', 'Volver');
define('CUSER_SEARCH_FORM_LABEL_FIELD_ID', 'ID');
define('CUSER_SEARCH_FORM_LABEL_FIELD_USER', 'Usuario');
define('CUSER_SEARCH_FORM_LABEL_FIELD_PASS', 'Contrase&ntilde;a');
define('CUSER_SEARCH_FORM_LABEL_FIELD_ID_GROUP', 'Grupo');
define('CUSER_SEARCH_FORM_LABEL_FIELD_ACTIVE', 'Activo');
define('CUSER_SEARCH_FORM_LABEL_FIELD_TOKEN', 'Token');
define('CUSER_SEARCH_FORM_LABEL_FIELD_NAME', 'Nombre');
define('CUSER_SEARCH_FORM_LABEL_FIELD_LASTNAME', 'Apellido');
define('CUSER_SEARCH_FORM_LABEL_FIELD_EMAIL', 'Email');
define('CUSER_SEARCH_FORM_LABEL_FIELD_ID_PROVIDER', 'Proveedor/Cliente');
define('CUSER_SEARCH_FORM_SUBMIT_BTN', 'Buscar');
define('CUSER_SHOW_QUERY_HEAD_FIELD_ID', 'ID');
define('CUSER_SHOW_QUERY_HEAD_FIELD_USER', 'Usuario');
define('CUSER_SHOW_QUERY_HEAD_FIELD_PASS', 'Contrase&ntilde;a');
define('CUSER_SHOW_QUERY_HEAD_FIELD_ID_GROUP', 'Grupo');
define('CUSER_SHOW_QUERY_HEAD_FIELD_ACTIVE', 'Activo');
define('CUSER_SHOW_QUERY_HEAD_FIELD_TOKEN', 'Token');
define('CUSER_SHOW_QUERY_HEAD_FIELD_NAME', 'Nombre');
define('CUSER_SHOW_QUERY_HEAD_FIELD_LASTNAME', 'Apellido');
define('CUSER_SHOW_QUERY_HEAD_FIELD_EMAIL', 'Email');
define('CUSER_SHOW_QUERY_HEAD_FIELD_ID_PROVIDER', 'Proveedor/Cliente');
define('CUSER_SHOW_QUERY_NOT_FOUND', 'No se encontraron registros');
define('CUSER_SHOW_QUERY_SELECT_ALL', 'Seleccionar todos');
define('CUSER_LOGIN_ADMIN_WRONG_VALUES', 'Usuario o Contrase&ntilde;a incorrectos');
define('CUSER_LOGIN_USER_ERROR', 'No se pudo verificar la existencia de los valores ingresados');
define('CUSER_LOGIN_ADMIN_ERROR', 'No se pudo verificar la existencia de los valores ingresados');
define('CUSER_LOGIN_ADMIN_REQUIRED_VALUES', 'Ingrese los valores de Usuario y Contrase&ntilde;a');
define('CUSER_UPDATE_PROFILE_FORM_REQUIRED_PASS_ACTUAL', 'Ingrese el valor &quot;Contrase&ntilde;a Actual&quot;');
define('CUSER_UPDATE_PROFILE_FORM_WRONG_PASS_ACTUAL', 'El valor &quot;Contrase&ntilde;a Actual&quot; es incorrecto');
define('CUSER_UPDATE_PROFILE_FORM_REQUIRED_PASS_CONFIRM', 'Ingrese el valor &quot;Confirmar Contrase&ntilde;a&quot;');
define('CUSER_UPDATE_PROFILE_FORM_WRONG_PASS_CONFIRM', 'El valor &quot;Contrase&ntilde;a&quot; y su confirmaci&oacute;n no coinciden');
define('CUSER_UPDATE_PROFILE_FORM_OK', 'El perfil fue actualizado correctamente');
define('CUSER_UPDATE_PROFILE_FORM_OK_BTN', 'Continuar');
define('CUSER_UPDATE_PROFILE_FORM_BACK_BTN', 'Volver');
define('CUSER_UPDATE_PROFILE_FORM_LABEL_FIELD_USER', 'Usuario');
define('CUSER_UPDATE_PROFILE_FORM_LABEL_FIELD_PASS_ACTUAL', 'Contrase&ntilde;a Actual');
define('CUSER_UPDATE_PROFILE_FORM_LABEL_FIELD_PASS', 'Contrase&ntilde;a (Nueva)');
define('CUSER_UPDATE_PROFILE_FORM_LABEL_FIELD_PASS_CONFIRM', 'Confirmar Contrase&ntilde;a');
define('CUSER_UPDATE_PROFILE_FORM_LABEL_REQUIRED', 'Requeridos');
define('CUSER_UPDATE_PROFILE_FORM_SUBMIT_BTN', 'Aceptar');
define('CUSER_UPDATE_PROFILE_FORM_CANCEL_BTN', 'Cancelar');

define('CUSER_SENDEMAIL_SUBJECT', 'Contacto desde DESMADRE.');
define('CUSER_SENDEMAIL_SETEMAIL_VALIDATE_VALUE', 'Debe ingresar el valor Email.');
define('CUSER_SENDEMAIL_SETEMAIL_NOT_SENT', 'No se pudo enviar el email.');
define('CUSER_SENDEMAIL_TEXT_BODY', 'Estimada #userName#'."\n\r\n\r".'
Hola! Abajo están los datos que necesitas para acceder al sistema de letitgo.kids . Allí podrás ver  el estado de tu cuenta con información actualizada de tus productos. Recordá que los días 10 de cada mes rendimos lo que se haya vendido el mes anterior.'."\n\r".'
URL: #siteURL#'."\n\r".'
Usuario: #userUser#'."\n\r".'
Contraseña: #userPass#'."\n\r\n\r".'
Te recomendamos tener a mano esta información.');
?>