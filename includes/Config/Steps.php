<?php
namespace BuildingDesigner\Config;

use BuildingDesigner\Models\Step;

class Steps {
    public static function get_all_steps() {
        return [
            new Step(
                'building_use',
                'Building Use',
                'What will you use your building for?',
                Options::get_building_use_options()
            ),
            new Step(
                'framing_type',
                'Construction Framing Type',
                'Select framing type',
                Options::get_framing_type_options()
            ),
            new Step(
                'roof_pitch',
                'Roof Pitch',
                'Select roof pitch',
                Options::get_roof_pitch_options()
            ),
            new Step(
                'truss_spacing',
                'Truss Spacing and Length',
                'Select truss spacing',
                Options::get_truss_spacing_options()
            ),
            new Step(
                'dimensions',
                'Width and Height',
                'Choose building dimensions',
                [] // Handled differently - input fields
            )
        ];
    }

    public static function get_step_count() {
        return count(self::get_all_steps());
    }
}