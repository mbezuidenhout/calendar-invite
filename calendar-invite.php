<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://tripturbine.com/
 * @since             1.0.0
 * @package           Calendar_Invite
 *
 * @wordpress-plugin
 * Plugin Name:       Calendar Invite
 * Plugin URI:        https://github.com/mbezuidenhout/calendar-invite.git
 * Description:       Sends the site admin a calendar invite.
 * Version:           1.0.2
 * Author:            Marius Bezuidenhout
 * Author URI:        https://tripturbine.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       calendar-invite
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
define( 'PLUGIN_NAME_VERSION', '1.0.1' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-calendar-invite-activator.php
 */
function activate_calendar_invite() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-calendar-invite-activator.php';
    Calendar_Invite_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-calendar-invite-deactivator.php
 */
function deactivate_calendar_invite() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-calendar-invite-deactivator.php';
    Calendar_Invite_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_calendar_invite' );
register_deactivation_hook( __FILE__, 'deactivate_calendar_invite' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-calendar-invite.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/class-calendar-invite-calendar-data.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_calendar_invite() {

    $plugin = new Calendar_Invite();
    $plugin->run();

}
run_calendar_invite();
