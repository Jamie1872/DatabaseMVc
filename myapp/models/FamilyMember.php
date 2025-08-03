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

    public static function addLocationHistory($family_member_id, $location_id, $start_date, $end_date) {
    $db = Database::connect();
    $stmt = $db->prepare("
        INSERT INTO FamilyMember_Location_History (family_member_id, location_id, start_date, end_date)
        VALUES (?, ?, ?, ?)
    ");
    $stmt->execute([$family_member_id, $location_id, $start_date, $end_date]);
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
 public static function getHeadCoachFamilyMembersByLocation($locationId) {
    $db = Database::connect();

    $sql = "
        SELECT DISTINCT fm.first_name, fm.last_name, fm.phone_number
    FROM FamilyMembers fm
    JOIN ClubMember_Family_Association cmfa ON fm.family_member_id = cmfa.family_member_id
    JOIN ClubMember_Location_History clh ON cmfa.club_member_id = clh.club_member_id
    JOIN Personnel p ON p.ssn = fm.ssn  -- More reliable than matching by email
    JOIN Teams t ON t.head_coach_id = p.personnel_id
    WHERE clh.end_date IS NULL
    AND clh.location_id = :locId
    AND t.location_id = :locId;
    ";

    $stmt = $db->prepare($sql);
    $stmt->execute([':locId' => $locationId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}




    public static function getAssociatedMembers($id) {
        $db = Database::connect();

        $stmt = $db->prepare("SELECT 
            sfm.first_name AS secondary_first_name,
            sfm.last_name AS secondary_last_name,
            sfm.phone_number AS secondary_phone_number,
            cm.club_member_id,
            cm.first_name AS club_member_first_name,
            cm.last_name AS club_member_last_name,
            cm.date_of_birth,
            cm.ssn,
            cm.medicare_number,
            cm.phone_number AS club_member_phone,
            cm.address,
            cm.city,
            cm.province,
            cm.postal_code,
            sfa.relationship_type
            FROM SecondaryFamily_Association sfa
            JOIN SecondaryFamilyMembers sfm ON sfa.secondary_family_member_id = sfm.secondary_family_member_id
            JOIN ClubMembers cm ON cm.club_member_id = sfa.club_member_id
            WHERE sfa.primary_family_member_id = ?;");

        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
