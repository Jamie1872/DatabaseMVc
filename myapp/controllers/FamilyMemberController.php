<?php
require_once __DIR__ . '/../models/FamilyMember.php';

class FamilyMemberController {
    public function index() {
        $members = FamilyMember::all();
        include __DIR__ . '/../views/familymember/index.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            FamilyMember::create($_POST);
            header("Location: index.php?action=familymember_index");
            exit;
        } else {
            include __DIR__ . '/../views/familymember/create.php';
        }
    }

    public function edit() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header("Location: index.php?action=familymember_index");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            FamilyMember::update($id, $_POST);
            header("Location: index.php?action=familymember_index");
            exit;
        } else {
            $member = FamilyMember::find($id);
            if (!$member) {
                header("Location: index.php?action=familymember_index");
                exit;
            }
            include __DIR__ . '/../views/familymember/edit.php';
        }
    }

    public function delete() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            FamilyMember::delete($id);
        }
        header("Location: index.php?action=familymember_index");
        exit;
    }
}
