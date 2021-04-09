<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              hr-on.com
 * @since             1.2.0
 * @package           Prices
 *
 * @wordpress-plugin
 * Plugin Name:       HR-ON Prices
 * Plugin URI:        prices
 * Description:       The new price view for HR-ON
 * Version:           1.2.0
 * Author:            Baldur
 * Author URI:        hr-on.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       prices
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.1.2 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PRICES_VERSION', '1.2.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-prices-activator.php
 */
function activate_prices() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-prices-activator.php';
	Prices_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-prices-deactivator.php
 */
function deactivate_prices() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-prices-deactivator.php';
	Prices_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_prices' );
register_deactivation_hook( __FILE__, 'deactivate_prices' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-prices.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.1.2
 */
function run_prices() {

	$plugin = new Prices();
	$plugin->run();

}
run_prices();