<?php
$db = new Mysqli;

$db->connect('localhost', 'root', '', 'todolist');

if ($db) {
    // echo "Connect to database successfully";
}
if ($db->connect_error) {
    echo "Connection failed: " . $db->connect_error;
    exit();
}
