<h1>All Club Members</h1>
<a href="index.php?action=clubmember_create">+ Add New Club Member</a>
<table border="1">
    <thead>
       <tr>
        <th>ID</th>
        <th>Name</th>
        <th>DOB</th>
        <th>SSN</th>
        <th>Medicare #</th>
        <th>Phone</th>
        <th>Address</th>
        <th>City</th>
        <th>Province</th>
        <th>Postal Code</th>
        <th>Height</th>
        <th>Weight</th>
        <th>Minor?</th>
        <th>Actions</th>
    </tr>
</thead>
<tbody>
    <?php foreach ($members as $m): ?>
        <tr>
            <td><?= htmlspecialchars($m['club_member_id']) ?></td>
            <td><?= htmlspecialchars($m['first_name'] . ' ' . $m['last_name']) ?></td>
            <td><?= htmlspecialchars($m['date_of_birth']) ?></td>
            <td><?= htmlspecialchars($m['ssn']) ?></td>
            <td><?= htmlspecialchars($m['medicare_number']) ?></td>
            <td><?= htmlspecialchars($m['phone_number']) ?></td>
            <td><?= htmlspecialchars($m['address']) ?></td>
            <td><?= htmlspecialchars($m['city']) ?></td>
            <td><?= htmlspecialchars($m['province']) ?></td>
            <td><?= htmlspecialchars($m['postal_code']) ?></td>
            <td><?= htmlspecialchars($m['height']) ?></td>
            <td><?= htmlspecialchars($m['weight']) ?></td>
            <td><?= $m['is_minor'] ? 'Yes' : 'No' ?></td>
            <td>
                <a href="index.php?action=clubmember_edit&id=<?= $m['club_member_id'] ?>">Edit</a> |
                <a href="index.php?action=clubmember_delete&id=<?= $m['club_member_id'] ?>">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>
</table>
<br>
<a href="index.php" style="display: inline-block; margin-bottom: 10px; padding: 8px 12px; background-color: #007BFF; color: white; text-decoration: none; border-radius: 4px;">Go Back</a>
