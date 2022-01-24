<?php
include 'php_db.php';
include 'headerfooter.php';

$update = false;

if (isset($_GET['update'])) {
   $id = $_GET['update'];

   $update = true;
   $rows = $db->query("SELECT * FROM list WHERE id = '$id'");

   foreach ($rows as $row) {
      $id = $row['id'];
      $title = $row['title'];
      $task = $row['task'];
   }
}

if (isset($_POST['update'])) {
   $id = $_POST['id'];
   $title = $_POST['title'];
   $task = $_POST['task'];
   if (empty($_POST['title'])) {
      $notset = "Title can't be blank";
   } elseif (ctype_space($_POST['title']) || ctype_space($_POST['task'])) {
      $notset = "Input can't consist of whitespace";
   } else {
   $query = "UPDATE list SET title = '$title', task = '$task' WHERE id = '$id'";
   $stmt = $db->prepare($query);
   $stmt->execute();
   header("Location: read.php"); 
}   
}
?>

<?= header_temp('Update') ?>
<section>
   <div class="nav-welcome">
      <a class="nav" href="index.php">Home</a>
      <a class="nav" href="read.php">Back to my tasks</a>
   </div>
   <h2 class="h2-form">Update task nr <?php echo $id; ?></h2>
   <div class="form">
      <form method="post" action="update.php">
         <input type="hidden" name="id" value="<?php echo $id; ?>" ;>
         <label for="title">Title</label>
         <input id="title" type="text" name="title" value="<?php echo $title; ?>">
         <br>
         <label for="task">Task&nbsp;</label>
         <input id="task" type="text" name="task" value="<?php echo $task; ?>">
         <div>
               <button type="submit" name="update" class="submitbtn">Update</button>
         </div>
         <?php if (isset($notset)) { ?>
            <p class="error"><?php echo $notset; ?></p>
         <?php } ?>
      </form>
   </div>
</section>
<?= footer_temp() ?>