<?php
/*
* Plugin Name: WP Related Posts Plugin
* Description: Search and add your related post links directly inside your posts.
* Author: Tareq Anwar
* Author URI: http://www.tareqanwar.com
* Version: 1.0
* License: GPLv2
*/


/*
GENERAL NOTES

 * PHP short tags ( e.g. <?= ?> ) are not used as per the advice from PHP.net
 * Database implementation
 * IMPORTANT: Menu is visible to anyone who has 'administrator' capability, so that means administrator
              See: http://codex.wordpress.org/Roles_and_Capabilities for information on appropriate settings for different users

*/

//  style sheet.


// Make sure that no info is exposed if file is called directly -- Idea taken from Akismet plugin
if ( !function_exists( 'add_action' ) ) {
	echo "This page cannot be called directly.";
	exit;
}

function rp_stylesheet_url() {
	$rp_url = plugin_dir_url( __FILE__ ) . 'style.css';
    echo "<link rel='stylesheet' href='" . $rp_url . "' type='text/css' />";
}
add_action( 'admin_head', 'rp_stylesheet_url' );
add_action( 'wp_head', 'rp_stylesheet_url' );

function rp_js_url($hook) {
	$rp_url = plugin_dir_url( __FILE__ ) . 'script.js';
    wp_enqueue_script('my_custom_script', $rp_url, array('jquery'));
	wp_localize_script( 'my_custom_script', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )) );
	wp_localize_script( 'my_custom_script', 'rp_vars', array( 'rp_nonce' => wp_create_nonce ('rp_nonce')));
}
add_action( 'admin_enqueue_scripts', 'rp_js_url' );


// Define some useful constants that can be used by functions
if ( ! defined( 'WP_CONTENT_URL' ) ) {	
	if ( ! defined( 'WP_SITEURL' ) ) define( 'WP_SITEURL', get_option("siteurl") );
	define( 'WP_CONTENT_URL', WP_SITEURL . '/wp-content' );
}

if ( ! defined( 'WP_SITEURL' ) ) define( 'WP_SITEURL', get_option("siteurl") );
if ( ! defined( 'WP_CONTENT_DIR' ) ) define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );
if ( ! defined( 'WP_PLUGIN_URL' ) ) define( 'WP_PLUGIN_URL', WP_CONTENT_URL. '/plugins' );
if ( ! defined( 'WP_PLUGIN_DIR' ) ) define( 'WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins' );

if ( basename(dirname(__FILE__)) == 'plugins' )
	define("BLANK_DIR",'');
else define("BLANK_DIR" , basename(dirname(__FILE__)) . '/');
define("BLANK_PATH", WP_PLUGIN_URL . "/" . BLANK_DIR);

// http://codex.wordpress.org/Function_Reference/add_action

/*

******** BEGIN PLUGIN FUNCTIONS ********

*/


// showing custom field
require_once('add_custom_field.php');
require_once('search_posts.php');
add_action('wp_ajax_get_keyword', 'get_keyword');


function ShortenText($text)
{

$chars_limit = 60;

$chars_text = strlen($text);

$text = $text." ";

$text = substr($text,0,$chars_limit);

$text = substr($text,0,strrpos($text,' '));

if ($chars_text > $chars_limit)
{
$text = $text." ...";
}
return $text;

}


function releated_post_one( $atts ){
	$id = get_the_ID();
	$post_id_one = get_post_meta( $id, 'post_link_one', true );
	return "<p class='rp_link'>". $thumb . " Related Story: <a href='" . get_permalink( $post_id_one ) ."' >". ShortenText(get_the_title( $post_id_one )) ."</a><div class='stripe-line' style='margin-top: 20px;'></div></p>";
}
add_shortcode( 'releated_post_one', 'releated_post_one' );

function releated_post_two( $atts ){
	$id = get_the_ID();
	$post_id_two = get_post_meta( $id, 'post_link_two', true );
	return "<p class='rp_link'>Related Story: <a href='" . get_permalink( $post_id_two ) ."' >".  ShortenText(get_the_title( $post_id_two )) ."</a><div class='stripe-line' style='margin-top: 26px;'></div></p>";
}
add_shortcode( 'releated_post_two', 'releated_post_two' );

function releated_post_three( $atts ){
	$id = get_the_ID();
	$post_id_three = get_post_meta( $id, 'post_link_three', true );
	return "<p class='rp_link'>". $thumb . " Related Story: <a href='" . get_permalink( $post_id_three ) ."' >".  ShortenText(get_the_title( $post_id_three )) ."</a><div class='stripe-line' style='margin-top: 26px;'></div></p><p style='
    clear: both;
'></p>";
}
add_shortcode( 'releated_post_three', 'releated_post_three' );

function related_post_one( $atts ){
	$id = get_the_ID();
	$post_id_one = get_post_meta( $id, 'post_link_one', true );
	return "<p class='rp_link'>". $thumb . " Related Story: <a href='" . get_permalink( $post_id_one ) ."' >". ShortenText(get_the_title( $post_id_one )) ."</a><div class='stripe-line' style='margin-top: 26px;'></div></p><p style='
    clear: both;
'></p>";
}
add_shortcode( 'related_post_one', 'related_post_one' );

function related_post_two( $atts ){
	$id = get_the_ID();
	$post_id_two = get_post_meta( $id, 'post_link_two', true );
	return "<p class='rp_link'>Related Story: <a href='" . get_permalink( $post_id_two ) ."' >".  ShortenText(get_the_title( $post_id_two )) ."</a><div class='stripe-line' style='margin-top: 26px;'></div></p><p style='
    clear: both;
'></p>";
}
add_shortcode( 'related_post_two', 'related_post_two' );

function related_post_three( $atts ){
	$id = get_the_ID();
	$post_id_three = get_post_meta( $id, 'post_link_three', true );
	return "<p class='rp_link'>". $thumb . " Related Story: <a href='" . get_permalink( $post_id_three ) ."' >".  ShortenText(get_the_title( $post_id_three )) ."</a><div class='stripe-line' style='margin-top: 26px;'></div></p><p style='
    clear: both;
'></p>";
}
add_shortcode( 'related_post_three', 'related_post_three' );
?>