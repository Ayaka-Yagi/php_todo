<?php

session_start();

if (isset($_POST)) {
    require_once "./db_connection.php";

    $stmt = $dbh->prepare("INSERT INTO tasks (title, detail, user_id) VALUES(?, ?, ?)");

    $stmt->execute([$_POST['title'], $_POST['detail'], $_SESSION['login_id']]);
}
header("Location: index.php");
