<h2>Edit Assignment</h2>

<form action="index.php?action=team_assignment_update" method="POST">
    <input type="hidden" name="club_member_id" value="<?= $assignment['club_member_id'] ?>">
    <input type="hidden" name="team_id" value="<?= $assignment['team_id'] ?>">

    <label>Position:
        <select name="position" required>
            <option value="Setter" <?= $assignment['position'] == 'Setter' ? 'selected' : '' ?>>Setter</option>
            <option value="Outside Hitter" <?= $assignment['position'] == 'Outside Hitter' ? 'selected' : '' ?>>Outside Hitter</option>
            <option value="Opposite Hitter" <?= $assignment['position'] == 'Opposite Hitter' ? 'selected' : '' ?>>Opposite Hitter</option>
            <option value="Middle Blocker" <?= $assignment['position'] == 'Middle Blocker' ? 'selected' : '' ?>>Middle Blocker</option>
            <option value="Defensive Specialist" <?= $assignment['position'] == 'Defensive Specialist' ? 'selected' : '' ?>>Defensive Specialist</option>
            <option value="Libero" <?= $assignment['position'] == 'Libero' ? 'selected' : '' ?>>Libero</option>
        </select>

    </label><br><br>

    <label>Start Date: <input type="date" name="start_date" value="<?= $assignment['start_date'] ?>" required></label><br><br>
    <label>End Date: <input type="date" name="end_date" value="<?= $assignment['end_date'] ?>"></label><br><br>

    <button type="submit">Update</button>
</form>

<br>
<a href="index.php?action=team_assign&id=<?= $assignment['team_id'] ?>">cancel</a>
