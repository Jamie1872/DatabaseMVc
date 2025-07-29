<h1>All Locations</h1>
<a href="index.php?action=location_create">+ Add New Location</a>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Type</th>
        <th>Address</th>
        <th>City</th>
        <th>Province</th>
        <th>Postal Code</th>
        <th>Phone Number</th>
        <th>Email</th>
        <th>Max Capacity</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($locations as $loc): ?>
        <tr>
            <td><?= htmlspecialchars($loc['location_id']) ?></td>
            <td><?= htmlspecialchars($loc['name']) ?></td>
            <td><?= htmlspecialchars($loc['type']) ?></td>
            <td><?= htmlspecialchars($loc['address']) ?></td>
            <td><?= htmlspecialchars($loc['city']) ?></td>
            <td><?= htmlspecialchars($loc['province']) ?></td>
            <td><?= htmlspecialchars($loc['postal_code']) ?></td>
            <td><?= htmlspecialchars($loc['phone_number']) ?></td>
            <td><?= htmlspecialchars($loc['email']) ?></td>
            <td><?= htmlspecialchars($loc['max_capacity']) ?></td>
            <td>
                <a href="index.php?action=location_edit&id=<?= $loc['location_id'] ?>">Edit</a>
                <a href="index.php?action=location_delete&id=<?= $loc['location_id'] ?>">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>

</table>
<br>
<a href="index.php" style="display: inline-block; margin-bottom: 10px; padding: 8px 12px; background-color: #007BFF; color: white; text-decoration: none; border-radius: 4px;">Go Back</a>
