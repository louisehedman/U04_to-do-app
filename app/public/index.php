<?php include('php_db.php'); 

$update = false;
$title = '';
$task = '';
$id = 0;

//create

$notset = '';
if (isset($_POST['add'])) {
   if (empty($_POST['title'])) {
      $notset = "Title can't be blank";
   }
    else{
      $query = <<<SQL
      INSERT INTO list (title, task) VALUES (:title, :task);  
      SQL;   
      $statement = $db->prepare($query);
      $params = [
      'title' => $_POST['title'],
      'task' => $_POST['task']
   ];
   $statement->execute($params);
   }
}


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
   $id = $_POST['id'];
   $title = $_POST['title'];
   $task = $_POST['task'];
   $query = "UPDATE list SET title = '$title', task = '$task' WHERE id = '$id'";
   $statement = $db->prepare($query);
   $statement->execute();
   $title = "";
   $task = "";
}

if (isset($_GET['delete'])) {
   $id = $_GET['delete'];
   $query = "DELETE FROM list WHERE id = '$id'";
   $statement = $db->prepare($query);
   $statement->execute();
}
?>


<!DOCTYPE html>
<html lang="sv">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" type="text/css" href="styles.css">
   <title>U04-to-do-app</title>
</head>
<body>
   <header>
   <h1>U04 - To do app</h1>
   <img src="\assets\img\2022.jpg" />
   </header>
   <main>
   <section>
   <form method="post" action="index.php" >
      <input type="hidden" name="id" value="<?php echo $id; ?>";>
      <label>Title</label>
      <input type="text" name="title" value="<?php echo $title; ?>">
      <br>
      <label>Task</label>
      <input type="text" name="task" value="<?php echo $task; ?>">
      <div>
         <?php if ($update == true): ?>
            <button type="submit" name="update" >update</button>
         <?php else: ?>
            <button type="submit" name="add" class="submitbtn">Add task</button>
         <?php endif ?>
      </div>
   </form>

   <?php if (isset($notset)) { ?>
	<p><?php echo $notset; ?></p>
   <?php } ?>

   <?php $rows = $db->query('SELECT * FROM list'); ?>

   <table>
	<thead>
		<tr>
			<th>ID</th>
			<th>Title</th>
         <th>Task</th>
         <th>Done</th>
         <th>Update</th>
			<th>Delete</th>
		</tr>
	</thead>
   <tbody>

      <?php foreach ($rows as $row) { ?>
         <tr>
            <td> <?php echo $row['id']; ?></td>
				<td> <?php echo $row['title']; ?> </td>
            <td> <?php echo $row['task']; ?> </td>
				<td></td>
            <td> <a href="index.php?update=<?php echo $row['id']; ?>">&#9999;&#65039;</a></td>
            <td> <a href="index.php?delete=<?php echo $row['id']; ?>">&#x274C;</a></td>
			</tr>
      <?php } ?>

   </tbody>
      </section>
   </main>
   <footer>

   </footer>
</body>
</html>
