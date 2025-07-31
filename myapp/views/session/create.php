<h2>Create Session</h2>
<form action="index.php?action=session_store" method="POST">
    <label>Type:
        <select name="session_type" required>
            <option value="Game">Game</option>
            <option value="Training">Training</option>
        </select>
    </label><br><br>

    <label>Date: <input type="date" name="session_date" required></label><br><br>
    <label>Time: <input type="time" name="session_time" required></label><br><br>
    <label>Address: <input type="text" name="address" required></label><br><br>

    <label>Team 1:
        <select name="team1_id" required>
            <option value="">Select Team</option>
            <?php foreach ($teams as $team): ?>
                <option value="<?= $team['team_id'] ?>">
                    <?= $team['team_id'] . ' - ' . htmlspecialchars($team['team_name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </label><br><br>

    <label>Team 2:
        <select name="team2_id" required>
            <option value="">Select Team</option>
            <?php foreach ($teams as $team): ?>
                <option value="<?= $team['team_id'] ?>">
                    <?= $team['team_id'] . ' - ' . htmlspecialchars($team['team_name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </label><br><br>

    <label>Team 1 Score (optional): <input type="number" name="team1_score"></label><br><br>
    <label>Team 2 Score (optional): <input type="number" name="team2_score"></label><br><br>

    <button type="submit">Create Session</button>
</form>

<a href="index.php?action=session_index">Back to list</a>