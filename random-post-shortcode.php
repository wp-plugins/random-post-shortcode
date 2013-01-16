<?php
/*
Plugin Name: Powie's Random post shortcode
Plugin URI: http://www.powie.de/wordpress
Description: Shortcode <code>[random-post]</code> for displaying a random post
Version: 1.0.0
License: GPLv2
Author: Thomas Ehrhardt
Author URI: http://www.powie.de
*/

//Shortcode
add_shortcode('random-post', 'random_post_shortcode');
function random_post_shortcode( $atts ) {
	//var_Dump($atts);
	/*
	extract( shortcode_atts( array(
		'foo' => 'something',
		'bar' => 'something else',
	), $atts ) );
	return "Hallo -> foo = {$foo}";
	*/
	$args = array(
	'numberposts'     => 1,
	'orderby'         => 'rand',
	'post_type'       => 'post',
	'post_status'     => 'publish');
	$post = get_posts($args);
	foreach ($post as $p) {
		$title = apply_filters('the_title', $p->post_title);
		$content =  apply_filters('the_content', $p->post_content);
	}
	return '<h2>'.$title.'</h2>'.$content;
}

//Hook for Activation
register_activation_hook( __FILE__, 'rp_activate' );
//Hook for Deactivation
register_deactivation_hook( __FILE__, 'rp_deactivate' );
//Activate
function rp_activate() {
	// do not generate any output here
	//add_option('postfield-rows',5);
}
//Deactivate
function rp_deactivate() {
	// do not generate any output here
}
?>