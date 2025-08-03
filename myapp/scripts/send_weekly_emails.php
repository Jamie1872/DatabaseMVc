<?php
require_once __DIR__ . '/../config/database.php';

// Get upcoming sessions in the next 7 days
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

// Get players from both teams (team1 and team2)
function getSessionPlayers($team1_id, $team2_id) {
    $db = Database::connect();

    $query = "
        SELECT cm.club_member_id, cm.first_name, cm.last_name, cm.email, tf.position
        FROM TeamFormation tf
        JOIN ClubMembers cm ON tf.club_member_id = cm.club_member_id
        WHERE tf.team_id IN (?, ?)
    ";

    $stmt = $db->prepare($query);
    $stmt->execute([$team1_id, $team2_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


// Log email to EmailLog table
function logEmail($senderLocationId, $receiverId, $subject, $body) {
    $db = Database::connect();
    $snippet = substr($body, 0, 100);
    $stmt = $db->prepare("
        INSERT INTO EmailLog (email_date, sender_location_id, receiver_member_id, subject, body_snippet)
        VALUES (CURDATE(), ?, ?, ?, ?)
    ");
    $stmt->execute([$senderLocationId, $receiverId, $subject, $snippet]);
}

// Main execution
$sessions = getUpcomingSessions();

foreach ($sessions as $session) {
    $players = getSessionPlayers($session['team1_id'], $session['team2_id']);


    foreach ($players as $player) {
        $sessionDateTime = strtotime($session['session_date'] . ' ' . $session['session_time']);
        $formattedDate = date('l d-M-Y g:i A', $sessionDateTime);

        $subject = "{$session['location_name']} {$session['team_name']} {$formattedDate} {$session['session_type']} session";

        $body = "Dear {$player['first_name']} {$player['last_name']},\n\n" .
            "You are scheduled for a {$session['session_type']} session on {$session['session_date']} at {$session['session_time']}.\n" .
            "Your position: {$player['position']}\n\n" .
            "Head Coach: {$session['coach_first']} {$session['coach_last']} ({$session['coach_email']})\n" .
            "Session Type: {$session['session_type']}\n" .
            "Address: {$session['address']}\n\n" .
            "Thank you.";

        //echo "Logging email for {$player['first_name']} {$player['last_name']}...\n";
        logEmail($session['location_id'], $player['club_member_id'], $subject, $body);
    }
}

echo "Emails logged successfully.\n";
?>