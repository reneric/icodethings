$(function(){
  //  alert(screen.width)

  $('#more').toggle(function(){
  	$(this).addClass('map');
  	$('#watch-wrap').addClass('move');
  	$('#map-canvased').addClass('move');
  },function(){
  	$(this).removeClass('map');
  	$('#watch-wrap').removeClass('move');
  	$('#map-canvased').removeClass('move');
  })
jQuery('.tile').click(function(){
  alert('test')
  //jQuery(this).next('.direct').show();
})
$('#places').trigger('refreshWookmark');
  $('span.close').live('click',function(){
    $(this).parent().remove();
        var options = {
           autoResize: true,
           container: $('#tiles'), 
          offset: 5 
        };
            // Create a new layout handler.
            handler = $('#tiles li');
            handler.wookmark(options);
  });
    $('.viewDetails').live('click',function(){

            
            // Create a new layout handler.
            handler = $('#tiles li');
            handler.wookmark();
  });
});
(function ($, undefined) {  
    $.fn.clearable = function () {  
        var $this = this;  
        $this.wrap('<div class="clear-holder" />');  
        var helper = $('<span class="clear-helper">x</span>');  
        $this.parent().append(helper);  
        helper.click(function(){  
            $this.val("");  
        });  
    };  
})(jQuery);
$("#searchField").clearable();