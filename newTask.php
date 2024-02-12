<?php

$taskName = $_POST["task_name"] ?? "";
$taskDuration = $_POST["task_duration"] ?? null;
$taskName = trim($taskName);

if ($taskName && $taskDuration) {

    if (file_exists("tasks.json")) {
        $json = file_get_contents("tasks.json");
        $jsonArray = json_decode($json, true);
    } else {
        $jsonArray = [];
    }
    ;

    $jsonArray[$taskName] = [
        "duration" => $taskDuration . " mins",
        "completed" => false
    ];

    file_put_contents("tasks.json", json_encode($jsonArray, JSON_PRETTY_PRINT));
}
;

header("Location: index.php");