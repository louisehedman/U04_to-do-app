<?php
include 'php_db.php';
include 'headerfooter.php';

$update = false;
//$title = '';
//$task = '';
//$id = 0;

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
    header("Location: read.php");
 }
 ?>

 <?=header_temp('Update')?>
 <section>
            <form method="post" action="update.php" >
               <input type="hidden" name="id" value="<?php echo $id; ?>";>
               <label for="title">Title</label>
               <input id="title" type="text" name="title" value="<?php echo $title; ?>">
               <br>
               <label for="task">Task&nbsp;</label>
               <input id="task" type="text" name="task" value="<?php echo $task; ?>">
               <div>
                  <?php if ($update == true): ?>
                     <button type="submit" name="update" class="submitbtn">Update</button>
                  <?php endif ?>
               </div>
                  <?php if (isset($notset)) { ?>
                  <p class="error"><?php echo $notset; ?></p>
                  <?php } ?>
            </form>
 </section>
 <?=footer_temp()?>