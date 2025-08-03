<h1>All Club Member Payments</h1>

<?php if (!empty($payments)): ?>
    <table border="1" cellpadding="6">
        <thead style="background-color: #f2f2f2;">
            <tr>
                <th>Member #</th>
                <th>Payment Date</th>
                <th>Membership Year</th>
                <th>Amount Paid</th>
                <th>Method</th>
                <th>Donation?</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($payments as $p): ?>
                <tr>
                    <td><?= htmlspecialchars($p['club_member_id']) ?></td>
                    <td><?= htmlspecialchars($p['payment_date']) ?></td>
                    <td><?= htmlspecialchars($p['membership_year']) ?></td>
                    <td>$<?= htmlspecialchars($p['amount_paid']) ?></td>
                    <td><?= htmlspecialchars($p['payment_method']) ?></td>
                    <td><?= $p['is_donation'] ? 'Yes' : 'No' ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No payments have been added yet.</p>
<?php endif; ?>

<br>
<a href="index.php?action=add_payment_form" style="margin-top: 20px; display:inline-block;"> Back to Add Payment Form</a>
