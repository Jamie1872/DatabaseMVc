<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . '/../models/Payment.php';

class PaymentController {
    public function index() {
        $members = Payment::all();
        include __DIR__ . '/../views/payment/index.php';
    }
    
    public function viewAllPayments() {
        $payments = Payment::all();
        include __DIR__ . '/../views/payment/view_all_payments.php';
    }

    public function addPaymentForm() {
        include __DIR__ . '/../views/payment/add_payment_form.php';
    }
    
    public function submitPayment() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $memberId = $_POST['club_member_id'];
            $date = $_POST['payment_date'];
            $amount = $_POST['amount_paid'];
            $method = $_POST['payment_method'];
            $year = $_POST['membership_year'];
    
            $result = Payment::addPayment($memberId, $date, $amount, $method, $year);

            $payments = Payment::getPaymentsByMember($memberId);
    
            if ($result['success']) {
                $message = "Payment successfully recorded.";
            } else {
                $message = "Error: " . $result['error'];
            }
    
            include __DIR__ . '/../views/payment/add_payment_result.php';
        }
    }

}