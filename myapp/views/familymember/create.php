<?php
// Get all locations for dropdown
require_once __DIR__ . '/../../models/Location.php';
$locations = Location::all();
?>

<h2>Add New Family Member</h2>

<form method="post" action="?action=familymember_create">
    <label>First Name: <input type="text" name="first_name" required></label><br>
    <label>Last Name: <input type="text" name="last_name" required></label><br>
    <label>Date of Birth: <input type="date" name="date_of_birth"></label><br>
    <label>SSN: <input type="text" name="ssn" required></label><br>
    <label>Medicare Number: <input type="text" name="medicare_number" required></label><br>
    <label>Phone Number: <input type="text" name="phone_number"></label><br>
    <label>Address: <input type="text" name="address"></label><br>
    <label>City: <input type="text" name="city"></label><br>
    <label>Province: <input type="text" name="province"></label><br>
    <label>Postal Code: <input type="text" name="postal_code"></label><br>
    <label>Email: <input type="email" name="email"></label><br>

    <h3>Associated Location</h3>
    <label for="location_id">Location:</label>
    <select name="location_id" id="location_id" required>
        <option value="">Select location</option>
        <?php foreach ($locations as $loc): ?>
            <option value="<?= htmlspecialchars($loc['location_id']) ?>">
                <?= htmlspecialchars($loc['name']) ?> (<?= htmlspecialchars($loc['city']) ?>)
            </option>
        <?php endforeach; ?>
    </select><br>

    <label for="start_date">Start Date:</label>
    <input type="date" name="start_date" id="start_date" required>
    <label for="end_date">End Date:</label>
    <input type="date" name="end_date" id="end_date"><br><br><br>
    
    <button type="submit">Create</button>
    <a href="?action=familymember_index">Cancel</a>
</form>
