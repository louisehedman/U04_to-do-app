<?php
include('php_db.php');

$notset = '';
if (isset($_POST['add'])) {
   if (empty($_POST['title'])) {
      $notset = "Title can't be blank";
   }
   elseif (ctype_space($_POST['title']) || ctype_space($_POST['task'])){
      $notset = "Input can't consist of whitespace";
   }
    else{
      $query = <<<SQL
      INSERT INTO list (title, task, done) VALUES (:title, :task, 0);  
      SQL;   
      $statement = $db->prepare($query);
      $params = [
      'title' => $_POST['title'],
      'task' => $_POST['task'],
   ];
   $statement->execute($params);
   }
}