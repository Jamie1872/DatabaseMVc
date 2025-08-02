<?php
require_once __DIR__ . '/../config/database.php';

function getUpcomingSessions() {
    $db = Database::connect();

    $today = date('Y-m-d');
    $nextWeek = date('Y-m-d', strtotime('+7 days'));

    $query = "
        SELECT s.*, t.team_name, t.head_coach_id, l.name AS location_name, l.location_id,
               p.first_name AS coach_first, p.last_name AS coach_last, p.email AS coach_email
        FROM Sessions s
        JOIN Teams t ON s.team1_id = t.team_id
        JOIN Locations l ON t.location_id = l.location_id
        JOIN Personnel p ON t.head_coach_id = p.personnel_id
        WHERE s.session_date BETWEEN ? AND ?
    ";
    $stmt = $db->prepare($query);
    $stmt->execute([$today, $nextWeek]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getSessionPlayers($session_id) {
    $db = Database::connect();
    $query = "
        SELECT cm.club_member_id, cm.first_name, cm.last_name, cm.email, spa.role
        FROM Session_Player_Assignment spa
        JOIN ClubMembers cm ON spa.club_member_id = cm.club_member_id
        WHERE spa.session_id = ?
    ";
    $stmt = $db->prepare($query);
    $stmt->execute([$session_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function logEmail($senderLocationId, $receiverId, $subject, $body) {
    $db = Database::connect();
    $snippet = substr($body, 0, 100);
    $stmt = $db->prepare("
        INSERT INTO EmailLog (email_date, sender_location_id, receiver_member_id, subject, body_snippet)
        VALUES (CURDATE(), ?, ?, ?, ?)
    ");
    $stmt->execute([$senderLocationId, $receiverId, $subject, $snippet]);
}


$sessions = getUpcomingSessions();

foreach ($sessions as $session) {
    $players = getSessionPlayers($session['session_id']);

    foreach ($players as $player) {
        $sessionDateTime = strtotime($session['session_date'] . ' ' . $session['session_time']);
        $formattedDate = date('l d-M-Y g:i A', $sessionDateTime);

        // Subject 
        $subject = "{$session['location_name']} {$session['team_name']} {$formattedDate} {$session['session_type']} session";

        // Body 
        $body = "Dear {$player['first_name']} {$player['last_name']},\n\n" .
            "You are scheduled for a {$session['session_type']} session on {$session['session_date']} at {$session['session_time']}.\n" .
            "Your role: {$player['role']}\n\n" .
            "Head Coach: {$session['coach_first']} {$session['coach_last']} ({$session['coach_email']})\n" .
            "Session Type: {$session['session_type']}\n" .
            "Address: {$session['address']}\n\n" .
            "Thank you.";

        logEmail($session['location_id'], $player['club_member_id'], $subject, $body);
    }
}

echo "Emails logged successfully.\n";
?>
