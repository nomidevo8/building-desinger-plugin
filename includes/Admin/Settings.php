<?php
namespace BuildingDesigner\Admin;

class Settings {
    public function init() {
        register_setting('building_designer_settings', 'building_designer_email_notifications');
        register_setting('building_designer_settings', 'building_designer_admin_email');
    }

    public static function get_option($key, $default = '') {
        return get_option($key, $default);
    }

    public static function update_option($key, $value) {
        return update_option($key, $value);
    }
}