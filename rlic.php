<?php
/*
* Plugin Name: Related Links Inside Content
* Plugin URI: https://wordpress.org/plugins/related-links-inside-content/
* Description: Search and add your related post links directly inside your posts using shortcode.
* Author: Tareq Anwar
* Author URI: http://www.tareqanwar.com
* Version: 1.01
* License: GPLv2
* License URI: http://www.gnu.org/licenses/gpl-2.0.html 
* Tags: related post, related link, related sotry
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


// Adding css files here
function rlic_tareqanwar_stylesheet_url() {
	$rlic_tareqanwar_url = plugin_dir_url( __FILE__ ) . 'style.css';
    echo "<link rel='stylesheet' href='" . $rlic_tareqanwar_url . "' type='text/css' />";
}
add_action( 'admin_head', 'rlic_tareqanwar_stylesheet_url' );
add_action( 'wp_head', 'rlic_tareqanwar_stylesheet_url' );


// Adding scripts and enabling ajx using nonce
function rlic_tareqanwar_js_url($hook) {
	$rlic_tareqanwar_url = plugin_dir_url( __FILE__ ) . 'script.js';
    wp_enqueue_script('rlic_tareqanwar_script', $rlic_tareqanwar_url, array('jquery'));
	wp_localize_script( 'rlic_tareqanwar_script', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )) );
	wp_localize_script( 'rlic_tareqanwar_script', 'rlic_tareqanwar_vars', array( 'rlic_tareqanwar_nonce' => wp_create_nonce ('rlic_tareqanwar_nonce')));
}
add_action( 'admin_enqueue_scripts', 'rlic_tareqanwar_js_url' );

// http://codex.wordpress.org/Function_Reference/add_action

/*

******** BEGIN PLUGIN FUNCTIONS ********

*/


// requires
require_once('add_custom_field.php');
require_once('search_posts.php');
require_once('setting_page.php');

// Search post using keyword typed by user
add_action('wp_ajax_rlic_tareqanwar_search_posts', 'rlic_tareqanwar_search_posts');

// Add setting page link in plugin page
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'rlic_tareqanwar_add_action_links' );

function rlic_tareqanwar_add_action_links ( $links ) {
 $mylinks = array(
 '<a href="' . admin_url( 'options-general.php?page=rlic-settings' ) . '">Settings</a>',
 );
return array_merge( $links, $mylinks );
}


function rlic_tareqanwar_shorten_text($text)
{
  $chars_limit = 80;
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

/* Related Post One */
function rlic_tareqanwar_related_post_one( $atts ){
  $id = get_the_ID();
  $post_id_one = get_post_meta( $id, 'rlic_tareqanwar_post_link_one', true );
  // Get or set default text for "Related Story" link label
  $relatedStoryLabel = esc_attr( get_option('rlic-tareqanwar-releted-story-text') );
  if($relatedStoryLabel == "") $relatedStoryLabel = "Related Story";
  
  if(is_numeric($post_id_one)) 
    return "<p class='rlic_tareqanwar_link'>". $relatedStoryLabel .": <a href='" . get_permalink( $post_id_one ) ."' >". rlic_tareqanwar_shorten_text(get_the_title( $post_id_one )) ."</a></p>";
}
add_shortcode( 'rlic_related_post_one', 'rlic_tareqanwar_related_post_one' );

/* Related Post Two */
function rlic_tareqanwar_related_post_two( $atts ){
  $id = get_the_ID();
  $post_id_two = get_post_meta( $id, 'rlic_tareqanwar_post_link_two', true );
  // Get or set default text for "Related Story" link label
  $relatedStoryLabel = esc_attr( get_option('rlic-tareqanwar-releted-story-text') );
  if($relatedStoryLabel == "") $relatedStoryLabel = "Related Story";
  
  if(is_numeric($post_id_two)) 
    return "<p class='rlic_tareqanwar_link'>". $relatedStoryLabel .": <a href='" . get_permalink( $post_id_two ) ."' >".  rlic_tareqanwar_shorten_text(get_the_title( $post_id_two )) ."</a></p>";
}
add_shortcode( 'rlic_related_post_two', 'rlic_tareqanwar_related_post_two' );

/* Related Post Three */
function rlic_tareqanwar_related_post_three( $atts ){
  $id = get_the_ID();
  $post_id_three = get_post_meta( $id, 'rlic_tareqanwar_post_link_three', true );
  // Get or set default text for "Related Story" link label
  $relatedStoryLabel = esc_attr( get_option('rlic-tareqanwar-releted-story-text') );
  if($relatedStoryLabel == "") $relatedStoryLabel = "Related Story";
  
  if(is_numeric($post_id_three)) 
    return "<p class='rlic_tareqanwar_link'>". $relatedStoryLabel .": <a href='" . get_permalink( $post_id_three ) ."' >".  rlic_tareqanwar_shorten_text(get_the_title( $post_id_three )) ."</a></p>";
}
add_shortcode( 'rlic_related_post_three', 'rlic_tareqanwar_related_post_three' );
?>