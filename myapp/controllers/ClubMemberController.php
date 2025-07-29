<?php
require_once __DIR__ . '/../models/ClubMember.php';

class ClubMemberController {
    public function index() {
        $members = ClubMember::all();
        include __DIR__ . '/../views/clubmember/index.php';
    }

    public function create() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // 1. Create club member first
        $club_member_id = ClubMember::create($_POST); 

        // 2. Add location history
        if ($club_member_id && !empty($_POST['location_id']) && !empty($_POST['start_date'])) {
            $end_date = !empty($_POST['end_date']) ? $_POST['end_date'] : null;
            ClubMember::addLocationHistory($club_member_id, $_POST['location_id'], $_POST['start_date'], $end_date);
        }

        header("Location: index.php?action=clubmember_index");
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
