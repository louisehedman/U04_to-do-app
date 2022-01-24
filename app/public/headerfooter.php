<?php

// These functions will be included on every page to create header and footer. 
//With EOT you don't have to worry about quotes

function header_temp($title)
{
    echo <<<EOT
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="description" content="An app to create a to do list for year 2022">
            <link rel="stylesheet" type="text/css" href="styles.css">
            <title>$title</title>
        </head>
        <body>
      <div id="page-container">
      <header>
         <h1>U04 - To do app</h1>
      </header>
      <div id="content-wrap">
      <main>
    EOT;
}

function footer_temp()
{
    echo <<<EOT
    </main>
         </div>
    <div>
    <footer>
            <p>Louise Hedman *** To Do App *** Chas Academy</p>
         </footer>
      </div>
      </div>
   </body>
</html>
EOT;
}
