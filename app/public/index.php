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
   else if (ctype_space($_POST['title']) || ctype_space($_POST['task'])){
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

// update 
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
   else if (ctype_space($_POST['title']) || ctype_space($_POST['task'])){
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
}

// delete

if (isset($_GET['delete'])) {
   $id = $_GET['delete'];
   $query = "DELETE FROM list WHERE id = '$id'";
   $statement = $db->prepare($query);
   $statement->execute();
}

// mark as done

if (isset($_GET['as'], $_GET['row'])) {
   $as = $_GET['as'];
   $row = $_GET['row'];
   
   $query = $db->prepare("UPDATE list SET done = 1 WHERE id = :row");
   $query->execute(['row' => $row]);
}
?>


<!DOCTYPE html>
<html lang="sv">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" type="text/css" href="style.css">
      <title>U04-to-do-app</title>
   </head>
   <body>
      <div id="wrapper">
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
                  <label>Task&nbsp;</label>
                  <input type="text" name="task" value="<?php echo $task; ?>">
                  <div>
                     <?php if ($update == true): ?>
                        <button type="submit" name="update" class="submitbtn">update</button>
                     <?php else: ?>
                        <button type="submit" name="add" class="submitbtn">Add task</button>
                     <?php endif ?>
                  </div>
                     <?php if (isset($notset)) { ?>
                     <p class="error"><?php echo $notset; ?></p>
                     <?php } ?>
               </form>
               
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
                     <td> <?php echo $row['id']; ?> </td>
                     <td class="row<?php echo $row['done'] ? ' done' : '' ?>"> <?php echo $row['title']; ?> </td>
                     <td class="row<?php echo $row['done'] ? ' done' : '' ?>" > <?php echo $row['task']; ?> </td>
                     <td>
                        <?php if (!$row['done']) { ?>
                           <a class="link" href="index.php?as=done&row=<?php echo $row['id']; ?>">&#9989;</a> 
                        <?php } ?>
                     </td>
                     <td> 
                        <?php if (!$row['done']) { ?>
                           <a href="index.php?update=<?php echo $row['id']; ?>">&#9999;&#65039;</a> 
                        <?php } ?> 
                     </td>
                     <td>
                        <a class="link" href="index.php?delete=<?php echo $row['id']; ?>">&#x274C;</a> 
                     </td>
                  </tr>
                  <?php } ?>
               </tbody>
            </section>
         </main>
         <footer>

         </footer>
      </div>
   </body>
</html>
