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
}

