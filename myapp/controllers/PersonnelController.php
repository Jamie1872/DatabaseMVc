<?php
require_once __DIR__ . '/../models/Personnel.php';

class PersonnelController {
    public function display() {
        $personnel = Personnel::all();
        include __DIR__ . '/../views/personnel/index.php';
    }

public function create() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Create personnel first
        $personnel_id = Personnel::create($_POST); // Modify create() to return inserted ID

        // Then create personnel-location association
        if ($personnel_id && !empty($_POST['location_id']) && !empty($_POST['start_date'])) {
            // Handle optional end_date
            $end_date = !empty($_POST['end_date']) ? $_POST['end_date'] : null;

            Personnel::addLocationHistory($personnel_id, $_POST['location_id'], $_POST['start_date'], $end_date);
        }

        header("Location: index.php?action=personnel_display");
        exit;
    } else {
        include __DIR__ . '/../views/personnel/create.php';
    }
}


public function edit() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        Personnel::update($_POST);
        header("Location: index.php?action=personnel_display");
        exit;
    } else {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $person = Personnel::find($id);
            include __DIR__ . '/../views/personnel/edit.php';
        } else {
            echo "Invalid ID.";
        }
    }
}

public function delete() {
    $id = $_GET['id'] ?? null;
    if ($id) {
        Personnel::delete($id);
    }
    header("Location: index.php?action=personnel_display");
    exit;
}
}
