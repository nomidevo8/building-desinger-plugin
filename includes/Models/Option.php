<?php
namespace BuildingDesigner\Models;

class Option {
    private $value;
    private $label;
    private $image;
    private $description;

    public function __construct($value, $label, $image = '', $description = '') {
        $this->value = $value;
        $this->label = $label;
        $this->image = $image;
        $this->description = $description;
    }

    public function get_value() {
        return $this->value;
    }

    public function get_label() {
        return $this->label;
    }

    public function get_image() {
        return $this->image;
    }

    public function get_description() {
        return $this->description;
    }

    public function to_array() {
        return [
            'value' => $this->value,
            'label' => $this->label,
            'image' => $this->image,
            'description' => $this->description
        ];
    }
}