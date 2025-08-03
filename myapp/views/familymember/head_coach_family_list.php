<h2>Head Coach Family Members at Selected Location</h2>

<?php if (!empty($results)): ?>
    <ul>
        <?php foreach ($results as $fm): ?>
            <li><?= htmlspecialchars($fm['first_name'] . ' ' . $fm['last_name'] . ' - ' . $fm['phone_number']) ?></li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No matching family members found.</p>
<?php endif; ?>
