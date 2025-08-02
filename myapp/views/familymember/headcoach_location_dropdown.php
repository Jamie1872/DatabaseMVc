<h2>Select Location</h2>

<form method="GET" action="index.php">
    <input type="hidden" name="action" value="headcoach_familymembers_report">

    <label for="location_id">Choose a location:</label>
    <select name="location_id" id="location_id" required>
        <option value="" disabled selected>Select a location</option>
        <option value="1">Montreal HQ</option>
        <option value="2">Laval Branch</option>
    </select>

    <br><br>
    <button type="submit">Search</button>
</form>
