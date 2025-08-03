<?php
require_once __DIR__ . '/../../config/database.php';


$db = Database::connect();
$stmt = $db->query("SELECT location_id, name FROM Locations ORDER BY name ASC");
$locations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Select Location</h2>

<form method="GET" action="index.php">
    <input type="hidden" name="action" value="headcoach_familymembers_report">

    <label for="location_id">Choose a location:</label>
    <select name="location_id" id="location_id" required>
        <option value="" disabled selected>Select a location</option>
        <?php foreach ($locations as $loc): ?>
            <option value="<?= htmlspecialchars($loc['location_id']) ?>">
                <?= htmlspecialchars($loc['name']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <br><br>
    <button type="submit">Search</button>
</form>
