<h1>Edit Personnel</h1>

<form action="/myapp/public/index.php?action=personnel_edit" method="POST">
    <input type="hidden" name="id" value="<?= htmlspecialchars($person['personnel_id']) ?>">

    <label>First Name: <input type="text" name="first_name" value="<?= htmlspecialchars($person['first_name']) ?>" required></label><br>
    <label>Last Name: <input type="text" name="last_name" value="<?= htmlspecialchars($person['last_name']) ?>" required></label><br>
    <label>Date of Birth: <input type="date" name="date_of_birth" value="<?= htmlspecialchars($person['date_of_birth']) ?>"></label><br>
    <label>SSN: <input type="text" name="ssn" value="<?= htmlspecialchars($person['ssn']) ?>" required></label><br>
    <label>Medicare Number: <input type="text" name="medicare_number" value="<?= htmlspecialchars($person['medicare_number']) ?>" required></label><br>
    <label>Phone Number: <input type="text" name="phone_number" value="<?= htmlspecialchars($person['phone_number']) ?>"></label><br>
    <label>Address: <input type="text" name="address" value="<?= htmlspecialchars($person['address']) ?>"></label><br>
    <label>City: <input type="text" name="city" value="<?= htmlspecialchars($person['city']) ?>"></label><br>
    <label>Province: <input type="text" name="province" value="<?= htmlspecialchars($person['province']) ?>"></label><br>
    <label>Postal Code: <input type="text" name="postal_code" value="<?= htmlspecialchars($person['postal_code']) ?>"></label><br>
    <label>Email: <input type="email" name="email" value="<?= htmlspecialchars($person['email']) ?>"></label><br>
    <label>Role:
        <select name="role" required>
            <?php
            $roles = ['Administrator', 'Captain', 'Coach', 'Assistant Coach', 'Other'];
            foreach ($roles as $role) {
                $selected = ($person['role'] === $role) ? 'selected' : '';
                echo "<option value=\"$role\" $selected>$role</option>";
            }
            ?>
        </select>
    </label><br>
    <label>Mandate:
        <select name="mandate" required>
            <option value="Volunteer" <?= $person['mandate'] === 'Volunteer' ? 'selected' : '' ?>>Volunteer</option>
            <option value="Salaried" <?= $person['mandate'] === 'Salaried' ? 'selected' : '' ?>>Salaried</option>
        </select>
    </label><br><br>

    <button type="submit">Update</button>
</form>

<a href="/myapp/public/index.php?action=personnel_display">Back to list</a>
