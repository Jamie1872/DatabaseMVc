<h1>All Personnel</h1>
<a href="/myapp/public/index.php?action=personnel_create">+ Add New Personnel</a>
<table border="1">
    <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Date of Birth</th>
        <th>SSN</th>
        <th>Medicare Number</th>
        <th>Phone Number</th>
        <th>Address</th>
        <th>City</th>
        <th>Province</th>
        <th>Postal Code</th>
        <th>Email</th>
        <th>Role</th>
        <th>Mandate</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($personnel as $p): ?>
        <tr>
            <td><?= htmlspecialchars($p['personnel_id']) ?></td>
            <td><?= htmlspecialchars($p['first_name']) ?></td>
            <td><?= htmlspecialchars($p['last_name']) ?></td>
            <td><?= htmlspecialchars($p['date_of_birth']) ?></td>
            <td><?= htmlspecialchars($p['ssn']) ?></td>
            <td><?= htmlspecialchars($p['medicare_number']) ?></td>
            <td><?= htmlspecialchars($p['phone_number']) ?></td>
            <td><?= htmlspecialchars($p['address']) ?></td>
            <td><?= htmlspecialchars($p['city']) ?></td>
            <td><?= htmlspecialchars($p['province']) ?></td>
            <td><?= htmlspecialchars($p['postal_code']) ?></td>
            <td><?= htmlspecialchars($p['email']) ?></td>
            <td><?= htmlspecialchars($p['role']) ?></td>
            <td><?= htmlspecialchars($p['mandate']) ?></td>
            <td>
                <a href="/myapp/public/index.php?action=personnel_edit&id=<?= $p['personnel_id'] ?>">Edit</a>
                <!-- <a href="/myapp/public/index.php?action=personnel_delete&id=<?= $p['personnel_id'] ?>" onclick="return confirm('Delete?')">Delete</a> -->
                <a href="/myapp/public/index.php?action=personnel_delete&id=<?= $p['personnel_id'] ?>">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<br>
<a href="/myapp/public/index.php" style="display: inline-block; margin-bottom: 10px; padding: 8px 12px; background-color: #007BFF; color: white; text-decoration: none; border-radius: 4px;">Go Back</a>