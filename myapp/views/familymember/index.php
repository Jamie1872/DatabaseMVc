<h2>Family Members</h2>
<a href="?action=familymember_create">+ Add New Family Member</a>

<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>First Name</th><th>Last Name</th>
            <th>Date of Birth</th><th>SSN</th><th>Medicare #</th>
            <th>Phone</th><th>Address</th><th>City</th><th>Province</th><th>Postal Code</th><th>Email</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($members as $m): ?>
        <tr>
            <td><?= htmlspecialchars($m['family_member_id']) ?></td>
            <td><?= htmlspecialchars($m['first_name']) ?></td>
            <td><?= htmlspecialchars($m['last_name']) ?></td>
            <td><?= htmlspecialchars($m['date_of_birth']) ?></td>
            <td><?= htmlspecialchars($m['ssn']) ?></td>
            <td><?= htmlspecialchars($m['medicare_number']) ?></td>
            <td><?= htmlspecialchars($m['phone_number']) ?></td>
            <td><?= htmlspecialchars($m['address']) ?></td>
            <td><?= htmlspecialchars($m['city']) ?></td>
            <td><?= htmlspecialchars($m['province']) ?></td>
            <td><?= htmlspecialchars($m['postal_code']) ?></td>
            <td><?= htmlspecialchars($m['email']) ?></td>
            <td>
                <a href="?action=familymember_edit&id=<?= $m['family_member_id'] ?>">Edit</a> |
                <a href="?action=familymember_delete&id=<?= $m['family_member_id'] ?>">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<br>
<a href="/myapp/public/index.php" style="display: inline-block; margin-bottom: 10px; padding: 8px 12px; background-color: #007BFF; color: white; text-decoration: none; border-radius: 4px;">Go Back</a>