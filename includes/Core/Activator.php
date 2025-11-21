<?php
namespace BuildingDesigner\Core;

class Activator {
    public static function activate() {
        // Create database table for submissions
        global $wpdb;
        $table_name = $wpdb->prefix . 'building_designer_submissions';
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE IF NOT EXISTS $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            form_data longtext NOT NULL,
            user_email varchar(255) DEFAULT NULL,
            created_at datetime DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id)
        ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);

        // Set default options
        add_option('building_designer_email_notifications', 'yes');
        add_option('building_designer_admin_email', get_option('admin_email'));
    }
}