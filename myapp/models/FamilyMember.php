<?php
require_once __DIR__ . '/../config/database.php';

class FamilyMember {
    public static function all() {
        $db = Database::connect();
        $stmt = $db->query("SELECT * FROM FamilyMembers ORDER BY last_name, first_name");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM FamilyMembers WHERE family_member_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($data) {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO FamilyMembers (
            first_name, last_name, date_of_birth, ssn, medicare_number,
            phone_number, address, city, province, postal_code, email
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $data['first_name'], $data['last_name'], $data['date_of_birth'], $data['ssn'], $data['medicare_number'],
            $data['phone_number'], $data['address'], $data['city'], $data['province'], $data['postal_code'], $data['email']
        ]);
        return $db->lastInsertId();
    }

    public static function update($id, $data) {
        $db = Database::connect();
        $stmt = $db->prepare("UPDATE FamilyMembers SET
            first_name=?, last_name=?, date_of_birth=?, ssn=?, medicare_number=?,
            phone_number=?, address=?, city=?, province=?, postal_code=?, email=?
            WHERE family_member_id=?");
        return $stmt->execute([
            $data['first_name'], $data['last_name'], $data['date_of_birth'], $data['ssn'], $data['medicare_number'],
            $data['phone_number'], $data['address'], $data['city'], $data['province'], $data['postal_code'], $data['email'],
            $id
        ]);
    }

    public static function delete($id) {
        $db = Database::connect();
        $stmt = $db->prepare("DELETE FROM FamilyMembers WHERE family_member_id = ?");
        return $stmt->execute([$id]);
    }

    #query 17
    public static function getFamilyMembersWhoAreHeadCoachesOfTheirChildrenLocation() {
    $db = Database::connect();
    $sql = "
        SELECT DISTINCT
            fm.first_name,
            fm.last_name,
            fm.phone_number
        FROM 
            FamilyMembers fm,
            ClubMember_Family_Association cmfa,
            ClubMembers cm,
            ClubMember_Location_History cmh,
            Teams t,
            Personnel p,
            Personnel_Location_History plh
        WHERE 
            fm.family_member_id = cmfa.family_member_id
            AND cmfa.club_member_id = cm.club_member_id
            AND cm.club_member_id = cmh.club_member_id
            AND cmh.end_date IS NULL
            AND p.ssn = fm.ssn
            AND t.head_coach_id = p.personnel_id
            AND t.location_id = cmh.location_id
            AND plh.personnel_id = p.personnel_id
            AND plh.location_id = cmh.location_id
            AND plh.end_date IS NULL
    ";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


}
