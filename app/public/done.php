<?php 
include 'php_db.php';

if (isset($_GET['as'], $_GET['row'])) {
    $as = $_GET['as'];
    $row = $_GET['row'];
    
    $query = $db->prepare("UPDATE list SET done = 1 WHERE id = :row");
    $query->execute(['row' => $row]);
    header("Location: read.php");
 }