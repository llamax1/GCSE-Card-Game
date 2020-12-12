<?php
header('Content-Type: application/json');

$lb = json_decode(file_get_contents('leaderboard.json'), true);

$output = [];

for ($i = 0; $i <= 4; $i++) {
    array_push($output, $lb[$i]);
}

echo json_encode($output);

?>