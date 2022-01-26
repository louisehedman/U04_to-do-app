<?php
include 'php_db.php';

/* If the done link is clicked the tinyint will change to 1, and the class done will be activated
in read.php which line through the title and task */

if (isset($_GET['as'], $_GET['row'])) {
    $as = $_GET['as'];
    $row = $_GET['row'];

    $query = $db->prepare("UPDATE list SET done = 1 WHERE id = :row");
    $query->execute(['row' => $row]);
    header("Location: read.php");
}
