<h2>Team Formations</h2>

<?php
$current_session = null;
$current_team = null;

foreach ($formations as $f):
    $session_key = $f['session_id'];
    $team_key = $session_key . '_' . $f['team_name']; // Unique key for team within session

    // New session
    if ($current_session !== $session_key):
        if ($current_session !== null) {
            // Close previous team & session blocks
            echo "</ul></div></div>";
        }
        $current_session = $session_key;
        $current_team = null;
?>
    <div style="border:2px solid #444; margin-bottom:20px; padding:10px;">
        <p><strong>Session:</strong> <?= htmlspecialchars($f['session_date']) ?> at <?= htmlspecialchars($f['session_time']) ?></p>
        <p><strong>Location:</strong> <?= htmlspecialchars($f['session_address']) ?></p>
        <p><strong>Type:</strong> <?= htmlspecialchars($f['session_type']) ?></p>
<?php
    endif;

    // New team block inside session
    if ($current_team !== $team_key):
        if ($current_team !== null) {
            // Close previous team player list
            echo "</ul></div>";
        }
        $current_team = $team_key;
?>
        <div style="border:1px solid #ccc; margin:10px 0; padding:10px;">
            <p><strong><?= htmlspecialchars($f['team_side']) ?>: <?= htmlspecialchars($f['team_name']) ?></strong></p>
            <p><strong>Coach:</strong> <?= htmlspecialchars($f['coach_first_name']) ?> <?= htmlspecialchars($f['coach_last_name']) ?></p>
            <p><strong>Score:</strong> <?= $f['team_score'] !== null ? htmlspecialchars($f['team_score']) : 'N/A' ?></p>
            <p><strong>Players:</strong></p>
            <ul>
<?php
    endif;
?>
                <li><?= htmlspecialchars($f['player_first_name']) ?> <?= htmlspecialchars($f['player_last_name']) ?> (<?= htmlspecialchars($f['player_role']) ?>)</li>
<?php endforeach; ?>

<?php if (!empty($formations)): ?>
        </ul></div></div> <!-- Close final team and session block -->
<?php endif; ?>

<a href="index.php" style="display: inline-block; margin-top: 20px; padding: 8px 12px; background-color: #007BFF; color: white; text-decoration: none; border-radius: 4px;">Go Back</a>
