<?php include('php_db.php'); ?>
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
   <h1>U04 - To do app</h1>
   <form method="post" action="index.php" >
   <div>
      <button name="add" type="submit" value="add_task">Add task</button>
</div>
      <label>title</label>
      <input type="text" name="title" value="">
      <label>task</label>
      <input type="text" name="task" value="">

   </form>
</body>
</html>



