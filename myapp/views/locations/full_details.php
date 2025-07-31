<h1>All Location Full Details</h1>

<?php foreach ($locations as $loc): ?>
    <div style="border: 1px solid #ccc; padding:15px;">
        <h2><?= htmlspecialchars($loc['name'] ?? '') ?> (<?= htmlspecialchars($loc['type'] ?? '') ?>)</h2>
        <p><strong>Address:</strong> 
            <?= htmlspecialchars($loc['address'] ?? '') ?>, 
            <?= htmlspecialchars($loc['city'] ?? '') ?>, 
            <?= htmlspecialchars($loc['province'] ?? '') ?> 
            <?= htmlspecialchars($loc['postal_code'] ?? '') ?>
        </p>
        <p><strong>Phone:</strong> <?= htmlspecialchars($loc['phone_number'] ?? '') ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($loc['email'] ?? '') ?></p>
        <p><strong>Website:</strong> <?= htmlspecialchars($loc['web_address'] ?? '') ?></p>
        <p><strong>Max Capacity:</strong> <?= htmlspecialchars($loc['max_capacity'] ?? '') ?></p>
        <p><strong>General Manager:</strong> <?= htmlspecialchars($loc['general_manager_name'] ?? '') ?></p>
        <p><strong>Minor Members:</strong> <?= htmlspecialchars($loc['num_minor_members'] ?? '0') ?></p>
        <p><strong>Major Members:</strong> <?= htmlspecialchars($loc['num_major_members'] ?? '0') ?></p>
        <p><strong>Total Teams:</strong> <?= htmlspecialchars($loc['num_teams'] ?? '0') ?></p>
    </div>
<?php endforeach; ?>

<a href="index.php?action=location_display" style="display: inline-block; margin-bottom: 10px; padding: 8px 12px; background-color: #5ea0e7ff; color: white; text-decoration: none; border-radius: 4px;">← Back to Location List</a>
