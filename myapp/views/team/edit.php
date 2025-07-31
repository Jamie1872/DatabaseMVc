<h2>Edit Team</h2>

<form action="index.php?action=team_update" method="POST">
    <input type="hidden" name="team_id" value="<?= $team['team_id'] ?>">

    <label>Team Name: <input type="text" name="team_name" value="<?= htmlspecialchars($team['team_name']) ?>" required></label><br><br>

    <label>Gender:
        <select name="gender" required>
            <option value="">Select</option>
            <option value="Male" <?= $team['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
            <option value="Female" <?= $team['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
        </select>
    </label><br><br>

    <label>Coach:
        <select name="head_coach_id" required>
            <option value="">Select Coach</option>
            <?php foreach ($coaches as $coach): ?>
                <option value="<?= $coach['personnel_id'] ?>" <?= $coach['personnel_id'] == $team['head_coach_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($coach['first_name'] . ' ' . $coach['last_name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </label><br><br>

    <label>Location:
        <select name="location_id" required>
            <option value="">Select Location</option>
            <?php foreach ($locations as $loc): ?>
                <option value="<?= $loc['location_id'] ?>" <?= $loc['location_id'] == $team['location_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($loc['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </label><br><br>

    <button type="submit">Update Team</button>
</form>
