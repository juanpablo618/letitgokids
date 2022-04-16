<?php
session_start();
require_once ('../include/config.php');
require_once ('../include/functions.php');
require_once ('../include/adodb5/adodb.inc.php');
require_once ('../include/Cbase.php');
require_once ('../include/Cuser.php');

//Para controlar permisos
require_once ('../include/Cgroup.php');
require_once ('../include/Cgroupxpermission.php');
require_once ('../include/Cpermission.php');

require_once ('interface.php');

$dbConn = DBConnect();
$user	= new Cuser($dbConn);

require_once ('../include/Cproduct.php');
require_once ('../include/Cprovider.php');
require_once ('../include/Ccategory.php');
require_once ('../include/Cdate.php');
require_once ('../include/Cdetail.php');
require_once ('../include/Cphoto.php');
require_once ('../include/Cfile.php');


$product    = new Cproduct();
$all        = $product->getList('', 0, 0, 'id ASC');
$i          = 0;
$end        = $product->getLastId();
$TOTAL      = 0;
for($j = 0; $j < $end; $j++)
{
    $index = $j + 1;
    if($index == $all[$i]['id'])
    {
        echo '<div style="display: inline-block; border: 1px solid #999; padding: 10px; margin: 5px;">'.$index.' == '.$all[$i]['id'].' - '.$all[$i]['name'].'</div>';
        $i++;
    }
    else
    {
        echo '<div style="display: inline-block; border: 1px solid #999; padding: 10px; margin: 5px; background-color: red; color: #FFF; font-weight: bold;">No está el ID: '.$index.'</div>';
        $TOTAL++;
    }
}


echo '<div style="display: block; border: 1px solid #999; padding: 10px; margin: 5px; background-color: green; color: #FFF; font-weight: bold;">TOTAL de borrados: '.$TOTAL.'</div>';
?>