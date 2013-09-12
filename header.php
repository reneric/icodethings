<?php
session_start();
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<meta name="description" content="">
<meta name="viewport" content="width=device-width">

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>
<script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?sensor=false&key=AIzaSyDMUXYGjJl80SietJMEdP9L5dYdMarP13g&libraries=places,visualization&v=3.exp"></script>
<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700,300italic|Open+Sans:400,300,800,700,600' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Allan:400,700|Cabin:400,500,600,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap-responsive.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/main.css">
<style>
#container {}
#map-canvased {
  overflow:hidden;
  width: 100%;
  height: 0px;
}
#map-canvas {
  min-height: 200px;
height:40%;
  min-width: 100%;
}
 </style>

 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript" src="http://oauth.googlecode.com/svn/code/javascript/oauth.js"></script>
<script type="text/javascript" src="http://oauth.googlecode.com/svn/code/javascript/sha1.js"></script>
<script type="text/javascript" src="https://raw.github.com/padolsey/prettyPrint.js/master/prettyprint.js"></script>
</head>
<body <?php body_class(); ?> onLoad="initialize();">
	<div id="maxp"></div>
<?php get_template_part('mapsApi'); ?>
<div id="preload"></div>
<div id="container">
<input type="hidden" id="coord" value=""/>
<input type="hidden" id="myArray" value=""/>
<div id="content">
	<ul></ul>
</div>
<div id="statuss"></div>