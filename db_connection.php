<?php


$dsn = 'mysql:dbname=php_todoapp;host=localhost';
$user = 'localhost';
$password = "testpass";

try {
    $dbh = new PDO($dsn, $user, $password);
    //print("接続");
} catch (PDOException $e) {
    die('Error: ' . $e->getMessage());
}
