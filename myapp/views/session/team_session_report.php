<h1>Team Session Formation Report by Location</h1>

<form method="GET" action="index.php">
    <input type="hidden" name="action" value="team_session_report">
    <label>Start Date:
        <input type="date" name="start_date" value="<?= htmlspecialchars($_GET['start_date'] ?? '') ?>" required>
    </label>
    <label style="margin-left: 20px;">End Date:
        <input type="date" name="end_date" value="<?= htmlspecialchars($_GET['end_date'] ?? '') ?>" required>
    </label>
    <button type="submit" style="margin-left: 20px;">Generate Report</button>
</form>

<?php if (isset($report) && count($report) > 0): ?>
    <table border="1" >
        <thead style="background-color: #f2f2f2;">
            <tr>
                <th>Location</th>
                <th>Training Sessions</th>
                <th>Players in Training</th>
                <th>Game Sessions</th>
                <th>Players in Games</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($report as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['location_name']) ?></td>
                    <td><?= htmlspecialchars($row['training_session_count']) ?></td>
                    <td><?= htmlspecialchars($row['training_player_count']) ?></td>
                    <td><?= htmlspecialchars($row['game_session_count']) ?></td>
                    <td><?= htmlspecialchars($row['game_player_count']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php elseif (isset($_GET['start_date'])): ?>
    <p style="margin-top: 20px;">No data found or no locations with at least 4 game sessions found in this period.</p>
<?php endif; ?>

<a href="index.php" style="display:inline-block; margin-top:20px; padding:8px 12px; background-color:#007BFF; color:white; text-decoration:none; border-radius:4px;">
    Go Back
</a>