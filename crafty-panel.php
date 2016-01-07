<?php
/*
Plugin Name: Crafty Panel
Plugin URI:  http://karlwenn.com/craftpanelplugin
Description: Customize your cpanel depending on user role
Version:     0.1
Author:      Karl Wenn
Author URI:  http://karlwenn.com
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

// constants
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
$siteurl = get_option('siteurl');
define('PRO_FOLDER', dirname(plugin_basename(__FILE__)));
define('PRO_URL', $siteurl.'/wp-content/plugins/' . PRO_FOLDER);
define('PRO_FILE_PATH', dirname(__FILE__));
define('PRO_DIR_NAME', basename(PRO_FILE_PATH));
// this is the table prefix
global $wpdb;
$pro_table_prefix=$wpdb->prefix.'pro_';
define('PRO_TABLE_PREFIX', $pro_table_prefix);

// create table on active, destroy table on deactivate of plugin

register_activation_hook(__FILE__,'pro_install');
register_deactivation_hook(__FILE__ , 'pro_uninstall' );

function pro_install()
{
	global $wpdb;
	$table = PRO_TABLE_PREFIX."CraftyPanel";
    $structure = "CREATE TABLE $table (
        id INT(9) NOT NULL AUTO_INCREMENT,
        name VARCHAR(80) NOT NULL,
        publisher VARCHAR(20) NOT NULL,
        permission VARCHAR(20) NOT NULL,
        priority INT(1) NOT NULL,
        content text,
	UNIQUE KEY id (id)
    );";
    $wpdb->query($structure);
	  // Populate table
	for($i=0;$i<5;$i++){
		$id = $i;
		$name = 'Widget'.$i;
		$publisher = 'Karl Wenn';
		$role = 'admin';
		$priority = '1';
		$content = "this is content for widget ".$i."!";
    $wpdb->query("INSERT INTO $table(name, publisher, permission, priority, content)
        VALUES('$name', '$publisher','$role','$priority', '$content')");
        }
}

function pro_uninstall()
{
	global $wpdb;
	$table = PRO_TABLE_PREFIX."CraftyPanel";
    $structure = "drop table if exists $table";
    $wpdb->query($structure);  
}

// Admin Menu

add_action('admin_menu','craftymenu');


function craftymenu() { 
	//add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
	add_menu_page(
		'Crafty-Panel',
		'Crafty Panel',
		8,
		'crafty',
		'craftymain',
		'dashicons-images-alt2',
		'61.44'
	); 
	//add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function );
	add_submenu_page('crafty','AddPanel','Add Panel','8','sub1','craftysub1');
	add_submenu_page('crafty','PanelAdmin','Panel Admin','8','sub2','craftysub2');
	add_submenu_page('crafty','Settings','Settings','8','sub3','craftysub3');
	
}

function craftymain(){require 'page.php'; }
function craftysub1(){require 'addpanel.php';}
function craftysub2(){require 'paneladmin.php';}
function craftysub3(){require 'settings.php';}


//Adds widgets to dashboard

add_action('wp_dashboard_setup', 'craftypanel');
 
	function craftypanel() {
	global $wp_meta_boxes;
	global $wpdb;
	$items = $wpdb->get_results("SELECT * FROM wp_pro_CraftyPanel");
			foreach($items as $item){
		wp_add_dashboard_widget($item->id, $item->name, 'widgetcontent', null, $item->content);
	}
	}

	function widgetcontent($var, $content) {
	echo $content[args];
	}
?>