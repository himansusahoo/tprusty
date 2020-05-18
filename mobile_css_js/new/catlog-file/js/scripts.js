(function() {
    "use strict";

    // custom scrollbar

    $("html").niceScroll({styler:"fb",cursorcolor:"#fcb314", cursorwidth: '4', cursorborderradius: '10px', background: '#FFFFFF', spacebarenabled:false, cursorborder: '0',  zindex: '1000'});

    $(".scrollbar1").niceScroll({styler:"fb",cursorcolor:"#fcb314", cursorwidth: '4', cursorborderradius: '0',autohidemode: 'false', background: '#FFFFFF', spacebarenabled:false, cursorborder: '0'});

	
	
    $(".scrollbar1").getNiceScroll();
    if ($('body').hasClass('scrollbar1-collapsed')) {
        $(".scrollbar1").getNiceScroll().hide();
    }

})(jQuery);



// menu bar sub-menu

/*$(document).ready(function(){


     $('#nav li.fst-lbl>a').on('click', function(){
		 
		$(".sub-menu").toggle(); 
	
     });

     $('#nav li.scnd-lbl>a').on('click', function(){
		 
		$(".sub-sub-menu").toggle();
		 
	 });

});*/


$(document).ready(function(){

	$(".button-nav-toggle").click(function(){
		$(".main").toggleClass("open");
		$(".nav").toggleClass("open");
	});

	$(".nav-main li:has(ul)").addClass("has-sub-nav").prepend("<div class=\"sub-toggle\"></div>");

	$(".has-sub-nav a").click(function(){
		$(this).parent().addClass("active");
		$(".nav-container").addClass("show-sub");
	});

	$(".has-sub-nav .back").click(function(){
		$(".nav-container").removeClass("show-sub");
		$(".has-sub-nav").removeClass("active");
	});

});





// menu bar sub-sub-menu

( function( $ ) {
$( document ).ready(function() {
$('.cssmenu > li > a').click(function() {
  $('.cssmenu li').removeClass('active','has-sub-nav');
  $(this).closest('li').addClass('active');	
  var checkElement = $(this).next();
  if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
    $(this).closest('li').removeClass('active');
    checkElement.slideUp('normal');
  }
  if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
    $('.cssmenu ul ul:visible').slideUp('normal');
    checkElement.slideDown('normal');
  }
  if($(this).closest('li').find('ul').children().length == 0) {
    return true;
  } else {
    return false;	
  }		
});
});
} )( jQuery );
                     
     
// Search bar

 function showhide()
     {
	  $("#searchbar").slideDown(500);
     }
	 
function hide()
     {
	  $("#searchbar").hide();
     }	 
	 
 
//  Show Filter 

function showfilter()
  {
	  $('.filterpanel').toggle(500);
   }

function fltrclose()
  {  
	$('.filterpanel').hide();  
  }

