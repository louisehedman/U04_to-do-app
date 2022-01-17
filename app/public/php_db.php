<?php

$servername = "mysql";
$username =  "admin";
$password = "secret";
$dbname = "todoapp";

$db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
