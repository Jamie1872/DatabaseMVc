<h1>Add Location</h1>
<form action="/myapp/public/index.php?action=location_create" method="POST">
    Name: <input name="name"><br>
    Type: <select name="type"><option value="Head">Head</option><option value="Branch">Branch</option></select><br>
    Address: <input name="address"><br>
    City: <input name="city"><br>
    Province: <input name="province"><br>
    Postal Code: <input name="postal_code"><br>
    Phone: <input name="phone_number"><br>
    Email: <input name="email"><br>
    Max Capacity: <input type="number" name="max_capacity"><br>
    <button type="submit">Create</button>
</form>
