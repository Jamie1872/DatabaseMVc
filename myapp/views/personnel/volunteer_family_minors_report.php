<h2>Volunteer Personnel Who Are Family of Minor Club Members</h2>
<table border="1">
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Minor Members Count</th>
        <th>Phone Number</th>
        <th>Email</th>
        <th>Location</th>
        <th>Role</th>
    </tr>
    <?php foreach ($volunteers as $v): ?>
        <tr>
            <td><?= htmlspecialchars($v['first_name']) ?></td>
            <td><?= htmlspecialchars($v['last_name']) ?></td>
            <td><?= htmlspecialchars($v['minor_count']) ?></td>
            <td><?= htmlspecialchars($v['phone_number']) ?></td>
            <td><?= htmlspecialchars($v['email']) ?></td>
            <td><?= htmlspecialchars($v['location_name']) ?></td>
            <td><?= htmlspecialchars($v['role']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<a href="index.php" style="display:inline-block; margin-top:10px;">Go Back</a>
