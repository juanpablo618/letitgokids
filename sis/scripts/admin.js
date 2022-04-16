$(document).ready(function($) {
    
    switchMenu();
                
    $(window).resize(function() {
        switchMenu();
    });
    
    $('.data .row').not('.detail .data .row').on('click', function () {
        rowClick($(this));
    });
    
    /*Debo reescribir este método para que me tome la tabla armada con ajax. Para eso pongo un elemento que no se cargue con ajax y luego del 'clcik' pongo los child dinámicos*/
    $('#providerProductList').on('click', '.data .row', function () {
	rowClick2($(this));
    });
    
    $('.data .col.header a, .data .col .action a, .data .col.action-vertical input[type=button]').on('click', function (event) {
        event.stopPropagation();
    });

});
    
function switchMenu()
{
    var limitMenu = 700;
    var menu = $('ul#menu');    
    var btnMenu = $('#btnMenu');
    
    menu.find('li a[href="#"]').on('click', function (event) {
        event.preventDefault();
    });
    
    if ($(window).width() < limitMenu)
    {        
        menu.hide();
        btnMenu.show();
        menu.find('li').css('background-position', '8px 0');        
        menu.find('li ul').hide();
        menu.addClass('vertical');        
        menu.find('li').off('mouseenter');
        menu.find('li').off('mouseleave');        
        menu.find('li').on('click', function () {
            menu.find('li').css('background-position', '8px 0');            
            menu.find('li ul').hide();
            $(this).css('background-position', '8px -39px').children('ul').show();
        });        
        btnMenu.off('click');
        btnMenu.on('click', function (event) {
            if (menu.is(':visible')) {
                menu.hide();    
            } else {
                menu.show();
            }
            event.preventDefault();
        });
    }
    else
    {
        btnMenu.hide();
        menu.show(); 
        menu.find('li').css('background-position', 'right center');
        menu.find('li ul').hide();
        menu.removeClass('vertical');
        menu.find('li').off('click');        
        menu.find('li').on('mouseenter', function () {
            $(this).children('ul').show();
        });        
        menu.find('li').on('mouseleave', function () {
            $(this).children('ul').hide();
        });        
    }
}