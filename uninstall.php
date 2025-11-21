<?php
/**
 * Fired when the plugin is uninstalled.
 */

// If uninstall not called from WordPress, exit
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

// Delete options
delete_option('building_designer_email_notifications');
delete_option('building_designer_admin_email');

// Drop database table
global $wpdb;
$table_name = $wpdb->prefix . 'building_designer_submissions';
$wpdb->query("DROP TABLE IF EXISTS $table_name");

// Clear any cached data
wp_cache_flush();