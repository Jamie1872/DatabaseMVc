<h2>Head Coach Family Members at Selected Location</h2>

<?php if (empty($results)): ?>
    <p>No head coach family members found for this location.</p>
<?php else: ?>
    <table border="1">
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Phone Number</th>
        </tr>
        <?php foreach ($results as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row['first_name']) ?></td>
            <td><?= htmlspecialchars($row['last_name']) ?></td>
            <td><?= htmlspecialchars($row['phone_number']) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>
