<?php
// Get all locations for dropdown
require_once __DIR__ . '/../../models/Location.php';
require_once __DIR__ . '/../../models/SecondaryFamilyMember.php';
$locations = Location::all();
$familyMembers = FamilyMember::all();
$secondaryFamilyMembers = SecondaryFamilyMember::getAll();
?>

<h1>Add New Club Member</h1>

<form method="POST" action="index.php?action=clubmember_create">
    <label>First Name: <input type="text" name="first_name" required></label><br>
    <label>Last Name: <input type="text" name="last_name" required></label><br>
    <label>Date of Birth: <input type="date" name="date_of_birth" required></label><br>
    <label>SSN: <input type="text" name="ssn" required></label><br>
    <label>Medicare Number: <input type="text" name="medicare_number"></label><br>
    <label>Phone Number: <input type="text" name="phone_number"></label><br>
    <label>Address: <input type="text" name="address"></label><br>
    <label>City: <input type="text" name="city"></label><br>
    <label>Province: <input type="text" name="province"></label><br>
    <label>Postal Code: <input type="text" name="postal_code"></label><br>
    <label>Height: <input type="number" step="0.01" name="height"></label><br>
    <label>Weight: <input type="number" step="0.01" name="weight"></label><br>
    <label>
        <input type="checkbox" name="is_minor" id="is_minor" value="1" onchange="toggleFamilySection()"> Is Minor
    </label><br>

    <div id="family_section" style="display:none; border: 1px solid #ccc; padding: 10px; margin-top: 10px;">
        <h3>Associate with Family Member</h3>
        <label>Family Member:
            <select name="family_member_id">
                <option value="">-- Select --</option>
                <?php foreach ($familyMembers as $f): ?>
                    <option value="<?= $f['family_member_id'] ?>">
                        <?= $f['family_member_id'] . ' - ' . htmlspecialchars($f['first_name'] . ' ' . $f['last_name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label><br>
        <label>Relationship Type: <input type="text" name="relationship_type"></label><br>
        <label>Start Date: <input type="date" name="family_start_date"></label><br>
        <label>End Date: <input type="date" name="family_end_date"></label><br>
    </div>

    <div id="secondary_family_section" style="display:none; border: 1px dashed #999; padding: 10px; margin-top: 10px;">
        <h3>Optionally Associate with Secondary Family Member</h3>

        <label>Secondary Family Member:
            <select name="secondary_family_member_id">
                <option value="">-- Select --</option>
                <?php foreach ($secondaryFamilyMembers as $sf): ?>
                    <option value="<?= $sf['secondary_family_member_id'] ?>">
                        <?= $sf['secondary_family_member_id'] . ' - ' . htmlspecialchars($sf['first_name'] . ' ' . $sf['last_name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label><br>

        <label>Relationship Type:
            <input type="text" name="secondary_relationship_type">
        </label><br>
    </div>


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
</form>

<a href="index.php?action=clubmember_index">Back to list</a>

<script>
    function toggleFamilySection() {
        const isMinorCheckbox = document.getElementById('is_minor');
        const familySection = document.getElementById('family_section');
        const inputs = familySection.querySelectorAll('input, select');

        if (isMinorCheckbox.checked) {
            familySection.style.display = 'block';
            inputs.forEach(input => input.disabled = false);
        } else {
            familySection.style.display = 'none';
            inputs.forEach(input => input.disabled = true);
        }
    }

// Initialize on page load in case of form resubmission
    window.onload = toggleFamilySection;
</script>

<script>
    function toggleFamilySection() {
        const isMinorCheckbox = document.getElementById('is_minor');
        const familySection = document.getElementById('family_section');
        const secondarySection = document.getElementById('secondary_family_section');

        const familyInputs = familySection.querySelectorAll('input, select');
        const secondaryInputs = secondarySection.querySelectorAll('input, select');

        const enableSection = (section, inputs, show) => {
            section.style.display = show ? 'block' : 'none';
            inputs.forEach(input => input.disabled = !show);
        };

        const show = isMinorCheckbox.checked;
        enableSection(familySection, familyInputs, show);
        enableSection(secondarySection, secondaryInputs, show);
    }

    window.onload = toggleFamilySection;
</script>

