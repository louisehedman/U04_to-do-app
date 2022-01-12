<?php
include('php_db.php');

$update = false;
$title = '';
$task = '';
$id = 0;

if (isset($_GET['update'])) {
    $id = $_GET['update'];
    $update = true;
    $rows = $db->query("SELECT * FROM list");
 
    foreach ($rows as $row) {
       $title = $row['title'];
       $task = $row['task'];
    }    
 }
 
 if (isset($_POST['update'])) {
    if (empty($_POST['title'])) {
       $notset = "Title can't be blank";
    }
    elseif (ctype_space($_POST['title']) || ctype_space($_POST['task'])){
       $notset = "Input can't consist of whitespace";
    }
    $id = $_POST['id'];
    $title = $_POST['title'];
    $task = $_POST['task'];
    $query = "UPDATE list SET title = '$title', task = '$task' WHERE id = '$id'";
    $statement = $db->prepare($query);
    $statement->execute();
    $title = "";
    $task = "";
    //header("Location: index.php");
 }