<h2>Team List</h2>
<a href="index.php?action=team_create">+ Create New Team</a><br><br>

<table border="1" cellpadding="5">
    <tr>
        <th>Name</th>
        <th>Gender</th>
        <th>Coach</th>
        <th>Location</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($teams as $team): ?>
        <tr>
            <td><?= htmlspecialchars($team['team_name']) ?></td>
            <td><?= $team['gender'] ?></td>
            <td><?= htmlspecialchars($team['coach_first'] . ' ' . $team['coach_last']) ?></td>
            <td><?= htmlspecialchars($team['location_name']) ?></td>
            <td>
                <a href="index.php?action=team_edit&id=<?= $team['team_id'] ?>">Edit</a> |
                <a href="index.php?action=team_delete&id=<?= $team['team_id'] ?>">Delete</a> | <a href="index.php?action=team_assign&id=<?= $team['team_id'] ?>">Assign Members</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<br>
<a href="index.php" style="display: inline-block; margin-bottom: 10px; padding: 8px 12px; background-color: #007BFF; color: white; text-decoration: none; border-radius: 4px;">Go Back</a>
