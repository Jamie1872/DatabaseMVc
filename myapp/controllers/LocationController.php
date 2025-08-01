<?php
require_once __DIR__ . '/../models/Location.php';

class LocationController {
    public function display() {
        $locations = Location::all();
        require_once __DIR__ . '/../views/locations/index.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            Location::create($_POST);
            header("Location: index.php?action=location_display");
            exit;
        }
        require_once __DIR__ . '/../views/locations/create.php';
    }

    public function edit() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            Location::update($_POST);
            header("Location: index.php?action=location_display");
            exit;
        }

        $location = Location::find($_GET['id']);
        require_once __DIR__ . '/../views/locations/edit.php';
    }

    public function delete() {
        Location::delete($_GET['id']);
        header("Location: index.php?action=location_display");
        exit;
    }

    # query 8
    public function fullDetails() {
        $locations = Location::withFullDetails(); 
        require_once __DIR__ . '/../views/locations/full_details.php';
    }
}
