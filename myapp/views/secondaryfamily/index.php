<h2>Secondary Family Members</h2>
<a href="?action=secondaryfamily_create">+ Add New Secondary Family Member</a>

<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th><th>First Name</th><th>Last Name</th><th>Phone Number</th><th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($members as $m): ?>
        <tr>
            <td><?= htmlspecialchars($m['secondary_family_member_id']) ?></td>
            <td><?= htmlspecialchars($m['first_name']) ?></td>
            <td><?= htmlspecialchars($m['last_name']) ?></td>
            <td><?= htmlspecialchars($m['phone_number']) ?></td>
            <td>
                <a href="?action=secondaryfamily_edit&id=<?= $m['secondary_family_member_id'] ?>">Edit</a> |
                <a href="?action=secondaryfamily_delete&id=<?= $m['secondary_family_member_id'] ?>">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<br>
<a href="index.php" style="display: inline-block; margin-bottom: 10px; padding: 8px 12px; background-color: #007BFF; color: white; text-decoration: none; border-radius: 4px;">Go Back</a>