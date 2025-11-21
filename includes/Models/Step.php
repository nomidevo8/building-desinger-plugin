<?php
namespace BuildingDesigner\Models;

class Step {
    private $id;
    private $title;
    private $description;
    private $options;

    public function __construct($id, $title, $description, $options = []) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->options = $options;
    }

    public function get_id() {
        return $this->id;
    }

    public function get_title() {
        return $this->title;
    }

    public function get_description() {
        return $this->description;
    }

    public function get_options() {
        return $this->options;
    }

    public function add_option($option) {
        $this->options[] = $option;
    }
}