<h1>Add Payment for Club Member</h1>

<form method="POST" action="index.php?action=submit_payment">
    <label>Club Member ID: <input type="number" name="club_member_id" required></label><br><br>
    <label>Payment Date: <input type="date" name="payment_date" required></label><br><br>
    <label>Membership Year: <input type="number" name="membership_year" min="2000" required></label><br><br>
    <label>Amount Paid: <input type="number" step="0.01" name="amount_paid" required></label><br><br>
    <label>Payment Method:
        <select name="payment_method" required>
            <option value="Cash">Cash</option>
            <option value="Debit">Debit</option>
            <option value="Credit">Credit</option>
        </select>
    </label><br><br>
    <button type="submit">Submit Payment</button>
</form>

<a href="index.php?action=view_all_payments" style="display: inline-block; margin-top: 20px; padding: 8px 12px; background-color: #28a745; color: white; text-decoration: none; border-radius: 4px;">
    See All Payments
</a>

<a href="index.php" style="display: inline-block; margin-top: 20px; padding: 8px 12px; background-color: #007BFF; color: white; text-decoration: none; border-radius: 4px;">
    Go Back
</a>
