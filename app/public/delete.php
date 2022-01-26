<?php
include 'php_db.php';
include 'headerfooter.php';

// If the delete link in read.php is clicked the affected row will get deleted from database

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = "DELETE FROM list WHERE id = '$id'";
    $stmt = $db->prepare($query);
    $stmt->execute();
    header("Location: read.php");
}
