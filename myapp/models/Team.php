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
                
                t.team_name,
                
                p.first_name AS coach_first_name,
                p.last_name AS coach_last_name,
                
                spa.role AS player_role,
                cm.first_name AS player_first_name,
                cm.last_name AS player_last_name,
                
                -- Show NULL if session is in the future
                IF(s.session_date > CURDATE(), NULL, 
                    CASE 
                        WHEN s.team1_id = t.team_id THEN s.team1_score
                        ELSE s.team2_score
                    END
                ) AS team_score
                
            FROM Sessions s

            -- Team 1 Join
            JOIN Teams t ON s.team1_id = t.team_id OR s.team2_id = t.team_id

            -- Filter to given location
            JOIN Locations l ON t.location_id = l.location_id

            -- Join Head Coach info
            JOIN Personnel p ON t.head_coach_id = p.personnel_id

            -- Join player assignments in sessions
            JOIN Session_Player_Assignment spa ON spa.session_id = s.session_id

            -- Join player details
            JOIN ClubMembers cm ON spa.club_member_id = cm.club_member_id

            -- Only include players from this team (team1 or team2)
            JOIN TeamFormation tf ON tf.club_member_id = cm.club_member_id AND tf.team_id = t.team_id

            -- Filters
            WHERE 
                l.location_id = ?
                AND s.session_date BETWEEN ? AND ?
            ORDER BY 
                s.session_date ASC, s.session_time ASC;
        ");
        $stmt->execute([$locationId, $startDate, $endDate]);
        return $stmt->fetchAll();
    }
}
