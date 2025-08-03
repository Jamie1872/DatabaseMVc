<?php
require_once __DIR__ . '/../config/database.php';

function logEmail($receiverMemberId, $senderLocationId, $subject, $body) {
    $db = Database::connect();

    $snippet = substr($body, 0, 100);  // Optional truncation

    $stmt = $db->prepare("
        INSERT INTO EmailLog (email_date, sender_location_id, receiver_member_id, subject, body_snippet)
        VALUES (CURDATE(), ?, ?, ?, ?)
    ");
    
    $stmt->execute([$senderLocationId, $receiverMemberId, $subject, $snippet]);
}

