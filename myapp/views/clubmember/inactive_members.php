<h1>Inactive Club Members</h1>
<p>Club members who have been inactive for at least 2 years and associated with at least 2 locations.</p>

<table border="1">
    <thead>
        <tr>
            <th>Club Member ID</th>
            <th>First Name</th>
            <th>Last Name</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($members)): ?>
            <?php foreach ($members as $m): ?>
                <tr>
                    <td><?= htmlspecialchars($m['club_member_id']) ?></td>
                    <td><?= htmlspecialchars($m['first_name']) ?></td>
                    <td><?= htmlspecialchars($m['last_name']) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="3">No inactive members found.</td></tr>
        <?php endif; ?>
    </tbody>
</table>


<br>
<a href="index.php" style="display: inline-block; margin-bottom: 10px; padding: 8px 12px; background-color: #007BFF; color: white; text-decoration: none; border-radius: 4px;">Go Back</a>
