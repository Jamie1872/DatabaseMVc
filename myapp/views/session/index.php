<h2>All Sessions</h2>
<a href="index.php?action=session_create">+ Add New Session</a><br><br>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Type</th>
        <th>Date</th>
        <th>Time</th>
        <th>Address</th>
        <th>Team 1</th>
        <th>Team 2</th>
        <th>Scores</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($sessions as $s): ?>
    <tr>
        <td><?= $s['session_id'] ?></td>
        <td><?= $s['session_type'] ?></td>
        <td><?= $s['session_date'] ?></td>
        <td><?= $s['session_time'] ?></td>
        <td><?= htmlspecialchars($s['address']) ?></td>
        <td><?= $s['team1_id'] ?></td>
        <td><?= $s['team2_id'] ?></td>
        <td><?= $s['team1_score'] ?> - <?= $s['team2_score'] ?></td>
        <td>
            <a href="index.php?action=session_edit&id=<?= $s['session_id'] ?>">Edit</a> |
            <a href="index.php?action=session_delete&id=<?= $s['session_id'] ?>">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<br>
<a href="index.php" style="display: inline-block; margin-bottom: 10px; padding: 8px 12px; background-color: #007BFF; color: white; text-decoration: none; border-radius: 4px;">Go Back</a>
