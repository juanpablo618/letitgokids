<?php
/**
 * Este archivo contiene el array en donde se define el menú del administrador
 */

//Inicio
$m = 0;
$items0[$m]['item']     = 'Inicio';
$items0[$m]['href']     = 'main.php';
$items0[$m]['id']       = 'mn-main';
$items0[$m]['subitems'] = FALSE;
$m++;

//Productos
$items0[$m]['item']     = 'Productos';
$items0[$m]['href']     = '';
$items0[$m]['id']       = 'mn-product';

    $n = 0;
    $items1[$n]['item']  = 'Agregar producto';
    $items1[$n]['href']  = 'product-add.php';
    $items1[$n]['id']    = '';
    $items1[$n]['class'] = 'add';
    $n++;

    $items1[$n]['item']  = 'Listado de productos';
    $items1[$n]['href']  = 'product-query.php';
    $items1[$n]['id']    = '';
    $items1[$n]['class'] = '';
    $n++;

    $items1[$n]['sep']  = TRUE;
    $n++;

    $items1[$n]['item']  = 'Agregar categoría';
    $items1[$n]['href']  = 'category-add.php';
    $items1[$n]['id']    = '';
    $items1[$n]['class'] = 'add';
    $n++;

    $items1[$n]['item']  = 'Listado de categorías';
    $items1[$n]['href']  = 'category-query.php';
    $items1[$n]['id']    = '';
    $items1[$n]['class'] = '';
    $n++;

    $items1[$n]['sep']  = TRUE;
    $n++;

    $items1[$n]['item']  = 'Agregar venta';
    $items1[$n]['href']  = 'sale-add.php';
    $items1[$n]['id']    = '';
    $items1[$n]['class'] = 'add';
    $n++;

    $items1[$n]['item']  = 'Listado de ventas';
    $items1[$n]['href']  = 'sale-query.php';
    $items1[$n]['id']    = '';
    $items1[$n]['class'] = '';
    $n++;

    $items1[$n]['item']  = 'Listado de productos vendidos';
    $items1[$n]['href']  = 'product-query-sell.php';
    $items1[$n]['id']    = '';
    $items1[$n]['class'] = '';
    $n++;

    $items1[$n]['sep']  = TRUE;
    $n++;

    $items1[$n]['item']  = 'Listado de devoluciones';
    $items1[$n]['href']  = 'refund-query.php';
    $items1[$n]['id']    = '';
    $items1[$n]['class'] = '';
    $n++;

$items0[$m]['subitems'] = $items1;
$items0[$m]['position'] = 'right';
unset($items1);
$m++;

//Usuarios
$items0[$m]['item']     = 'Proveedores / Clientes';
$items0[$m]['href']     = '';
$items0[$m]['id']       = 'mn-user';

    $n = 0;

    $items1[$n]['item']  = 'Agregar proveedor/cliente';
    $items1[$n]['href']  = 'provider-add.php';
    $items1[$n]['id']    = '';
    $items1[$n]['class'] = 'add';
    $n++;

    $items1[$n]['item']  = 'Listado de proveedores/clientes';
    $items1[$n]['href']  = 'provider-query.php';
    $items1[$n]['id']    = '';
    $items1[$n]['class'] = '';
    $n++;

    $items1[$n]['sep']  = TRUE;
    $n++;

    $items1[$n]['item']  = 'Rendir productos';
    $items1[$n]['href']  = 'provider-pay-products.php';
    $items1[$n]['id']    = '';
    $items1[$n]['class'] = 'add';
    $n++;

    $items1[$n]['item']  = 'Listado de rendiciones';
    $items1[$n]['href']  = 'payment-query.php';
    $items1[$n]['id']    = '';
    $items1[$n]['class'] = '';
    $n++;

$items0[$m]['subitems'] = $items1;
$items0[$m]['position'] = 'right';
unset($items1);
$m++;

//Caja
$items0[$m]['item']     = 'Movimientos';
$items0[$m]['href']     = '';
$items0[$m]['id']       = 'mn-movement';

    $n = 0;
    $items1[$n]['item']  = 'Agregar movimiento';
    $items1[$n]['href']  = 'movement-add.php';
    $items1[$n]['id']    = '';
    $items1[$n]['class'] = 'add';
    $n++;

    $items1[$n]['item']  = 'Listado de movimientos';
    $items1[$n]['href']  = 'movement-query.php';
    $items1[$n]['id']    = '';
    $items1[$n]['class'] = '';
    $n++;

$items0[$m]['subitems'] = $items1;
$items0[$m]['position'] = 'right';
unset($items1);
$m++;

//Usuarios
$items0[$m]['item']     = 'Usuarios';
$items0[$m]['href']     = '';
$items0[$m]['id']       = 'mn-user';

    $n = 0;
    $items1[$n]['item']  = 'Agregar usuario';
    $items1[$n]['href']  = 'user-add.php';
    $items1[$n]['id']    = '';
    $items1[$n]['class'] = 'add';
    $n++;

    $items1[$n]['item']  = 'Listado de usuarios';
    $items1[$n]['href']  = 'user-query.php';
    $items1[$n]['id']    = '';
    $items1[$n]['class'] = '';
    $n++;

$items0[$m]['subitems'] = $items1;
$items0[$m]['position'] = 'right';
unset($items1);
$m++;

//Reportes
$items0[$m]['item']     = 'Reportes';
$items0[$m]['href']     = '';
$items0[$m]['id']       = 'mn-report';

    $n = 0;
    $items1[$n]['item']  = 'Estado de caja';
    $items1[$n]['href']  = 'report-cash-flow.php';
    $items1[$n]['id']    = '';
    $items1[$n]['class'] = 'list';
    $n++;

    $items1[$n]['item']  = 'Estados de cta. cte.';
    $items1[$n]['href']  = 'report-cta-cte.php';
    $items1[$n]['id']    = '';
    $items1[$n]['class'] = '';
    $n++;

    $items1[$n]['item']  = 'Estados por movimientos';
    $items1[$n]['href']  = 'report-expenditure.php';
    $items1[$n]['id']    = '';
    $items1[$n]['class'] = '';
    $n++;

    $items1[$n]['item']  = 'Productos a devolver';
    $items1[$n]['href']  = 'report-providers-back.php';
    $items1[$n]['id']    = '';
    $items1[$n]['class'] = '';
    $n++;

    $items1[$n]['item']  = 'Ingresos';
    $items1[$n]['href']  = 'log-query.php';
    $items1[$n]['id']    = '';
    $items1[$n]['class'] = '';
    $n++;


$items0[$m]['subitems'] = $items1;
$items0[$m]['position'] = 'right';
unset($items1);
$m++;

/**
 * PROVEEDORES
 */
//Reportes
$items0[$m]['item']     = 'Mi estado';
$items0[$m]['href']     = 'my-status.php';
$items0[$m]['id']       = 'mn-status';

$items0[$m]['subitems'] = FALSE;
$items0[$m]['position'] = 'right';
unset($items1);
$m++;
?>