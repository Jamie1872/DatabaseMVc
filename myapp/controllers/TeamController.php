<?php
require_once __DIR__ . '/../models/Team.php';
require_once __DIR__ . '/../models/Personnel.php';
require_once __DIR__ . '/../models/Location.php';
require_once __DIR__ . '/../config/database.php';

class TeamController
{
    public function index()
    {
        $teams = Team::getAll();
        include __DIR__ . '/../views/team/index.php';
    }

    public function create()
    {
        $coaches = Personnel::all();
        $locations = Location::all();
        include __DIR__ . '/../views/team/create.php';
    }

    public function store()
    {
        Team::create($_POST);
        header('Location: index.php?action=team_index');
    }

    public function edit()
    {
        $id = $_GET['id'];
        $team = Team::getById($id);
        $coaches = Personnel::all();
        $locations = Location::all();
        include __DIR__ . '/../views/team/edit.php';
    }

    public function update()
    {
        $id = $_POST['team_id'];
        Team::update($id, $_POST);
        header('Location: index.php?action=team_index');
    }

    public function delete()
    {
        $id = $_GET['id'];
        Team::delete($id);
        header('Location: index.php?action=team_index');
    }

    public function assignMembers() {
        $team_id = $_GET['id'];
        $db = Database::connect();
        $team = $db->query("SELECT * FROM Teams WHERE team_id = $team_id")->fetch(PDO::FETCH_ASSOC);
        $members = $db->query("SELECT * FROM ClubMembers ORDER BY last_name, first_name")->fetchAll(PDO::FETCH_ASSOC);
        $assignments = $db->query("
            SELECT tf.*, cm.first_name, cm.last_name 
            FROM TeamFormation tf 
            JOIN ClubMembers cm ON tf.club_member_id = cm.club_member_id 
            WHERE tf.team_id = $team_id
            ")->fetchAll(PDO::FETCH_ASSOC);
        include __DIR__ . '/../views/team/assign_members.php';
    }

    public function assignMembersStore() {
        $db = Database::connect();
        $club_member_id = $_POST['club_member_id'];
        $team_id = $_POST['team_id'];
        $position = $_POST['position'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'] ?: null;

    // Check for conflicting assignments
        $conflictStmt = $db->prepare("
            SELECT * FROM TeamFormation 
            WHERE club_member_id = ? 
            AND team_id != ? 
            AND (
                (start_date <= ? AND (end_date IS NULL OR end_date >= ?)) OR
                (start_date <= ? AND (end_date IS NULL OR end_date >= ?))
                )
            ");
        $conflictStmt->execute([$club_member_id, $team_id, $start_date, $start_date, $end_date, $end_date]);
        $conflict = $conflictStmt->fetch();

        if ($conflict) {
            echo " Conflict: Member already scheduled in another team's session within 3 hours.";
            return;
        }

        $stmt = $db->prepare("
            INSERT INTO TeamFormation (club_member_id, team_id, position, start_date, end_date) 
            VALUES (?, ?, ?, ?, ?)
            ");
        $stmt->execute([$club_member_id, $team_id, $position, $start_date, $end_date]);

        header("Location: index.php?action=team_assign&id=$team_id");
    }

    public function editAssignment() {
        $club_member_id = $_GET['club_member_id'];
        $team_id = $_GET['team_id'];
        $db = Database::connect();
        $assignment = $db->prepare("SELECT * FROM TeamFormation WHERE club_member_id = ? AND team_id = ?");
        $assignment->execute([$club_member_id, $team_id]);
        $assignment = $assignment->fetch(PDO::FETCH_ASSOC);
        include __DIR__ . '/../views/team/edit_assignment.php';
    }

    public function updateAssignment() {
        $db = Database::connect();
        $club_member_id = $_POST['club_member_id'];
        $team_id = $_POST['team_id'];
        $position = $_POST['position'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'] ?: null;

    // Optional: Repeat conflict check here if needed

        $stmt = $db->prepare("
            UPDATE TeamFormation 
            SET position = ?, start_date = ?, end_date = ? 
            WHERE club_member_id = ? AND team_id = ?
            ");
        $stmt->execute([$position, $start_date, $end_date, $club_member_id, $team_id]);

        header("Location: index.php?action=team_assign&id=$team_id");
    }

    public function deleteAssignment() {
        $club_member_id = $_GET['club_member_id'];
        $team_id = $_GET['team_id'];
        $db = Database::connect();
        $stmt = $db->prepare("DELETE FROM TeamFormation WHERE club_member_id = ? AND team_id = ?");
        $stmt->execute([$club_member_id, $team_id]);
        header("Location: index.php?action=team_assign&id=$team_id");
    }


}
