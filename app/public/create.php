<?php
include 'php_db.php';
include 'headerfooter.php';

$title = '';
$task = '';
$id = 0;
$notset = '';

// When user clicks create new task, the user can fill in the form. If there is no problem with the input due to
// the first if statements it will add to database and user will be directed back to read page. 

if (isset($_POST['add'])) {
   if (empty($_POST['title'])) {
      $notset = "Title can't be blank";
   } elseif (ctype_space($_POST['title']) || ctype_space($_POST['task'])) {
      $notset = "Input can't consist of whitespace";
   } else {
      $query = "INSERT INTO list (title, task, done) VALUES (:title, :task, 0)";  
      $stmt = $db->prepare($query);
      $params = [
         'title' => $_POST['title'],
         'task' => $_POST['task'],
      ];
      $stmt->execute($params);
      header("Location: read.php");
   }
}

?>

<?= header_temp('Create') ?>
<section>
<div class="nav-welcome">
   <a class="nav" href="index.php">Home</a>
   <a class="nav" href="read.php">Back to my tasks</a>
</div>
   <h2 class="h2-form">Create new task</h2>
   <div class="form">
      <form method="post" action="create.php">
      <input type="hidden" name="id" value="<?php echo $id; ?>" ;>
      <label for="title">Title</label>
      <input id="title" type="text" name="title" value="<?php echo $task; ?>">
      <br>
      <label for="task">Task&nbsp;</label>
      <input id="task" type="text" name="task" value="<?php echo $task; ?>">
      <div class="button">
         <button type="submit" name="add" class="submitbtn">Add task</button>
      </div>
      <?php if (isset($notset)) { ?>
         <p class="error"><?php echo $notset; ?></p>
      <?php } ?>
   </form>
   </div>
   <?= footer_temp() ?>