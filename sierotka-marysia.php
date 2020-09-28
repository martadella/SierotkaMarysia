<?php

/*
Sierotka Marysia is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

Sierotka Marysia is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Sierotka Marysia. If not, see https://www.gnu.org/licenses/gpl-3.0.en.html.
*/

/**
 * Plugin Name:       Sierotka Marysia
 * Description:       Moves a single letter or digit from the end of line to the next line by replacing space with non-breaking space. Works only for post and page content and excerpt. The change is performed at post saving.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Marta Czuczman
 * Author URI:        https://panimarta.pl
 * Text Domain:       sierotka-marysia
 * Domain Path:       /languages
 */

if ( !function_exists("sierotka_marysia_orphans_filter_handler") ) {
  function sierotka_marysia_orphans_filter_handler( $data , $postarr ) {
    $data['post_content'] = preg_replace("/( [a-zA-Z0-9]) /", "$1&nbsp;", $data['post_content']);
    $data['post_content'] = preg_replace("/(&nbsp;[a-zA-Z0-9]) /", "$1&nbsp;", $data['post_content']);
    if ($data['post_excerpt']) {
      $data['post_excerpt'] = preg_replace("/( [a-zA-Z0-9]) /", "$1&nbsp;", $data['post_excerpt']);
      $data['post_excerpt'] = preg_replace("/(&nbsp;[a-zA-Z0-9]) /", "$1&nbsp;", $data['post_excerpt']);
    }
    return $data;
  }
  add_filter( 'wp_insert_post_data', 'sierotka_marysia_orphans_filter_handler', '99', 2 );
}

/**
 * Load plugin textdomain.
 */
 function sierotka_marysia_load_plugin_textdomain() {
     load_plugin_textdomain( 'sierotka-marysia', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
 }
 add_action( 'plugins_loaded', 'sierotka_marysia_load_plugin_textdomain' );

/**
 * Activate the plugin.
 */
function sierotka_marysia_activate() {
}
register_activation_hook( __FILE__, 'sierotka_marysia_activate' );

/**
 * Deactivation hook.
 */
function sierotka_marysia_deactivate() {
}
register_deactivation_hook( __FILE__, 'sierotka_marysia_deactivate' );

?>
