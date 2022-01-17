<?php
include 'php_db.php';
include 'headerfooter.php';


if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = "DELETE FROM list WHERE id = '$id'";
    $stmt = $db->prepare($query);
    $stmt->execute();
    header("Location: read.php");
}
