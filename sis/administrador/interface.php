<?php
/**
 * Esta función imprime el doctype
 *
 */
function doctype()
{
?>
	<!DOCTYPE html>
<?php
}

/**
 * Esta función imprime líneas en el <head> como las clases de estilo, charset, etc.
 *
 */
function head()
{
    ?>
    <meta http-equiv="content-type" content="text/html; charset=<?php echo CHARSET; ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/style-oc.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/font-awesome-4.7.0/css/font-awesome.min.css" media="screen" />

    <script type="text/javascript" src="../scripts/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="../scripts/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>

    <?php
    if (CLASS_LANGUAGE != 'en')
    {
    ?>
    <script src="../scripts/datepicker-<?php echo CLASS_LANGUAGE; ?>.js"></script>
    <?php
    }
    ?>
    <script src="../scripts/admin.js"></script>
    <script src="../scripts/functions.js"></script>
    <!--[if lt IE 9]><script src="../scripts/html5shiv.min.js"></script><![endif]-->
    <title><?php echo ADMIN_TITLE; ?></title>
    <script type="text/javascript">
    $(document).ready(function() {
    	//Tooltips
    	$( '#content' ).tooltip({
    	    position: {
    		my: "center bottom-20",
    		at: "center top",
    		using: function( position, feedback ) {
    		    $( this ).css( position );
    		    $( "<div>" )
    		    .addClass( "arrowTooltip" )
    		    .addClass( feedback.vertical )
    		    .addClass( feedback.horizontal )
    		    .appendTo( this );
    		}
    	    }
    	});

    	//Autocomplete
    	$(".autocomplete").on( "keydown", function( event ) {
    	    if ( event.keyCode === $.ui.keyCode.TAB && $( this ).autocomplete( "instance" ).menu.active )
    	    {
    	        event.preventDefault();
    	    }
    	}).autocomplete({
    	    minLength: 2,
    	    autoFocus: true,
    	    source: function( request, response ) {
    		params = {id: $(this.element).attr("id"), term: request.term};
    		/*Veo qué parámetros debo incluir*/
    		if($('#idProvider').length > 0)
    		{
    		    params["idProvider"] = $('#idProvider').val()
    		}
    		if($('#searchFilter').length > 0)
    		{
    		    params["searchFilter"] = $('#searchFilter').val()
    		}

    		/*console.log($(this.element).attr("id"));*/
    		//params = {id: $(this.element).attr("id"), term: request.term, idClass: $('#idClass').val(), idCourse: $('#idCourse').val(), idStudent: $('#idStudent').val(), assistance: $('#assistance').val()};
    		$.ajax({
    		    dataType: "json",
    		    url: "autocomplete.php",
    		    data: params,
    		    method: "POST",
    		    success: function(data){
    			response( data );
    		    }
    		});
    	    },
    	    select: function( event, ui ) {
    		/**
    		 * Cuando selecciono un valor va a actualizar un hidden con el nombre del campo.
    		 *
    		 * Ejemplo:
    		 *
    		 * si tengo el campo #idStudent, el autocomplete debe llamarse #idStudentAutocoplete y #idStudent ser un hidden
    		 */
    		var str = $(this).attr("id");
    		var num = str.length;
    		var res = str.substr(0, (num - 12)); //menos la palabra Autocmoplete

    		/*Llamo al change*/
    		$("#" + res).val(ui.item.id).trigger( "change" );
    	    },
    	    change: function(event, ui){
    		var str = $(this).attr("id");
    		if(ui.item)
    		{
    		    $(this).val(ui.item.label);

    		    //Borro el producto seleccionado si cambia el proveedor
    		    var thisId = $(this).attr("id");
    		    if(thisId == "idProviderAutocomplete")
    		    {
        			$("#idProductAutocomplete").val("");
        			$("#idProduct").val("");
    		    }
    		}
    		else
    		{
    		    $(this).val("");

    		    var thisId = $(this).attr("id");

    		    if(thisId == "detail_idProductAutocomplete")
    		    {
    				$("#detail_amount").val("");
    		    }

    		    /**
    		    * Cuando selecciono un valor va a actualizar un hidden con el nombre del campo.
    		    *
    		    * Ejemplo:
    		    *
    		    * si tengo el campo #idStudent, el autocomplete debe llamarse #idStudentAutocoplete y #idStudent ser un hidden
    		    */
    		   var num = str.length;
    		   var res = str.substr(0, (num - 12)); //menos la palabra Autocmoplete

    		   $("#" + res).val("").trigger( "change" );
    		}
    	    }
    	});

    	$("#providerProductList").on("click", ".donate", function(e){

    		e.stopPropagation()

    	});

    	$("#providerProductList").on("change", ".donate", function(e){

			if($(this).val() == "yes")
			{
				var father = $(this).closest(".row");

				$("input[type=checkbox]", father).prop('checked', true);
			}
    	});
    });
    </script>
	<?php
}

/**
 * Esta función abre la interfaz
 *
 * @param boolean $login [opcional] indica si es la interfaz del login o no
 */
function open($login = FALSE, $boddyClass = '')
{
    if(empty($boddyClass) == FALSE)
    {
        $boddyClass = 'class="'.$boddyClass.'"';
    }
    ?>
    <div id="body"<?php echo $boddyClass; ?>>
        <header>
			<div class="wrapper">
				<div id="client">
					<div id="client-left" class="left"></div>
					<div id="client-name" class="left"><img src="<?php echo ADMIN_URL; ?>img/logo.png" /></div>
					<div id="client-right" class="left"></div>
				</div>
                <?php if ($login !== TRUE) : ?>
				<div id="logged">
					<a href="logout.php">Cerrar sesi&oacute;n</a>
					<a href="profile.php" class="profile"><?php echo getValue($_SESSION['userUser'], TRUE, CHARSET); ?></a>
				</div>
				<?php endif ?>
			</div>
        </header>

        <nav>
			<div class="wrapper">
                <?php if ($login !== TRUE) { menu(); } ?>
			</div>
		</nav>
        <div id="content">
            <div class="wrapper">

    <?php
}

/**
 * Esta función cierra la interfaz
 *
 */
function close()
{
	?>
            </div>
        </div>
        <footer>
        </footer>
    </div>
	<?php
}

/**
 * Esta función arma el menú (HTML)
 *
 */
function menu()
{
    require_once('menu.php');

    global $dbConn;

    $group = new Cgroup($dbConn);
    $group->setid($_SESSION['userIdGroup']);
    ?>
    <div id="btnMenu"><a href="#"></a></div>
    <ul id="menu">
    <?php
    $amount = count($items0);
    $menu   = '';

    for ($i = 0; $i < $amount; $i++)
    {
        if ($items0[$i]['subitems'] === FALSE)
        {
            //Necesito el nombre del archivo para controlar los permisos
            if(strstr($items0[$i]['href'], '?') != FALSE)
            {
                $part	    = explode('?', $items0[$i]['href']);
                $fileName   = $part[0];
            }
    	    else
    	    {
                $fileName   = $items0[$i]['href'];
    	    }

    	    //Controlo que el usuario tenga permiso para acceder al archivo
    	    if ($group->filePermission($fileName, TRUE))
    	    {
    	        $auxClass = '';
    	        if(isSelectedMenu($items0[$i]['href'], $items0[$i]['subitems']) == TRUE)
    	        {
    	            $auxClass = ' class="selected"';
    	        }
    	        $menu .= '<li><a href="'.$items0[$i]['href'].'" id="'.$items0[$i]['id'].'"'.$auxClass.'>'.getValue($items0[$i]['item'], TRUE, CHARSET).'</a></li>';
    	    }
        }
        else
        {
            $subMenu   = '';
            $ul		   = '';
            $sep	       = FALSE;
            if (isset($items0[$i]['position']) and $items0[$i]['position'] == 'right')  $ul = ' class="menu-right"';

            foreach ($items0[$i]['subitems'] as $subitems)
            {
        		if(isset($subitems['sep']) == TRUE and $subitems['sep'] == TRUE)
        		{
        		    $sep = TRUE;
        		}
        		else
        		{
        		    //Necesito el nombre del archivo para controlar los permisos
        		    if(strstr($subitems['href'], '?') != FALSE)
        		    {
            			$part	   = explode('?', $subitems['href']);
            			$fileName  = $part[0];
            		}
        		    else
        		    {
                        $fileName   = $subitems['href'];
        		    }

        		    if($sep == TRUE)
        		    {
            			$sep = FALSE;
            			$subitems['class'] .= ' sep';
        		    }

        		    if(empty($subitems['subitems']) == TRUE)
        		    {
        		        $subitems['subitems'] = array();
        		    }

        		    //Controlo que el usuario tenga permiso para acceder al archivo
        		    if ($group->filePermission($fileName, TRUE))
        		    {
        		        $subMenu .=  '<li><a href="'.$subitems['href'].'" id="'.$subitems['id'].'" class="'.$subitems['class'].'">'.$subitems['item'].'</a></li>';
        		    }
        		}
            }

    	    //Si no tiene permiso para ningún subitem no pongo el menú principal
    	    if(empty($subMenu) == FALSE)
    	    {
    	        if(empty($items0['subitems']) == TRUE)
    	        {
    	            $items0['subitems'] = array();
    	        }
    	        $auxClass = '';
    	        if(isSelectedMenu($items0[$i]['href'], $items0[$i]['subitems']) == TRUE)
    	        {
    	            $auxClass = ' class="selected"';
    	        }

        		$menu .=  '<li class="arrow"><a href="#" id="'.$items0[$i]['id'].'"'.$auxClass.'>'.getValue($items0[$i]['item'], TRUE, CHARSET).'</a><ul'.$ul.'>';
        		$menu .= $subMenu;
        		$menu .=  '</ul></li>';
    	    }
        }
    }
    echo $menu;
    ?>
    </ul>
    <?php
}

function isSelectedMenu($file, $items)
{
    require_once('menu.php');

    $isSelected = FALSE;

    $path   = pathinfo( $_SERVER['PHP_SELF'] );
    $actual = $path['basename'];


    if($file == $actual)
    {
        $isSelected = TRUE;
    }
    elseif(empty($items) == FALSE)
    {
        foreach($items as $item)
        {
            if(empty($item['href']) == TRUE)
            {
                $item['href'] = '';
            }
            if(empty($item['subitems']) == TRUE)
            {
                $item['subitems'] = array();
            }
            if(isSelectedMenu($item['href'], $item['subitems']) == TRUE)
            {
                $isSelected = TRUE;
            }
        }
    }


    return $isSelected;
}
function isInNextLevelMenu($file, $nextLevel)
{
    dump($file);
    dump($nextLevel);
}
?>