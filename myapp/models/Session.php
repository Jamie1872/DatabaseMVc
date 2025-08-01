<?php
require_once __DIR__ . '/../config/database.php';

class Session
{
    public static function all()
    {
        $db = Database::connect();
        $stmt = $db->query("SELECT * FROM Sessions");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id)
    {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM Sessions WHERE session_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($data)
    {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO Sessions (session_type, session_date, session_time, address, team1_id, team2_id, team1_score, team2_score)
                              VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $data['session_type'], $data['session_date'], $data['session_time'], $data['address'],
            $data['team1_id'], $data['team2_id'],
            $data['team1_score'] ?: null, $data['team2_score'] ?: null
        ]);
    }

    public static function update($id, $data)
    {
        $db = Database::connect();
        $stmt = $db->prepare("UPDATE Sessions SET 
            session_type = ?, session_date = ?, session_time = ?, address = ?, 
            team1_id = ?, team2_id = ?, team1_score = ?, team2_score = ?
            WHERE session_id = ?");
        $stmt->execute([
            $data['session_type'], $data['session_date'], $data['session_time'], $data['address'],
            $data['team1_id'], $data['team2_id'],
            $data['team1_score'] ?: null, $data['team2_score'] ?: null,
            $id
        ]);
    }

    public static function delete($id)
    {
        $db = Database::connect();
        $stmt = $db->prepare("DELETE FROM Sessions WHERE session_id = ?");
        $stmt->execute([$id]);
    }

    public static function getTeamSessionReport($startDate, $endDate) {
        $db = Database::connect();
    
        $sql = "
            SELECT 
                l.name AS location_name,
                COUNT(DISTINCT CASE WHEN s.session_type = 'Training' THEN s.session_id END) AS training_session_count,
                COUNT(CASE WHEN s.session_type = 'Training' THEN spa.club_member_id END) AS training_player_count,
                COUNT(DISTINCT CASE WHEN s.session_type = 'Game' THEN s.session_id END) AS game_session_count,
                COUNT(CASE WHEN s.session_type = 'Game' THEN spa.club_member_id END) AS game_player_count
            FROM Locations l
            JOIN Teams t ON t.location_id = l.location_id
            JOIN Sessions s ON s.team1_id = t.team_id OR s.team2_id = t.team_id
            LEFT JOIN Session_Player_Assignment spa ON s.session_id = spa.session_id
            WHERE s.session_date BETWEEN :start_date AND :end_date
            GROUP BY l.location_id, l.name
            HAVING game_session_count >= 4
            ORDER BY game_session_count DESC
        ";
    
        $stmt = $db->prepare($sql);
        $stmt->execute([
            ':start_date' => $startDate,
            ':end_date' => $endDate
        ]);
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
