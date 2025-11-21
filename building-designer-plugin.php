<?php
/**
 * Plugin Name: Building Designer
 * Plugin URI: https://yoursite.com/building-designer
 * Description: Professional multi-step building designer form with dynamic image switching
 * Version: 1.0.0
 * Author: Servtech Global
 * Author URI: https://yoursite.com
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: building-designer
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

// Plugin version
define('BUILDING_DESIGNER_VERSION', '1.0.0');
define('BUILDING_DESIGNER_PATH', plugin_dir_path(__FILE__));
define('BUILDING_DESIGNER_URL', plugin_dir_url(__FILE__));

// Require Composer autoload
require_once BUILDING_DESIGNER_PATH . 'vendor/autoload.php';

use BuildingDesigner\Core\Activator;
use BuildingDesigner\Core\Deactivator;
use BuildingDesigner\Core\Plugin;

/**
 * Activation hook
 */
function activate_building_designer() {
    Activator::activate();
}
register_activation_hook(__FILE__, 'activate_building_designer');

/**
 * Deactivation hook
 */
function deactivate_building_designer() {
    Deactivator::deactivate();
}
register_deactivation_hook(__FILE__, 'deactivate_building_designer');

/**
 * Run the plugin
 */
function run_building_designer() {
    $plugin = new Plugin();
    $plugin->run();
}
run_building_designer();