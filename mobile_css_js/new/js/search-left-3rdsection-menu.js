$(document).ready(function(){

  $('#search-left > ul > li:has(ul)').addClass("has-sub");

  $('#search-left > ul > li > a').click(function() {
    var checkElement = $(this).next();
    
    $('#search-left li').removeClass('active');
    $(this).closest('li').addClass('active');	
    
    
    if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
      $(this).closest('li').removeClass('active');
      checkElement.slideUp('normal');
    }
    
    if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
      $('#search-left ul ul:visible').slideUp('normal');
      checkElement.slideDown('normal');
    }
    
    if (checkElement.is('ul')) {
      return false;
    } else {
      return true;	
    }		
  });

});