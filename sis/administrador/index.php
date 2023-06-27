<?php
session_start();
require_once ('../include/config.php');
require_once ('../include/functions.php');
require_once ('../include/adodb5/adodb.inc.php');
require_once ('../include/Cbase.php');
require_once ('../include/Cuser.php');
require_once ('../include/Clog.php');
require_once ('../include/Cdate.php');

require_once ('interface.php');

$msg = '';
if (!isset($_POST['login']))
{
	$_POST['login'] = '';
}

if ($_POST['login'] == 'login')
{
	$dbConn = DBConnect();

	$user = new Cuser($dbConn);

	//Elimino espacios y pongo todo en minúscula
	$user->setUser(strtolower(trim($_POST['user'])), TRUE);
	$user->setPass(trim($_POST['pass']), TRUE);

	if ($user->loginUser() === TRUE)
	{
	    $log = new Clog($dbConn);

	    $log->setIdUser($user->getId(FALSE));
	    $log->setDate(date('Y-m-d'), TRUE);
	    $log->setHour(date('H:i:s'));
	    $log->setAction('login');
	    $log->add();

	    //header('location: main.php');
		echo '<script>window.location.href = "main.php";</script>';

	    exit;
	}
	else
	{
	    $msg = '<div class="message error"><ul><li>Usuario o Contrase&ntilde;a incorrectos</li></ul></div>';
	}
}

doctype();
?>
<html>
<head>
	<?php
	head();
	?>
</head>
<body onload="setFocus('user')">
<?php
open(TRUE);
?>

	<div class="form login">
		<div class="title">
			<div class="label">Iniciar sesi&oacute;n</div>
		</div>
		<div class="top"></div>
		<form name="formLogin" id="formLogin" method="post" action="">
		<input name="login" type="hidden" id="login" value="login" />
		<div class="fields">
			<div class="field">
				<input name="user" type="text" id="user" class="str" maxlength="100" placeholder="Usuario" />
			</div>
            <div class="field">
				<input name="pass" type="password" id="pass" class="str" maxlength="100" placeholder="Contrase&ntilde;a" />
			</div>
            <?php echo $msg; ?>
        </div>
		<div class="middle"></div>
		<div class="buttons">
			<input type="submit" value="Ingresar" class="login" />
		</div>
		</form>
		<div class="bottom"></div>
	</div>

<?php
close();
?>
</body>
</html>