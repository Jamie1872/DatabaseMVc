<?php
require_once __DIR__ . '/../config/database.php';

class Location {
    public static function all() {
        $db = Database::connect();
        return $db->query("SELECT * FROM Locations")->fetchAll();
    }

    public static function create($data) {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO Locations (name, type, address, city, province, postal_code, phone_number, email, max_capacity) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $data['name'], $data['type'], $data['address'], $data['city'], $data['province'],
            $data['postal_code'], $data['phone_number'], $data['email'], $data['max_capacity']
        ]);
    }

    public static function find($id) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM Locations WHERE location_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public static function update($data) {
        $db = Database::connect();
        $stmt = $db->prepare("UPDATE Locations SET name=?, type=?, address=?, city=?, province=?, postal_code=?, phone_number=?, email=?, max_capacity=? WHERE location_id=?");
        $stmt->execute([
            $data['name'], $data['type'], $data['address'], $data['city'], $data['province'],
            $data['postal_code'], $data['phone_number'], $data['email'], $data['max_capacity'],
            $data['id']
        ]);
    }

    public static function delete($id) {
        $db = Database::connect();
        $stmt = $db->prepare("DELETE FROM Locations WHERE location_id = ?");
        $stmt->execute([$id]);
    }

    public static function withFullDetails() {
        $db = Database::connect();
        $sql = "
            SELECT 
                l.location_id,
                l.name AS location_name,
                l.address,
                l.city,
                l.province,
                l.postal_code,
                l.phone_number,
                l.email AS web_address,
                l.type,
                l.max_capacity,
                CONCAT(p.first_name, ' ', p.last_name) AS general_manager_name,-- General Manager Name
                COALESCE(MINOR.count_minor, 0) AS num_minor_members,
                COALESCE(MAJOR.count_major, 0) AS num_major_members,
                COALESCE(t.team_count, 0) AS num_teams
            FROM Locations l
            LEFT JOIN Personnel_Location_History plh ON plh.location_id = l.location_id
            LEFT JOIN Personnel p ON plh.personnel_id = p.personnel_id AND p.role = 'Administrator'
            -- Count of MINOR members
            LEFT JOIN (
                SELECT location_id, COUNT(DISTINCT cm.club_member_id) AS count_minor
                FROM ClubMember_Location_History cmh
                JOIN ClubMembers cm ON cm.club_member_id = cmh.club_member_id
                WHERE cm.is_minor = TRUE
                GROUP BY location_id
            ) MINOR ON MINOR.location_id = l.location_id
            -- Count of MAJOR members
            LEFT JOIN (
                SELECT location_id, COUNT(DISTINCT cm.club_member_id) AS count_major
                FROM ClubMember_Location_History cmh
                JOIN ClubMembers cm ON cm.club_member_id = cmh.club_member_id
                WHERE cm.is_minor = FALSE
                GROUP BY location_id
            ) MAJOR ON MAJOR.location_id = l.location_id
            -- Count of teams per location
            LEFT JOIN (
                SELECT location_id, COUNT(*) AS team_count
                FROM Teams
                GROUP BY location_id
            ) t ON t.location_id = l.location_id

            ORDER BY l.province ASC, l.city ASC;

        ";

        return $db->query($sql)->fetchAll();
    }
}

