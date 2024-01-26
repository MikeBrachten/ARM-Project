<?php
/*
*   Backend file
*   This file provides functionality to return the data to Qualtrics.
*/

// Content is JSON
header('Content-Type: application/json');

// Function to get data by ID
function getDataById($id, $filePath) {
    $data = [];

    // Open the CSV file
    if (($handle = fopen($filePath, "r")) !== FALSE) {
        while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
            // Check if the ID matches
            if ($row[0] === $id) {
                $data[] = array(
                    'ParticipantID' => $row[0],
                    'EntryTime' => $row[1],
                    'ExitTime' => $row[2],
                    'TimeSpent' => $row[3],
                    'IPAddress' => $row[4]
                );
            }
        }
        fclose($handle);
    }

    return $data;
}

// Get the ID from the request
$participantId = isset($_GET['id']) ? $_GET['id'] : '';

// Specify the path to your CSV file
$filePath = 'db/privacy_policy_visits.csv';

// Retrieve the data
$data = getDataById($participantId, $filePath);

// Return JSON data
echo json_encode($data);

?>
