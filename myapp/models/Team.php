<?php
require_once __DIR__ . '/../config/database.php';

class Team
{
    public static function all()
    {
        $db = Database::connect();
        $stmt = $db->query("SELECT * FROM Teams");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create($data)
    {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO Teams (team_name, gender, head_coach_id, location_id) VALUES (?, ?, ?, ?)");
        $stmt->execute([
            $data['team_name'],
            $data['gender'],
            $data['head_coach_id'],
            $data['location_id']
        ]);
    }

    public static function getAll()
    {
        $db = Database::connect();
        $stmt = $db->query("SELECT Teams.*, Personnel.first_name AS coach_first, Personnel.last_name AS coach_last, Locations.name AS location_name 
                            FROM Teams 
                            JOIN Personnel ON Teams.head_coach_id = Personnel.personnel_id 
                            JOIN Locations ON Teams.location_id = Locations.location_id
                            ORDER BY team_name");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id)
    {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM Teams WHERE team_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function update($id, $data)
    {
        $db = Database::connect();
        $stmt = $db->prepare("UPDATE Teams SET team_name = ?, gender = ?, head_coach_id = ?, location_id = ? WHERE team_id = ?");
        $stmt->execute([
            $data['team_name'],
            $data['gender'],
            $data['head_coach_id'],
            $data['location_id'],
            $id
        ]);
    }

    public static function delete($id)
    {
        $db = Database::connect();
        $stmt = $db->prepare("DELETE FROM Teams WHERE team_id = ?");
        $stmt->execute([$id]);
    }
}
