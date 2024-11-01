<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://example.com
 * @since             1.0.0
 * @package           Dwpl_Data
 *
 * @wordpress-plugin
 * Plugin Name:       Download Dashboard
 * Plugin URI:        
 * Description:       A simple plugin that allows you to download and share configuration environment of your WordPress website without exposing user privacy data. Handy while working with support teams where you cannot provide direct access to your dashboard.
 * Version:           1.0.0
 * Author:            CMSHelpLive
 * Author URI:        https://cmshelplive.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       dwpl-data
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'DWPL_DATA_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-dwpl-data-activator.php
 */
function activate_dwpl_data() {
	$dwpl_activator = new Dwpl_Data_Activator;
	$dwpl_activator->activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-dwpl-data-deactivator.php
 */
function deactivate_dwpl_data() {
	$dwpl_deactivator = new Dwpl_Data_Deactivator;
	$dwpl_deactivator->deactivate();
}

register_activation_hook( __FILE__, 'activate_dwpl_data' );
register_deactivation_hook( __FILE__, 'deactivate_dwpl_data' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-dwpl-data.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_dwpl_data() {

	$plugin = new Dwpl_Data();
	$plugin->run();

}
run_dwpl_data();
