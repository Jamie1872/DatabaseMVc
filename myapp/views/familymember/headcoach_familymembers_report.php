<h2>Family Members Who Are Also Head Coaches at Their Child's Location</h2>
<table border="1">
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Phone Number</th>
    </tr>
    <?php foreach ($members as $member): ?>
    <tr>
        <td><?= htmlspecialchars($member['first_name']) ?></td>
        <td><?= htmlspecialchars($member['last_name']) ?></td>
        <td><?= htmlspecialchars($member['phone_number']) ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<a href="index.php" style="display: inline-block; margin-top: 15px; padding: 8px 12px; background-color: #007BFF; color: white; text-decoration: none; border-radius: 4px;">Go Back</a>
