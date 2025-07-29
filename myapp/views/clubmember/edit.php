<h1>Edit Club Member</h1>

<form method="POST" action="/myapp/public/index.php?action=clubmember_edit&id=<?= $member['club_member_id'] ?>">
    <label>First Name: <input type="text" name="first_name" value="<?= htmlspecialchars($member['first_name']) ?>" required></label><br>
    <label>Last Name: <input type="text" name="last_name" value="<?= htmlspecialchars($member['last_name']) ?>" required></label><br>
    <label>Date of Birth: <input type="date" name="date_of_birth" value="<?= htmlspecialchars($member['date_of_birth']) ?>" required></label><br>
    <label>SSN: <input type="text" name="ssn" value="<?= htmlspecialchars($member['ssn']) ?>"></label><br>
    <label>Medicare Number: <input type="text" name="medicare_number" value="<?= htmlspecialchars($member['medicare_number']) ?>"></label><br>
    <label>Phone Number: <input type="text" name="phone_number" value="<?= htmlspecialchars($member['phone_number']) ?>"></label><br>
    <label>Address: <input type="text" name="address" value="<?= htmlspecialchars($member['address']) ?>"></label><br>
    <label>City: <input type="text" name="city" value="<?= htmlspecialchars($member['city']) ?>"></label><br>
    <label>Province: <input type="text" name="province" value="<?= htmlspecialchars($member['province']) ?>"></label><br>
    <label>Postal Code: <input type="text" name="postal_code" value="<?= htmlspecialchars($member['postal_code']) ?>"></label><br>
    <label>Height: <input type="number" step="0.01" name="height" value="<?= htmlspecialchars($member['height']) ?>"></label><br>
    <label>Weight: <input type="number" step="0.01" name="weight" value="<?= htmlspecialchars($member['weight']) ?>"></label><br>
    <label>Is Minor: <input type="checkbox" name="is_minor" value="1" <?= $member['is_minor'] ? 'checked' : '' ?>></label><br>
    <button type="submit">Update</button>
</form>

<a href="/myapp/public/index.php?action=clubmember_index">Back to list</a>
