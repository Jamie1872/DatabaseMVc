<?php
require_once __DIR__ . '/../config/database.php';

class ClubMember {
    public static function all() {
        $db = Database::connect();
        $stmt = $db->query("SELECT * FROM ClubMembers ORDER BY last_name, first_name");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM ClubMembers WHERE club_member_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($data) {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO ClubMembers (
            first_name, last_name, date_of_birth, ssn, medicare_number,
            phone_number, address, city, province, postal_code,
            height, weight, is_minor
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $data['first_name'], $data['last_name'], $data['date_of_birth'], $data['ssn'], $data['medicare_number'],
            $data['phone_number'], $data['address'], $data['city'], $data['province'], $data['postal_code'],
            $data['height'], $data['weight'], isset($data['is_minor']) ? 1 : 0
        ]);
        return $db->lastInsertId();
    }

    public static function createAssociation($data) {
        try {
            $db = Database::connect();
            $stmt = $db->prepare("
                INSERT INTO ClubMember_Family_Association 
                (club_member_id, family_member_id, relationship_type, start_date, end_date)
                VALUES (?, ?, ?, ?, ?)
                ");

            $stmt->execute([
                $data['club_member_id'],
                $data['family_member_id'],
                $data['relationship_type'],
                $data['start_date'],
                !empty($data['end_date']) ? $data['end_date'] : null
            ]);
        } catch (PDOException $e) {
            die("Error inserting into ClubMember_Family_Association: " . $e->getMessage());
        }
    }

    public static function createAssociation2($data) {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO SecondaryFamily_Association 
            (club_member_id, primary_family_member_id, secondary_family_member_id, relationship_type)
            VALUES (:club_member_id, :primary_family_member_id, :secondary_family_member_id, :relationship_type)");
        
        $stmt->execute([
            ':club_member_id' => $data['club_member_id'],
            ':primary_family_member_id' => $data['primary_family_member_id'],
            ':secondary_family_member_id' => $data['secondary_family_member_id'],
            ':relationship_type' => $data['relationship_type']
        ]);
    }


    public static function addLocationHistory($club_member_id, $location_id, $start_date, $end_date) {
        try {
            $db = Database::connect();
            $stmt = $db->prepare("
                INSERT INTO ClubMember_Location_History (club_member_id, location_id, start_date, end_date)
                VALUES (?, ?, ?, ?)
                ");
            $stmt->execute([$club_member_id, $location_id, $start_date, $end_date]);
        } catch (PDOException $e) {
            die("Error inserting into ClubMember_Location_History: " . $e->getMessage());
        }
    }


    public static function update($id, $data) {
        $db = Database::connect();
        $stmt = $db->prepare("UPDATE ClubMembers SET
            first_name = ?, last_name = ?, date_of_birth = ?, ssn = ?, medicare_number = ?,
            phone_number = ?, address = ?, city = ?, province = ?, postal_code = ?,
            height = ?, weight = ?, is_minor = ?
            WHERE club_member_id = ?");
        return $stmt->execute([
            $data['first_name'], $data['last_name'], $data['date_of_birth'], $data['ssn'], $data['medicare_number'],
            $data['phone_number'], $data['address'], $data['city'], $data['province'], $data['postal_code'],
            $data['height'], $data['weight'], isset($data['is_minor']) ? 1 : 0,
            $id
        ]);
    }

    public static function delete($id) {
        $db = Database::connect();
        $stmt = $db->prepare("DELETE FROM ClubMembers WHERE club_member_id = ?");
        return $stmt->execute([$id]);
    }

    #query 11
    public static function getInactiveMembers(){
        $db = Database::connect();
        $sql="  SELECT 
                    cm.club_member_id,
                    cm.first_name,
                    cm.last_name
                FROM 
                    ClubMembers cm
                JOIN 
                    ClubMember_Location_History clh ON cm.club_member_id = clh.club_member_id
                GROUP BY 
                    cm.club_member_id, cm.first_name, cm.last_name
                HAVING 
                    COUNT(DISTINCT clh.location_id) >= 2
                    AND MIN(clh.start_date) <= DATE_SUB(CURDATE(), INTERVAL 2 YEAR)
                    AND SUM(CASE WHEN clh.end_date IS NULL THEN 1 ELSE 0 END) = 0
                ORDER BY 
                    cm.club_member_id ASC;";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    #query 16
    public static function getMembersWithAllRoles() {
        $db = Database::connect();
        $sql = "
        SELECT 
        cm.club_member_id,
        cm.first_name,
        cm.last_name,
        TIMESTAMPDIFF(YEAR, cm.date_of_birth, CURDATE()) AS age,
        cm.phone_number,
        cm.email,
        l.name AS location_name
        FROM 
        ClubMembers cm,
        Session_Player_Assignment spa,
        ClubMember_Location_History clh,
        Locations l
        WHERE 
        cm.club_member_id = spa.club_member_id
        AND cm.club_member_id = clh.club_member_id
        AND clh.end_date IS NULL
        AND clh.location_id = l.location_id
        GROUP BY 
        cm.club_member_id
        HAVING 
        SUM(spa.role = 'Goalkeeper') > 0
        AND SUM(spa.role = 'Defender') > 0
        AND SUM(spa.role = 'Midfielder') > 0
        AND SUM(spa.role = 'Forward') > 0
        ORDER BY 
        location_name ASC,
        cm.club_member_id ASC
        ";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    #query 18
    public static function getUndefeatedActiveMembers() {
        $db = Database::connect();
        $sql = "
        SELECT 
        cm.club_member_id,
        cm.first_name,
        cm.last_name,
        TIMESTAMPDIFF(YEAR, cm.date_of_birth, CURDATE()) AS age,
        cm.phone_number,
        cm.email,
        l.name AS location_name
        FROM 
        ClubMembers cm
        JOIN ClubMember_Location_History clh ON cm.club_member_id = clh.club_member_id AND clh.end_date IS NULL
        JOIN Locations l ON clh.location_id = l.location_id
        JOIN TeamFormation tf ON cm.club_member_id = tf.club_member_id
        JOIN Session_Player_Assignment spa ON cm.club_member_id = spa.club_member_id
        JOIN Sessions s ON spa.session_id = s.session_id
        WHERE 
        s.session_type = 'Game'
        AND s.team1_score IS NOT NULL AND s.team2_score IS NOT NULL
        AND (
            (tf.team_id = s.team1_id AND s.team1_score > s.team2_score)
            OR
            (tf.team_id = s.team2_id AND s.team2_score > s.team1_score)
            )
        AND NOT EXISTS (
            SELECT 1
            FROM TeamFormation tf2
            JOIN Session_Player_Assignment spa2 ON tf2.club_member_id = spa2.club_member_id
            JOIN Sessions s2 ON spa2.session_id = s2.session_id
            WHERE 
            tf2.club_member_id = cm.club_member_id
            AND s2.session_type = 'Game'
            AND s2.team1_score IS NOT NULL AND s2.team2_score IS NOT NULL
            AND (
                (tf2.team_id = s2.team1_id AND s2.team1_score < s2.team2_score)
                OR
                (tf2.team_id = s2.team2_id AND s2.team2_score < s2.team1_score)
                )
            )
        GROUP BY 
        cm.club_member_id
        ORDER BY 
        location_name ASC,
        cm.club_member_id ASC
        ";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    

}
