<h2>Filter Team Formations</h2>
<form action="index.php?action=formation_filter_results" method="post">
    <label for="location_id">Location:</label>
    <select name="location_id" required>
        <?php foreach ($locations as $location): ?>
            <option value="<?= $location['location_id'] ?>"><?= htmlspecialchars($location['name']) ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label for="start_date">From:</label>
    <input type="date" name="start_date" required><br><br>

    <label for="end_date">To:</label>
    <input type="date" name="end_date" required><br><br>

    <button type="submit">Search</button>
</form>

<a href="index.php" style="display: inline-block; margin-bottom: 10px; padding: 8px 12px; background-color: #007BFF; color: white; text-decoration: none; border-radius: 4px;">Go Back</a>