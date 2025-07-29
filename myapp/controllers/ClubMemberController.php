<?php
require_once __DIR__ . '/../models/ClubMember.php';

class ClubMemberController {
    public function index() {
        $members = ClubMember::all();
        include __DIR__ . '/../views/clubmember/index.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = ClubMember::create($_POST);
            header('Location: index.php?action=clubmember_index');
            exit;
        } else {
            include __DIR__ . '/../views/clubmember/create.php';
        }
    }

    public function edit() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: index.php?action=clubmember_index');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            ClubMember::update($id, $_POST);
            header('Location: index.php?action=clubmember_index');
            exit;
        } else {
            $member = ClubMember::find($id);
            if (!$member) {
                header('Location: index.php?action=clubmember_index');
                exit;
            }
            include __DIR__ . '/../views/clubmember/edit.php';
        }
    }

    public function delete() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            ClubMember::delete($id);
        }
        header('Location: index.php?action=clubmember_index');
        exit;
    }
}
