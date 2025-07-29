<h2>Edit Family Member</h2>

<form method="post" action="?action=familymember_edit&id=<?= $member['family_member_id'] ?>">
    <label>First Name: <input type="text" name="first_name" value="<?= htmlspecialchars($member['first_name']) ?>" required></label><br>
    <label>Last Name: <input type="text" name="last_name" value="<?= htmlspecialchars($member['last_name']) ?>" required></label><br>
    <label>Date of Birth: <input type="date" name="date_of_birth" value="<?= htmlspecialchars($member['date_of_birth']) ?>"></label><br>
    <label>SSN: <input type="text" name="ssn" value="<?= htmlspecialchars($member['ssn']) ?>" required></label><br>
    <label>Medicare Number: <input type="text" name="medicare_number" value="<?= htmlspecialchars($member['medicare_number']) ?>" required></label><br>
    <label>Phone Number: <input type="text" name="phone_number" value="<?= htmlspecialchars($member['phone_number']) ?>"></label><br>
    <label>Address: <input type="text" name="address" value="<?= htmlspecialchars($member['address']) ?>"></label><br>
    <label>City: <input type="text" name="city" value="<?= htmlspecialchars($member['city']) ?>"></label><br>
    <label>Province: <input type="text" name="province" value="<?= htmlspecialchars($member['province']) ?>"></label><br>
    <label>Postal Code: <input type="text" name="postal_code" value="<?= htmlspecialchars($member['postal_code']) ?>"></label><br>
    <label>Email: <input type="email" name="email" value="<?= htmlspecialchars($member['email']) ?>"></label><br>
    <button type="submit">Update</button>
    <a href="?action=familymember_index">Cancel</a>
</form>
