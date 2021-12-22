<?php include('php_db.php'); 

$title = "";
$task = "";
$id = 0;
$update = false;

//create

$notset = '';
if (isset($_POST['add'])) {
   if (empty($_POST['title'])) {
      $notset = "Title can't be blank";
   }
    else{
      $create = <<<SQL
      INSERT INTO list (title, task) VALUES (:title, :task);  
      SQL;   
      $statement = $db->prepare($create);
      $input = [
      'title' => $_POST['title'],
      'task' => $_POST['task']
   ];
   $statement->execute($input);
   }
}

?>

<?php
if (isset($_GET['update'])) {
   $id = $_GET['update'];
   $update = true;
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
      <input type="hidden" name="id" value="";>
      <label>Title</label>
      <input type="text" name="title" value="">
      <br>
      <label>Task</label>
      <input type="text" name="task" value="">
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
				<td> <a href="index.php?update=<?php echo $row['id']; ?>">Update</a></td>
            <td></td>
			</tr>
      <?php } ?>

   </tbody>
      </section>
   </main>
   <footer>

   </footer>
</body>
</html>
