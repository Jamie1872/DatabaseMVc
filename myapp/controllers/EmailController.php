<?php
class EmailController {
    public function generateEmails() {
        require_once __DIR__ . '/../scripts/send_weekly_emails.php';
        echo "<p>Emails generated and logged successfully.</p>";
        echo "<a href='index.php?action=view_email_log'>View Email Log</a>";
    }

    public function viewEmailLog() {
        $db = Database::connect();
        $stmt = $db->query("
            SELECT el.*, l.name AS sender_location, cm.first_name, cm.last_name
            FROM EmailLog el
            JOIN Locations l ON el.sender_location_id = l.location_id
            JOIN ClubMembers cm ON el.receiver_member_id = cm.club_member_id
            ORDER BY el.email_date DESC
        ");
        $emails = $stmt->fetchAll(PDO::FETCH_ASSOC);
        include __DIR__ . '/../views/emails/log.php';
    }
}
