<h2>Active Club Members Who Never Lost a Game</h2>
<table border="1">
    <tr>
        <th>Membership #</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Age</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Location</th>
    </tr>
    <?php foreach ($members as $member): ?>
        <tr>
            <td><?= htmlspecialchars($member['club_member_id']) ?></td>
            <td><?= htmlspecialchars($member['first_name']) ?></td>
            <td><?= htmlspecialchars($member['last_name']) ?></td>
            <td><?= htmlspecialchars($member['age']) ?></td>
            <td><?= htmlspecialchars($member['phone_number']) ?></td>
            <td><?= htmlspecialchars($member['email']) ?></td>
            <td><?= htmlspecialchars($member['location_name']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<a href="index.php" style="display: inline-block; margin-top: 15px; background-color: #007BFF; color: white; padding: 8px 12px; text-decoration: none; border-radius: 4px;">Go Back</a>
