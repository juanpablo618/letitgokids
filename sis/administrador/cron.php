<?php
define('IS_LOCALHOST', FALSE); //Define si es un entorno local o "arriba" (puede ser en producción o prueba)
define('IS_TEST', FALSE); //Si estoy en prducción (IS_LOCALHOST == FALSE), esto define si es entorno de pruebas o producción

if(IS_LOCALHOST == TRUE)
{
    $pathToSite = 'D:\\AppServ\\www\\letitgo-modacircular.com\\sis\\'; //Locahost
}
else
{
    if(IS_TEST == TRUE)
    {
        $pathToSite = '/home/letitgok/public_html/prueba/'; //Arriba Prueba
    }
    else
    {
        $pathToSite = '/home/letitgok/public_html/sis/'; //Arriba
    }
}

require_once ($pathToSite.'include/config.php');
require_once (SITE_PATH.'include/functions.php');
require_once (SITE_PATH.'include/adodb5/adodb.inc.php');
require_once (SITE_PATH.'include/Cbase.php');
require_once (SITE_PATH.'include/Cproduct.php');
require_once (SITE_PATH.'include/Ccategory.php');
require_once (SITE_PATH.'include/Cuser.php');
require_once (SITE_PATH.'include/Cprovider.php');
require_once (SITE_PATH.'include/Cdate.php');
require_once (SITE_PATH.'include/Ccron.php');
require_once (SITE_PATH.'include/Cdetail_payment.php');
require_once (SITE_PATH.'include/Csale.php');
require_once (SITE_PATH.'include/Cmovement.php');
require_once (SITE_PATH.'include/phpmailer/class.phpmailer.php');

$dbConn = DBConnect();

$cron    = new Ccron($dbConn);
$product = new Cproduct($dbConn);

$arrText['exhibited']['singular']    = 'Se cargó el siguiente producto';
$arrText['exhibited']['plural']      = 'Se cargaron los siguientes productos';

$arrText['sold']['singular']         = 'Se vendió el siguiente producto';
$arrText['sold']['plural']           = 'Se vendieron los siguientes productos';
$arrText['to_pay']['singular']       = 'Se vendió el siguiente producto';
$arrText['to_pay']['plural']         = 'Se vendieron los siguientes productos';

$arrText['give_back']['singular']    = 'Se pasó al estado "Para Devolver" el siguiente producto';
$arrText['give_back']['plural']      = 'Se pasaron al estado "Para Devolver" los siguientes productos';

$arrText['returned']['singular']     = 'Se te devolvió el siguiente producto';
$arrText['returned']['plural']       = 'Se te devolvieron los siguientes productos';

$arrText['paid_out']['singular']     = 'Se te pagó #payment# por la venta del siguiente producto';
$arrText['paid_out']['plural']       = 'Se te pagó #payment# por la venta de los siguientes productos';

$arrText['donate']['singular']     = 'Se donó el siguiente producto';
$arrText['donate']['plural']       = 'Se donaron los siguientes productos';

//De acuerdo a tu autorización, se han donado los siguientes productos:

if($cron->setDateAdded(date(FORMAT_DATE), FALSE) == TRUE and $cron->existCron() == FALSE)
{
    //Envia cambios de estados
    $arraySend = array();

    $search = $product->getFieldSql('date_change_status', $product->getTableName()).' > '.$product->getValueSql('0000-00-00').' AND '.$product->getFieldSql('date_change_status', $product->getTableName()).'='.$product->getValueSql(date('Y-m-d', strtotime("-1 day")));
    $order  = $product->getFieldSql('id_provider', $product->getTableName()).' ASC, '.$product->getFieldSql('status', $product->getTableName()).' ASC';
    $list   = $product->getList($search, NULL, NULL, $order);

    if ($product->getTotalList() > 0)
    {
        foreach ($list as $row)
        {
            $arraySend[$row['idProvider']][$row['status']][] = $row['id'];
        }
    }

    if(count($arraySend) > 0)
    {
        $html = file_get_contents(HTML_PATH.HTML_PROVIDER_TEMPLATE);
        foreach($arraySend as $key => $value)
        {
            $provider = new Cprovider($dbConn);
            $provider->setId($key);

            $provider->getData();
            if(IS_LOCALHOST == TRUE)
            {
                //$provider->setEmail(); //ABAJO federico
            }
            else
            {
                if(IS_TEST == TRUE)
                {
                    //$provider->setId(27); //Arriba Prueba Agustin
                    //$provider->setId(292); //Arriba Prueba Fede
                    //$provider->setEmail('fedenuche@gmail.com');
                    $provider->setEmail('agarciaastrada@gmail.com');
                }
            }

            if(empty($provider->getEmail(FALSE)) == FALSE)
            {
                $auxProds = getTxtToSend($value);

                $mail		    = new phpmailer();
                $mail->Subject  = CUSER_SENDEMAIL_SUBJECT;
                $mail->FromName = CONTACT_NAME;
                $mail->From     = CONTACT_EMAIL;
                $mail->AddReplyTo(CONTACT_EMAIL);
                $mail->AddAddress($provider->getEmail(FALSE));
                $mail->Sender   = CONTACT_SENDER;
                $mail->Mailer   = 'smtp';
                $mail->CharSet  = $product->getCharset();

                $mail->Host     = CONTACT_SMTP_HOST;
                $mail->SMTPAuth = TRUE;
                $mail->Username = CONTACT_SMTP_USER;
                $mail->Password = CONTACT_SMTP_PASS;
                $mail->Port     = CONTACT_SMTP_PORT;
                $mail->SMTPDebug = TRUE;


                //Agrego las imganes adjuntas
                $mail->AddEmbeddedImage(ADMIN_PATH.'img'.FILE_SLASH.'logo.png', 'logo', 'logo.png');


                $arrValues['products']      = $auxProds;
                $arrValues['user_name']     = $provider->getName();
                $content                    = $product->processTags($arrValues, $html);

                $mail->Body     = $content;
                $mail->AltBody  = 'Por favor, active la vista HTML para ver este mensaje.';
                $result		    = $mail->Send();

                $mail->ClearAddresses();
                $mail->ClearReplyTos();
                $mail->ClearAttachments();
            }
        }
    }

    $cron->add();
}

function getTxtToSend($prods)
{
    global $dbConn, $arrText;

    $mssg           = '';
    $product        = new Cproduct($dbConn);
    $detail_payment = new Cdetail_payment($dbConn);
    foreach($prods as $key => $prod)
    {
        if($key == 'paid_out')
        {
            $search = $detail_payment->getFieldSql('id_product', $detail_payment->getTableName()).' IN ('.implode(', ', $prod).')';
            $list   = $detail_payment->getList($search);

            $total = array();

            $auxMssg = '';
            if (is_array($list) === TRUE and count($list) > 0)
            {
                $auxMssg .= '<ul>';
                foreach($list as $val)
                {
                    $movement = new Cmovement($dbConn);
                    $movement->setIdPayment($val['idPayment']);
                    $movement->getDataByIdPayment();
                    $auxMssg .= '<li>'.$val['productName'].' ($'.numberFormat($val['amount']).' en '.$movement->getValuesTypePay($movement->getTypePay()).')'.'.</li>';

                    if(isset($total[$movement->getTypePay()]) == FALSE)
                    {
                        $total[$movement->getTypePay()] = $val['amount'];
                    }
                    else
                    {
                        $total[$movement->getTypePay()] += $val['amount'];
                    }
                }
                $auxMssg .= '</ul>';

                if(count($prod) > 1)
                {
                    $auxTitle = $arrText[$key]['plural'];
                }
                else
                {
                    $auxTitle = $arrText[$key]['singular'];
                }

                $paymentText    = '';
                $count          = count($total);
                $aux            = '';
                $i              = 1;
                foreach ($total as $key2 => $val2)
                {
                    $paymentText .= $aux.' $'.numberFormat($val2).' en '.$movement->getValuesTypePay($key2);
                    $aux = ', ';
                    $i++;
                    if($i == $count)
                    {
                        $aux = ' y ';
                    }
                }

                $arrValues['payment']      = $paymentText;
                $auxTitle                  = $product->processTags($arrValues, $auxTitle);

                $mssg .= '<b>'.$auxTitle.':</b><br />';
                $mssg .= $auxMssg;
            }
        }
        else
        {
            if(count($prod) > 1)
            {
                $mssg .= '<b>'.$arrText[$key]['plural'].':</b><br />';
            }
            else
            {
                $mssg .= '<b>'.$arrText[$key]['singular'].':</b><br />';
            }

            $search = $product->getFieldSql('id', $product->getTableName()).' IN ('.implode(', ', $prod).')';
            $list   = $product->getList($search);

            $mssg .= '<ul>';
            if (is_array($list) === TRUE and count($list) > 0)
            {
                foreach($list as $val)
                {
                    $mssg .= '<li>'.$val['name'].'.</li>';
                }
            }
            $mssg .= '</ul>';
        }


    }

    return $mssg;
}
?>
