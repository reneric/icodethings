<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
</div><!-- /container -->
<script>
$('#showMap').toggle(function(){
  $("#map-canvased").animate({
    height:"220px"
  })
  $(this).text('Hide Map');
},function(){
  $(this).text('Show Map');
  $("#map-canvased").animate({
    height:"0px"
  })
});
    $('form.simpleform').live('submit',function(){
    var data = $(this).serialize();

  $.ajax({
    'url': "<?php echo get_template_directory_uri(); ?>/form-data.php",
    'type': 'post',
    'data': data,
    'success': function(data) {
    	var responseData = jQuery.parseJSON(data)
    	$("form.simpleform").fadeOut().remove();
    	$("#status-wrapper").html("<h1>Welcome back "+responseData.name);
   
      }
    })
  return false;
  })
</script>
<?php wp_footer(); ?>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/vendor/bootstrap.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/plugins.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/tile.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/main.js"></script>
<script>

</script>
</body>
</html>