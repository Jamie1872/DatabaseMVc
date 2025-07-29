<?php
require_once __DIR__ . '/../config/database.php';

class SecondaryFamilyMember
{
    public function getAll()
    {
        $db = Database::connect();
        $stmt = $db->query("SELECT * FROM SecondaryFamilyMembers ORDER BY last_name, first_name");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM SecondaryFamilyMembers WHERE secondary_family_member_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO SecondaryFamilyMembers (first_name, last_name, phone_number) VALUES (?, ?, ?)");
        return $stmt->execute([$data['first_name'], $data['last_name'], $data['phone_number']]);
    }

    public function update($id, $data)
    {
        $db = Database::connect();
        $stmt = $db->prepare("UPDATE SecondaryFamilyMembers SET first_name = ?, last_name = ?, phone_number = ? WHERE secondary_family_member_id = ?");
        return $stmt->execute([$data['first_name'], $data['last_name'], $data['phone_number'], $id]);
    }

    public function delete($id)
    {
        $db = Database::connect();
        $stmt = $db->prepare("DELETE FROM SecondaryFamilyMembers WHERE secondary_family_member_id = ?");
        return $stmt->execute([$id]);
    }
}
