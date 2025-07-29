<h2>Edit Secondary Family Member</h2>

<form method="post" action="?action=secondaryfamily_edit&id=<?= $member['secondary_family_member_id'] ?>">
    <label>First Name: <input type="text" name="first_name" value="<?= htmlspecialchars($member['first_name']) ?>" required></label><br>
    <label>Last Name: <input type="text" name="last_name" value="<?= htmlspecialchars($member['last_name']) ?>" required></label><br>
    <label>Phone Number: <input type="text" name="phone_number" value="<?= htmlspecialchars($member['phone_number']) ?>"></label><br>
    <button type="submit">Update</button>
    <a href="?action=secondaryfamily_index">Cancel</a>
</form>
