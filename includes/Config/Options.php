<?php
namespace BuildingDesigner\Config;

use BuildingDesigner\Models\Option;

class Options {
    public static function get_building_use_options() {
        return [
            new Option('residential', 'Residential', 'residential.jpg', 'For home or garage'),
            new Option('commercial', 'Commercial', 'commercial.jpg', 'For business use'),
            new Option('agricultural', 'Agricultural', 'agricultural.jpg', 'For farm buildings'),
            new Option('storage', 'Storage', 'storage.jpg', 'For storage purposes')
        ];
    }

    public static function get_framing_type_options() {
        return [
            new Option(
                'post_frame',
                'Post Frame Construction',
                'post-frame.jpg',
                'Uses treated posts or laminated columns for vertical supports. Truss spacing available at 9\', 8\', 6\', or 4\' oc spacing. 12\' to 70\' wide buildings available to choose from. 8\' to 20\' tall buildings available to choose from.'
            ),
            new Option(
                'ladder_frame',
                'Ladder Frame Construction',
                'ladder-frame.jpg',
                'Great alternative to stud framed buildings. Uses 2-ply or 3-ply studs 4\' oc with 4\' oc trusses. 2x6 wall girts laid horizontally between wall studs. Tip up the wall sections on top of concrete. 12\' to 60\' wide buildings available to choose from.'
            )
        ];
    }

    public static function get_roof_pitch_options() {
        return [
            new Option('3_12', '3:12 Pitch', 'pitch-3-12.jpg'),
            new Option('4_12', '4:12 Pitch', 'pitch-4-12.jpg'),
            new Option('5_12', '5:12 Pitch', 'pitch-5-12.jpg'),
            new Option('6_12', '6:12 Pitch', 'pitch-6-12.jpg')
        ];
    }

    public static function get_truss_spacing_options() {
        return [
            new Option('4ft', '4 feet', 'spacing-4ft.jpg'),
            new Option('6ft', '6 feet', 'spacing-6ft.jpg'),
            new Option('8ft', '8 feet', 'spacing-8ft.jpg'),
            new Option('9ft', '9 feet', 'spacing-9ft.jpg')
        ];
    }
}