<h2>Email Log</h2>

<table border="1">
    <tr>
        <th>Date</th>
        <th>Sender Location</th>
        <th>Receiver</th>
        <th>Subject</th>
        <th>Snippet</th>
    </tr>
    <?php foreach ($emails as $email): ?>
        <tr>
            <td><?= htmlspecialchars($email['email_date']) ?></td>
            <td><?= htmlspecialchars($email['sender_location']) ?></td>
            <td><?= htmlspecialchars($email['first_name'] . ' ' . $email['last_name']) ?></td>
            <td><?= htmlspecialchars($email['subject']) ?></td>
            <td><?= htmlspecialchars($email['body_snippet']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>
