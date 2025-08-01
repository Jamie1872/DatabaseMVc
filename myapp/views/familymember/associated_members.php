<h2>Associated Members</h2>

<?php if (!empty($associatedMembers)): ?>
    <h3>Secondary Family Member: <?= htmlspecialchars($associatedMembers[0]['secondary_first_name']) ?>
        <?= htmlspecialchars($associatedMembers[0]['secondary_last_name']) ?>
        (<?= htmlspecialchars($associatedMembers[0]['secondary_phone_number']) ?>)
    </h3>

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>Membership #</th><th>First Name</th><th>Last Name</th><th>DOB</th><th>SSN</th>
                <th>Medicare #</th><th>Phone</th><th>Address</th><th>City</th><th>Province</th>
                <th>Postal Code</th><th>Relationship</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($associatedMembers as $member): ?>
            <tr>
                <td><?= htmlspecialchars($member['club_member_id']) ?></td>
                <td><?= htmlspecialchars($member['club_member_first_name']) ?></td>
                <td><?= htmlspecialchars($member['club_member_last_name']) ?></td>
                <td><?= htmlspecialchars($member['date_of_birth']) ?></td>
                <td><?= htmlspecialchars($member['ssn']) ?></td>
                <td><?= htmlspecialchars($member['medicare_number']) ?></td>
                <td><?= htmlspecialchars($member['club_member_phone']) ?></td>
                <td><?= htmlspecialchars($member['address']) ?></td>
                <td><?= htmlspecialchars($member['city']) ?></td>
                <td><?= htmlspecialchars($member['province']) ?></td>
                <td><?= htmlspecialchars($member['postal_code']) ?></td>
                <td><?= htmlspecialchars($member['relationship_type']) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No associated club members found.</p>
<?php endif; ?>

<a href="?action=familymember_index">Back to Family Members</a>