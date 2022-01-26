<?php
include 'php_db.php';
include 'headerfooter.php';
?>

<?= header_temp('Home') ?>
<img src="\assets\img\2022.jpg" alt="Numbers 2022 on tooth pickers" />
<h2 class="welcome">Welcome to your own to do app!</h2>
<p class="welcome-p">The purpose of this app is to create tasks for year 2022. You can add new tasks
    if you click on "Create new task", or see all your tasks if you click on "All my tasks page", there you
    can also update your tasks, mark them as done or delete them.</p>
<div class="nav-div">
    <a class="nav" href="create.php">Create new task</a>
    <a class="nav" href="read.php">All my tasks</a>
</div>
<?= footer_temp() ?>