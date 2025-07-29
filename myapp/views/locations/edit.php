<h1>Edit Location</h1>
<form action="ndex.php?action=location_edit" method="POST">
    <input type="hidden" name="id" value="<?= $location['location_id'] ?>">
    Name: <input name="name" value="<?= $location['name'] ?>"><br>
    Type: <select name="type">
        <option <?= $location['type']=='Head'?'selected':'' ?>>Head</option>
        <option <?= $location['type']=='Branch'?'selected':'' ?>>Branch</option>
    </select><br>
    Address: <input name="address" value="<?= $location['address'] ?>"><br>
    City: <input name="city" value="<?= $location['city'] ?>"><br>
    Province: <input name="province" value="<?= $location['province'] ?>"><br>
    Postal Code: <input name="postal_code" value="<?= $location['postal_code'] ?>"><br>
    Phone: <input name="phone_number" value="<?= $location['phone_number'] ?>"><br>
    Email: <input name="email" value="<?= $location['email'] ?>"><br>
    Max Capacity: <input name="max_capacity" type="number" value="<?= $location['max_capacity'] ?>"><br>
    <button type="submit">Update</button>
</form>

<a href="index.php?action=location_display">Back to list</a>