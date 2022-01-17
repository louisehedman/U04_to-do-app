<?php
include 'php_db.php';
include 'headerfooter.php';

?>

<?= header_temp('Read') ?>
<a href="index.php">Home</a>
<a href="create.php">Create new task</a>
<?php $rows = $db->query('SELECT * FROM list'); ?>
<table>
   <thead>
      <tr>
         <th width="7%">ID</th>
         <th>Title</th>
         <th>Task</th>
         <th width="10%">Done</th>
         <th width="10%">Update</th>
         <th width="10%">Delete</th>
      </tr>
   </thead>
   <tbody>

      <?php foreach ($rows as $row) { ?>
         <tr>
            <td> <?php echo $row['id']; ?> </td>
            <td class="row<?php echo $row['done'] ? ' done' : '' ?>"> <?php echo $row['title']; ?> </td>
            <td class="row<?php echo $row['done'] ? ' done' : '' ?>"> <?php echo $row['task']; ?> </td>
            <td>
               <?php if (!$row['done']) { ?>
                  <a class="link" href="done.php?as=done&row=<?php echo $row['id']; ?>">&#9989;</a>
               <?php } ?>
            </td>
            <td>
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