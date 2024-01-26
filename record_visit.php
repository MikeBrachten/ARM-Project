<?php
    session_start();

    // Function to record the visit
    function recordVisit($participantId, $entryTime, $exitTime, $timeSpent, $ipAddress) {
        $file = 'db/privacy_policy_visits.csv';
        $line = "$participantId, $entryTime, $exitTime, $timeSpent, $ipAddress\n";

        file_put_contents($file, $line, FILE_APPEND | LOCK_EX);
    }

    $participantId = isset($_POST['participant_id']) ? $_POST['participant_id'] : 'unknown';
    $ipAddress = $_SERVER['REMOTE_ADDR'];

    // Check if the session or IP already recorded and record data
    if (!isset($_SESSION['recorded'])) {
        $_SESSION['recorded'] = true;

        $entryTime = $_POST['entryTime'];
        $exitTime = $_POST['exitTime'];
        $timeSpent = $_POST['timeSpent'];

        // Record the visit
        recordVisit($participantId, $entryTime, $exitTime, $timeSpent, $ipAddress);
    }
?>
