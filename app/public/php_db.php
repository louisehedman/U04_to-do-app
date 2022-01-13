<?php

$db = new PDO('mysql:host=mysql;dbname=todoapp', 'admin', 'secret');

$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

