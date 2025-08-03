<?php
require_once __DIR__ . '/../config/database.php';

class EmailLog {
    public static function all() {
        $db = Database::connect();
        $stmt = $db->query("
            SELECT el.*, cm.first_name, cm.last_name 
            FROM EmailLog el
            JOIN ClubMembers cm ON el.receiver_member_id = cm.club_member_id
            ORDER BY email_date DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
