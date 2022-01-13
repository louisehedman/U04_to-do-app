<?php
include('php_db.php');
include 'headerfooter.php';

$title = '';
$task = '';
$id = 0;

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
   header("Location: index.php");
}

?>
<?=header_temp('Create')?>
<section>
            <form method="post" action="create.php" >
               <input type="hidden" name="id" value="<?php echo $id; ?>";>
               <label for="title">Title</label>
               <input id="title" type="text" name="title" value="<?php echo $task; ?>">
               <br>
               <label for="task">Task&nbsp;</label>
               <input id="task" type="text" name="task" value="<?php echo $task; ?>">
               <div>
                  <? //php if ($update == true): ?>
                     <button type="submit" name="add" class="submitbtn">Add task</button>
                  <? //php endif ?>
               </div>
                  <?php if (isset($notset)) { ?>
                  <p class="error"><?php echo $notset; ?></p>
                  <?php } ?>
            </form>

<?=footer_temp()?>