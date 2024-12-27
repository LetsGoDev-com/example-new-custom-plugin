<?php
/**
 * @link     https://www.letsgodev.com/
 * @since    1.0.0
 * @package  Plugins/LetsGoDev/PluginExample
 *
 * Plugin Name:          Plugin Example
 * Plugin URI:           https://www.letsgodev.com/
 * Description:          This plugin is an example
 * Version:              1.0.0
 * Author:               Lets Go Dev
 * Author URI:           https://www.letsgodev.com/
 * Developer:            Alexander Gonzales
 * Developer URI:        https://vcard.gonzalesc.org/
 * License:              GPL-3.0+
 * License URI:          https://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:          custom plugin, example plugin, create plugin
 * WP stable tag:        6.5.0
 * WP requires at least: 6.5.0
 * WP tested up to:      6.7.0
 */
	

add_action( 'admin_notices', 'showAdminNotice' );

/**
 * Show a notice in WPAdmin
 *      __( string, textDomain )
 *      _e( string, textDomain ) => "echo __()"
 *      _x( string, context, textDomain )
 *      _ex()
 *      _n()
 *      _nx()
 *      _n_noop()
 *      _nx_noop()
 *      translate_nooped_plural()
 *
 *      esc_html__( string, textDomain )
 *      esc_html_e( string, textDomain )  => echo esc_html__()
 *      esc_html_x( string, context, textDomain)
 *      esc_attr__()
 *      esc_attr_e()
 *      esc_attr_x()
 *
 * @return void
 */
function showAdminNotice(): void {
	printf(
		'<div class="notice notice-warning is-dismissible"><p>%s - %s</p></div>',
		esc_html__( 'Hi. My name is Alexander. Thanks for using my plugin.', 'letsgo' ),
		get_option('my_custom_plugin', '')
	);
}


add_action( 'plugins_loaded', 'translateTextDomain' );

function translateTextDomain(): void {
	
	load_plugin_textdomain(
		'letsgo',
		false,
		'new_custom_plugin/languages/'
	);
}


add_filter( 'the_content', 'replaceContent' );

/**
 * Replace content using the_content hook
 * @param string $content
 * @return string
 */
function replaceContent( string $content ): string {
	return str_replace( 'example page', 'My Custom Plugin', $content );
}

register_activation_hook( __FILE__, 'processActivation' );
register_deactivation_hook( __FILE__, 'processDeactivation' );

function processActivation(): void {
	update_option( 'my_custom_plugin', 'Activado' );
}

function processDeactivation(): void {
	delete_option( 'my_custom_plugin' );
}