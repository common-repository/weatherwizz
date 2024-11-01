<?php
/*
Plugin Name:  WeatherWizz
Plugin URI:   https://www.weatherwizz.com/
Description:  Display real-time weather data from your personal weather station on a wordpress website using your WeatherWizz account.
Version:      1.3.1
Author:       WeatherWizz
Author URI:   https://www.weatherwizz.com/
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  wpb-weatherwizz
Domain Path:  /languages
*/

function weatherwizz_filter( $content ) {

	preg_match_all(	'/{{ww_(([^}][^}]?|[^}]}?)*)}}/', $content,$matches,PREG_PATTERN_ORDER);
foreach ( $matches[0] as $key ) {
    	//echo "<dt>AB $key</dt>";
	$nKey = str_ireplace('{{','',$key);
	$nKey = str_ireplace('}}','',$nKey);
	$span = '<span id="key" weatherwizzdata="key"></span>';
	$updatedspan = str_ireplace('key',$nKey ,$span);

	$content = str_ireplace( $key, $updatedspan , $content );

  	}


	preg_match_all(	'/{{wiz_(([^}][^}]?|[^}]}?)*)}}/', $content,$matches,PREG_PATTERN_ORDER);
foreach ( $matches[0] as $key ) {
    	//echo "<dt>AB $key</dt>";
	$nKey = str_ireplace('{{','',$key);
	$nKey = str_ireplace('}}','',$nKey);
	$span = '<span id="key" weatherwizz-data="key"></span>';
	$updatedspan = str_ireplace('key',$nKey ,$span);

	$content = str_ireplace( $key, $updatedspan , $content );

  	}


	return $content;
}


// Hook our function to WordPress the_content filter

	add_filter('the_content', 'weatherwizz_filter');          
	add_action('wp_enqueue_scripts','weatherwizz_init');
	add_action('admin_enqueue_scripts', 'weatherwizz_load_admin_scripts');
	add_action('admin_menu', 'weatherwizz_menu' );

function weatherwizz_menu()
{
      add_menu_page(
        'WeatherWizz', // Title of the page
        'WeatherWizz', // Text to show on the menu link
        'manage_options', // Capability requirement to see the link
        plugin_dir_path(__FILE__) . 'includes/weatherwizz.php' // The 'slug' - file to 	display when clicking the link
    );
}

function weatherwizz_load_admin_scripts() {
	wp_enqueue_script('jquery');
 	wp_enqueue_script( 'weatherwizzadmin_init', plugins_url( '/script/weatherwizzadmin.js', __FILE__ ));
	
}

function weatherwizz_init() {
	wp_enqueue_script('jquery');
        wp_enqueue_script( 'weatherwizz_init', plugins_url( '/script/weatherwizz.js', __FILE__ ));
	
}

