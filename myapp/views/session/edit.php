<h2>Edit Session</h2>
<form action="index.php?action=session_update" method="POST">
    <input type="hidden" name="session_id" value="<?= $session['session_id'] ?>">

    <label>Type:
        <select name="session_type" required>
            <option value="Game" <?= $session['session_type'] == 'Game' ? 'selected' : '' ?>>Game</option>
            <option value="Training" <?= $session['session_type'] == 'Training' ? 'selected' : '' ?>>Training</option>
        </select>
    </label><br><br>

    <label>Date: <input type="date" name="session_date" value="<?= $session['session_date'] ?>" required></label><br><br>
    <label>Time: <input type="time" name="session_time" value="<?= $session['session_time'] ?>" required></label><br><br>
    <label>Address: <input type="text" name="address" value="<?= htmlspecialchars($session['address']) ?>" required></label><br><br>

    <label>Team 1:
        <select name="team1_id" required>
            <?php foreach ($teams as $team): ?>
                <option value="<?= $team['team_id'] ?>" <?= $team['team_id'] == $session['team1_id'] ? 'selected' : '' ?>>
                    <?= $team['team_id'] . ' - ' . htmlspecialchars($team['team_name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </label><br><br>

    <label>Team 2:
        <select name="team2_id" required>
            <?php foreach ($teams as $team): ?>
                <option value="<?= $team['team_id'] ?>" <?= $team['team_id'] == $session['team2_id'] ? 'selected' : '' ?>>
                    <?= $team['team_id'] . ' - ' . htmlspecialchars($team['team_name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </label><br><br>

    <label>Team 1 Score: <input type="number" name="team1_score" value="<?= $session['team1_score'] ?>"></label><br><br>
    <label>Team 2 Score: <input type="number" name="team2_score" value="<?= $session['team2_score'] ?>"></label><br><br>

    <button type="submit">Update Session</button>
</form>
<a href="index.php?action=session_index">cancel</a>