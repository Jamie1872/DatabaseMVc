<?php
require_once __DIR__ . '/../config/database.php';

class Personnel {
    public static function all() {
        $db = Database::connect();
        $stmt = $db->query("SELECT * FROM Personnel");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM Personnel WHERE personnel_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($data) {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO Personnel (
            first_name, last_name, date_of_birth, ssn, medicare_number,
            phone_number, address, city, province, postal_code, email, role, mandate
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $data['first_name'], $data['last_name'], $data['date_of_birth'], $data['ssn'],
            $data['medicare_number'], $data['phone_number'], $data['address'],
            $data['city'], $data['province'], $data['postal_code'],
            $data['email'], $data['role'], $data['mandate']
        ]);
        return $db->lastInsertId();
    }

    public static function addLocationHistory($personnel_id, $location_id, $start_date, $end_date) {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO Personnel_Location_History (personnel_id, location_id, start_date, end_date) VALUES (?, ?, ?, ?)");
        $stmt->execute([$personnel_id, $location_id, $start_date, $end_date]);
    }


    public static function update($data) {
        $db = Database::connect();
        $stmt = $db->prepare("UPDATE Personnel SET
            first_name = ?, last_name = ?, date_of_birth = ?, ssn = ?, medicare_number = ?,
            phone_number = ?, address = ?, city = ?, province = ?, postal_code = ?,
            email = ?, role = ?, mandate = ?
            WHERE personnel_id = ?");
        $stmt->execute([
            $data['first_name'], $data['last_name'], $data['date_of_birth'], $data['ssn'],
            $data['medicare_number'], $data['phone_number'], $data['address'],
            $data['city'], $data['province'], $data['postal_code'],
            $data['email'], $data['role'], $data['mandate'], $data['id']
        ]);
    }

    public static function delete($id) {
        $db = Database::connect();
        $stmt = $db->prepare("DELETE FROM Personnel WHERE personnel_id = ?");
        $stmt->execute([$id]);
    }
}
