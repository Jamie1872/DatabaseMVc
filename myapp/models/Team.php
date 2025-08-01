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

    public static function getFormationsByLocationAndDate($locationId, $startDate, $endDate) {
        $db = Database::connect();
        $stmt = $db->prepare("
           SELECT 
                s.session_id,
                s.session_date,
                s.session_time,
                s.session_type,
                s.address AS session_address,
                
                CASE 
                    WHEN t.team_id = s.team1_id THEN 'Team 1'
                    ELSE 'Team 2'
                END AS team_side,

                t.team_name,
                
                p.first_name AS coach_first_name,
                p.last_name AS coach_last_name,

                cm.first_name AS player_first_name,
                cm.last_name AS player_last_name,
                spa.role AS player_role,

                CASE 
                    WHEN t.team_id = s.team1_id THEN s.team1_score
                    ELSE s.team2_score
                END AS team_score

            FROM Sessions s

            -- Join both teams involved in the session
            JOIN Teams t ON t.team_id IN (s.team1_id, s.team2_id)

            -- Join location of each team
            JOIN Locations l ON t.location_id = l.location_id

            -- Join coach info
            JOIN Personnel p ON p.personnel_id = t.head_coach_id

            -- Join session-player assignments
            JOIN Session_Player_Assignment spa ON spa.session_id = s.session_id

            -- Join player info
            JOIN ClubMembers cm ON cm.club_member_id = spa.club_member_id

            -- Ensure the player is part of this team
            JOIN TeamFormation tf ON tf.club_member_id = cm.club_member_id AND tf.team_id = t.team_id

            -- Filters
            WHERE 
                l.location_id = ?
                AND s.session_date BETWEEN ? AND ?

            ORDER BY 
                s.session_date, s.session_time, t.team_name, cm.last_name;
        ");
        $stmt->execute([$locationId, $startDate, $endDate]);
        return $stmt->fetchAll();
    }
}
