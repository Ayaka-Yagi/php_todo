<?php

session_start();
echo "test";
if (isset($_POST['delete_id'])) {
    echo $_POST['delete_id'];
    require_once "./db_connection.php";


    $stmt = $dbh->prepare("DELETE FROM tasks WHERE id = ?");

    $stmt->execute([$_POST['delete_id']]);
}
header("Location: index.php");
