<?php
include 'db.php';

if (isset($_POST['send'])) {
    $name = htmlspecialchars($_POST['task']);

    $sql = "INSERT INTO taskslist (name) VALUES ('$name')";

    $val = $db->query($sql);

    if ($val) {
        header('location: index.php');
    }
}
