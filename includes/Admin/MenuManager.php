<?php
namespace BuildingDesigner\Admin;

class MenuManager {
    public function add_plugin_admin_menu() {
        add_menu_page(
            'Building Designer',
            'Building Designer',
            'manage_options',
            'building-designer',
            array($this, 'display_plugin_admin_page'),
            'dashicons-admin-multisite',
            30
        );

        add_submenu_page(
            'building-designer',
            'Settings',
            'Settings',
            'manage_options',
            'building-designer-settings',
            array($this, 'display_settings_page')
        );
    }

    public function display_plugin_admin_page() {
        require_once BUILDING_DESIGNER_PATH . 'includes/Admin/views/admin-dashboard.php';
    }

    public function display_settings_page() {
        require_once BUILDING_DESIGNER_PATH . 'includes/Admin/views/settings-page.php';
    }
}