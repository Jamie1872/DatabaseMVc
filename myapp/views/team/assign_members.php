<?php
require_once __DIR__ . '/../../models/ClubMember.php';
$members = ClubMember::getEligibleMembersForTeam($team['team_id']);
?>

<h2>Assign Club Member to Team: <?= htmlspecialchars($team['team_name']) ?></h2>

<form action="index.php?action=team_assign_store" method="POST">
    <input type="hidden" name="team_id" value="<?= $team['team_id'] ?>">

    <label>Club Member:
        <select name="club_member_id" required>
            <option value="">Select Member</option>
            <?php foreach ($members as $member): ?>
                <option value="<?= $member['club_member_id'] ?>">
                    <?= htmlspecialchars($member['club_member_id'] . ' - ' . $member['first_name'] . ' ' . $member['last_name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </label><br><br>

    <label>Position:
        <select name="position" required>
            <option value="Goalkeeper">Goalkeeper</option>
            <option value="Defender">Defender</option>
            <option value="Midfielder">Midfielder</option>
            <option value="Forward">Forward</option>
        </select>
    </label><br><br>

    <label>Start Date: <input type="date" name="start_date" required></label><br><br>
    <label>End Date: <input type="date" name="end_date"></label><br><br>

    <button type="submit">Assign</button>
</form>

<h3>Current Assignments</h3>
<table border="1" cellpadding="5">
    <tr>
        <th>Member</th>
        <th>Position</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($assignments as $a): ?>
        <tr>
            <td><?= htmlspecialchars($a['first_name'] . ' ' . $a['last_name']) ?></td>
            <td><?= $a['position'] ?></td>
            <td><?= $a['start_date'] ?></td>
            <td><?= $a['end_date'] ?: '-' ?></td>
            <td>
                <a href="index.php?action=team_assignment_edit&club_member_id=<?= $a['club_member_id'] ?>&team_id=<?= $a['team_id'] ?>">Edit</a> |
                <a href="index.php?action=team_assignment_delete&club_member_id=<?= $a['club_member_id'] ?>&team_id=<?= $a['team_id'] ?>">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<br>
<a href="index.php?action=team_index">Back to Team List</a>
