<?php

$servername = "mysql";
$username =  "admin";
$password = "secret";
$dbname = "todoapp";

// This makes the connection to the database

$db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
