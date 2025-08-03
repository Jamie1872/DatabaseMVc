<?php
require_once __DIR__ . '/../config/database.php';

class Payment {
    public static function all() {
        $db = Database::connect();
        return $db->query("SELECT * FROM Payments")->fetchAll();
    }

    public static function getPaymentsByMember($memberId) {
        $db = Database::connect();
    
        $stmt = $db->prepare("SELECT * FROM Payments WHERE club_member_id = ? ORDER BY membership_year DESC, payment_date DESC");
        $stmt->execute([$memberId]);
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }    

    public static function addPayment($memberId, $paymentDate, $amount, $method, $year) {
        $db = Database::connect();
    
        try {
            // checks if minor
            $stmt = $db->prepare("SELECT is_minor FROM ClubMembers WHERE club_member_id = ?");
            $stmt->execute([$memberId]);
            $member = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if (!$member) {
                return ['success' => false, 'error' => 'Club member not found.'];
            }
    
            $fee = $member['is_minor'] ? 100 : 200;
    
            //checks how many payments already made for that year
            $stmt = $db->prepare("SELECT COUNT(*) as count, SUM(amount_paid) as total_paid FROM Payments WHERE club_member_id = ? AND membership_year = ?");
            $stmt->execute([$memberId, $year]);
            $paymentData = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($paymentData['count'] >= 4) {
                return ['success' => false, 'error' => 'Maximum of 4 installments reached for this year.'];
            }
    
            $totalAfter = $paymentData['total_paid'] + $amount;
            $isDonation = $totalAfter > $fee ? 1 : 0;
    
            $stmt = $db->prepare("INSERT INTO Payments (club_member_id, payment_date, membership_year, amount_paid, payment_method, is_donation)
                                  VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$memberId, $paymentDate, $year, $amount, $method, $isDonation]);
    
            return ['success' => true];
        } catch (PDOException $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }    

}