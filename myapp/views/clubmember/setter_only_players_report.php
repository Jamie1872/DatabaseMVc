<h1>Active Club Members Assigned Only as Setters</h1>

<table border="1">
    <thead style="background-color: #f2f2f2;">
        <tr>
            <th>Membership #</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Age</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Location</th>
        </tr>
    </thead>
    <tbody>
            <?php foreach ($members as $member): ?>
            <tr>
                <td><?= htmlspecialchars($member['membership_number'] ?? '') ?></td>
                <td><?= htmlspecialchars($member['first_name'] ?? '') ?></td>
                <td><?= htmlspecialchars($member['last_name'] ?? '') ?></td>
                <td><?= htmlspecialchars($member['age'] ?? '') ?></td>
                <td><?= htmlspecialchars($member['phone_number'] ?? '') ?></td>
                <td><?= htmlspecialchars($member['email'] ?? '') ?></td>
                <td><?= htmlspecialchars($member['location_name'] ?? '') ?></td>
            </tr>
            <?php endforeach; ?>
    </tbody>
</table>

<a href="index.php" style="display: inline-block; margin-top: 20px; padding: 8px 12px; background-color: #007BFF; color: white; text-decoration: none; border-radius: 4px;">
    Go Back
</a>