<?php 
function register_plugin_styles() {
	wp_register_style( 'Craft-Panel', plugins_url( 'Craft-Panel/plugin.css' ) );
	wp_enqueue_style( 'Craft-Panel' );
}

add_action( 'wp_enqueue_scripts', 'theme_name_scripts' );	
	echo '
	<link rel="stylesheet" type="text/css" href="style.css">
	<div class="something">
	<h1>About Crafty Panel</h1>
	Have you ever wanted thought that your users would benefit from a highly customizable dashboard? <br />That is the motivation behind crafty panel! <br /><br /> On many occasion I have wanted to add a customizable dashboard where I can communicate to administrators and users by posting notices are adding functionality. Unfortunately, the dashboard seemed to have limits for those who did not know how to code. So crafty panel makes it easy. </div>
	
	
	
	
	
	'; ?>