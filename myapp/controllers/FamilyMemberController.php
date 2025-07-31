<?php
require_once __DIR__ . '/../models/FamilyMember.php';

class FamilyMemberController {
    public function index() {
        $members = FamilyMember::all();
        include __DIR__ . '/../views/familymember/index.php';
    }

    public function create() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // 1. Create FamilyMember
        $family_member_id = FamilyMember::create($_POST);

        // 2. Create FamilyMember-Location association (if location selected)
        if ($family_member_id && !empty($_POST['location_id']) && !empty($_POST['start_date'])) {
            $end_date = !empty($_POST['end_date']) ? $_POST['end_date'] : null;
            FamilyMember::addLocationHistory($family_member_id, $_POST['location_id'], $_POST['start_date'], $end_date);
        }

        header("Location: index.php?action=familymember_index");
        exit;
    }
    include __DIR__ . '/../views/familymember/create.php';
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

    #query 17
    public function showHeadCoachFamilyMembers() {
    $members = FamilyMember::getFamilyMembersWhoAreHeadCoachesOfTheirChildrenLocation();
    include __DIR__ . '/../views/familymember/headcoach_familymembers_report.php';
}

}
