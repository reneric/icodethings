<?php
 session_start();
if(isset($_SESSION['lat']) and isset($_SESSION['lng'])){
 $_SESSION['lat'] = $_SESSION['lat'];
 $_SESSION['lng'] = $_SESSION['lng'];
}else{
 $_SESSION['lat'] = null;
 $_SESSION['lng'] = null;
}
get_header(); ?>
<div style="display:none;" id="map-canvas"></div>
<div id="search-wrap">
 
    <input type="text" id="searchField" name="search" value="" placeholder="Search"/>
    <input type="submit" value="Go" class="sSubmit" name="submit"> 

</div>

<div class="icons clearfix">
	<ul class="clearfix">
		<li class="map"><h3>Map</h3></li>
		<li class="speed"><h3>Settings</h3></li>
	</ul>
</div>
<input type="hidden" id="lat" value="<?php echo $lat; ?>">
<input type="hidden" id="lng" value="<?php echo $lng; ?>">
<input type="hidden" id="minutes" value="">
<div id="distance"></div>
<div id="duration"></div>
<div id="status-wrapper">
	<?php if(!isset($_SESSION['name'])){?>
	<!-- <form action="form-data.php" class="simpleform">
		<input type="text" name="name" value="" placeholder="Name">
		<input type="text" name="work" value="" placeholder="Work Address">
		<input type="submit" value="Save" class="submits">
	</form> -->
	<?php }else{ ?>
		<h1>Welcome back <?php echo $_SESSION["name"]; ?></h1>
	<?php }; ?>
</div>
	<div id="places" class="clearfix" style="min-height:100%">
		<ul id="tiles"></ul>
	</div>

<?php get_footer(); ?>