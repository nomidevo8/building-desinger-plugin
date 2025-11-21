<?php
namespace BuildingDesigner\Core;

class Deactivator {
    public static function deactivate() {
        // Cleanup tasks on deactivation
        flush_rewrite_rules();
    }
}