<?php

$mysql_host = "localhost";
$mysql_database = "ads_project";
$mysql_user = "root";
$mysql_password = "";
# MySQL with PDO_MYSQL
$db = new PDO("mysql:host=$mysql_host;dbname=$mysql_database", $mysql_user, $mysql_password);
$query = file_get_contents("/app/app/install/ads_project.sql");
$stmt = $db->exec($query);