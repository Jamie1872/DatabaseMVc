<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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

            //3. If minor and family member selected, associate them
            if (
                isset($_POST['is_minor']) && $_POST['is_minor'] &&
                !empty($_POST['family_member_id']) &&
                !empty($_POST['relationship_type']) &&
            !empty($_POST['family_start_date']) // renamed to avoid collision
        ) {
                $associationData = [
                    'club_member_id' => $club_member_id,
                    'family_member_id' => $_POST['family_member_id'],
                    'relationship_type' => $_POST['relationship_type'],
                    'start_date' => $_POST['family_start_date'],
                    'end_date' => $_POST['family_end_date'] ?? null
                ];
                ClubMember::createAssociation($associationData);

                // 4. Optional secondary family member association
                if (!empty($_POST['secondary_family_member_id']) && !empty($_POST['secondary_relationship_type'])) {
                    ClubMember::createAssociation2([
                        'club_member_id' => $club_member_id,
                        'primary_family_member_id' => $_POST['family_member_id'],
                        'secondary_family_member_id' => $_POST['secondary_family_member_id'],
                        'relationship_type' => $_POST['secondary_relationship_type']
                    ]);
                }
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


    # Query 13
    public function showNeverAssignedMembers() {
        $members = ClubMember::getNeverAssignedMembers();
        include __DIR__ . '/../views/clubmember/never_assigned_members_report.php';
    }

    # Query 14
    public function showActiveMembersJoinedAsMinors() {
        $members = ClubMember::getActiveMembersJoinedAsMinors();
        include __DIR__ . '/../views/clubmember/active_members_joined_as_minors.php';
    }

    # Query 15
    public function showSetterOnlyPlayers() {
        $members = ClubMember::getSetterOnlyPlayers();
        include __DIR__ . '/../views/clubmember/setter_only_players_report.php';
    }   

# query 16
    public function showRoleCompleteMembers() {
        $members = ClubMember::getMembersWithAllRoles();
        include __DIR__ . '/../views/clubmember/role_complete_report.php';
    }

#query 18
    public function showUndefeatedMembers() {
        $members = ClubMember::getUndefeatedActiveMembers();
        include __DIR__ . '/../views/clubmember/undefeated_report.php';
    }

}
