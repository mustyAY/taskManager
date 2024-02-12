<?php

$tasks = [];

if (file_exists("tasks.json")) {
    $json = file_get_contents("tasks.json");
    $tasks = json_decode($json, true);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body style="text-align: center; margin-top: 64px;">

    <form action="newTask.php" method="post">
        <input type="text" name="task_name" placeholder="Enter your task">
        <input type="number" name="task_duration" placeholder="and duration in mins">
        <button>New Task</button>
    </form>

    <br>

    <?php foreach ($tasks as $taskName => $task) : ?>
        <div style="margin-bottom: 20px;">
            <form action="change_status.php" method="post" style="display: inline-block;">
                <input type="hidden" name="task_name" value="<?= $taskName ?>">
                <input type="checkbox" <?= $task["completed"] ? "checked" : "" ?>>
            </form>
            <?= "{$taskName} for {$task["duration"]}" ?>
            <form action="delete.php" method="post" style="display: inline-block;">
                <input type="hidden" name="task_name" value="<?= $taskName ?>">
                <button>Delete</button>
            </form>
        </div>
    <?php endforeach ?>

    <script>
        const checkboxes = document.querySelectorAll("input[type=checkbox]");
        checkboxes.forEach(checkbox => {
            checkbox.onclick = function() {
                this.parentNode.submit();
            }
        });
    </script>
</body>

</html>