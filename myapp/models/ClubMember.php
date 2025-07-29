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
}
