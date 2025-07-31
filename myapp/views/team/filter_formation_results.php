<h2>Team Formations</h2>

<?php
$current_session = null;
foreach ($formations as $f):
    $session_key = $f['session_id']; // Make sure your SQL SELECT includes session_id
    if ($current_session !== $session_key):
        if ($current_session !== null) {
            // Close previous session block
            echo "</ul></div>";
        }
        // Open new session block
        $current_session = $session_key;
?>
    <div style="border:1px solid #ccc; margin-bottom:15px; padding:10px;">
        <p><strong>Coach:</strong> <?= htmlspecialchars($f['coach_first_name']) ?> <?= htmlspecialchars($f['coach_last_name']) ?></p>
        <p><strong>Start:</strong> <?= htmlspecialchars($f['session_date']) ?> at <?= htmlspecialchars($f['session_time']) ?></p>
        <p><strong>Address:</strong> <?= htmlspecialchars($f['session_address']) ?></p>
        <p><strong>Type:</strong> <?= htmlspecialchars($f['session_type']) ?></p>
        <p><strong>Team:</strong> <?= htmlspecialchars($f['team_name']) ?></p>
        <p><strong>Score:</strong> <?= $f['team_score'] !== null ? htmlspecialchars($f['team_score']) : 'N/A' ?></p>
        <p><strong>Players:</strong></p>
        <ul>
<?php
    endif;
?>
            <li><?= htmlspecialchars($f['player_first_name']) ?> <?= htmlspecialchars($f['player_last_name']) ?> (<?= htmlspecialchars($f['player_role']) ?>)</li>
<?php endforeach; ?>

<?php if (!empty($formations)): ?>
    </ul></div> <!-- Close last session block -->
<?php endif; ?>

<a href="index.php" style="display: inline-block; margin-bottom: 10px; padding: 8px 12px; background-color: #007BFF; color: white; text-decoration: none; border-radius: 4px;">Go Back</a>
