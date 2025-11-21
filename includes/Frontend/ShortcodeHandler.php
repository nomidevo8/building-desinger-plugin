<?php
namespace BuildingDesigner\Frontend;

class ShortcodeHandler {
    public function register_shortcodes() {
        add_shortcode('building_designer', array($this, 'render_form_shortcode'));
    }

    public function render_form_shortcode($atts) {
        $renderer = new FormRenderer();
        return $renderer->render();
    }
}