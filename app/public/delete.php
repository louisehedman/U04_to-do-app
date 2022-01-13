<?php
include 'php_db.php';
include 'headerfooter.php';


if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = "DELETE FROM list WHERE id = '$id'";
    $statement = $db->prepare($query);
    $statement->execute();
    header("Location: read.php");
    } 
 
