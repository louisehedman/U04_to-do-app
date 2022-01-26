<?php
include 'php_db.php';
include 'headerfooter.php';
?>

<?php /*Read all the rows in database*/ $rows = $db->query('SELECT * FROM list'); ?>

<?= header_temp('All my tasks') ?>
<div class="nav-div">
   <a class="nav" href="index.php">Home</a>
   <a class="nav" href="create.php">Create new task</a>
</div>
<table class="table">
   <thead>
      <tr>
         <th width="7%">Nr</th>
         <th>Title</th>
         <th>Task</th>
         <th width="10%">Done</th>
         <th width="10%">Update</th>
         <th width="10%">Delete</th>
      </tr>
   </thead>
   <tbody>
      <?php /* output the data from every row */ foreach ($rows as $row) { ?>
         <tr>
            <td> <?php echo $row['id']; ?> </td>
            <!-- If done is clicked the class done will be activated, otherwise not -->
            <td class="<?php echo $row['done'] ? 'done' : '' ?>"> <?php echo $row['title']; ?> </td>
            <td class="<?php echo $row['done'] ? 'done' : '' ?>"> <?php echo $row['task']; ?> </td>
            <td>
               <?php if (!$row['done']) { ?>
                  <a class="link" href="done.php?as=done&row=<?php echo $row['id']; ?>">&#9989;</a>
               <?php } ?>
            </td>
            <td>
               <!-- if done is not clicked it is able to update the task, otherwise the link will disappear -->
               <?php if (!$row['done']) { ?>
                  <a href="update.php?update=<?php echo $row['id']; ?>">&#9999;&#65039;</a>
               <?php } ?>
            </td>
            <td>
               <a class="link" href="delete.php?delete=<?php echo $row['id']; ?>">&#x274C;</a>
            </td>
         </tr>
      <?php } ?>
   </tbody>
</table>

<?= footer_temp() ?>