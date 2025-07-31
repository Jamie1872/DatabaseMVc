<?php
require_once __DIR__ . '/../../models/Personnel.php';
$coaches = Personnel::getCoaches(); // Only get personnel with role 'Coach'

?>
<h2>Create a New Team</h2>

<form action="index.php?action=team_store" method="POST">
    <label>Team Name: <input type="text" name="team_name" required></label><br><br>

    <label>Gender:
        <select name="gender" required>
            <option value="">Select</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>
    </label><br><br>

    <label>Coach:
        <select name="head_coach_id" required>
            <option value="">Select Coach</option>
            <?php foreach ($coaches as $coach): ?>
                <option value="<?= $coach['personnel_id'] ?>">
                    <?= $coach['personnel_id'] . ' - ' . htmlspecialchars($coach['first_name'] . ' ' . $coach['last_name']) ?>
                </option>

            <?php endforeach; ?>
        </select>
    </label><br><br>

    <label>Location:
        <select name="location_id" required>
            <option value="">Select Location</option>
            <?php foreach ($locations as $loc): ?>
                <option value="<?= $loc['location_id'] ?>">
                    <?= htmlspecialchars($loc['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </label><br><br>

    <button type="submit">Create Team</button>
</form>
