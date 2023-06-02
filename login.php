<?php

session_start();

$err_msg = "";
if (isset($_POST['login'])) {

    $name = htmlentities($_POST["name"], ENT_QUOTES, "utf-8");
    $password = htmlentities($_POST["password"], ENT_QUOTES, "utf-8");

    $password = md5($password);

    $_SESSION["name"] = $name;
    $_SESSION["password"] = $password;

    $dsn = 'mysql:dbname=php_todoapp;host=localhost';
    $user = 'localhost';
    $password = "testpass";

    try {
        $db = new PDO($dsn, $user, $password);
        //print("接続");
        $sql = 'SELECT * FROM users WHERE name=? AND password=?';
        $stmt = $db->prepare($sql);
        //print $_SESSION["password"];
        $stmt->execute([$_SESSION["name"], $_SESSION["password"]]);
        $result = $stmt->fetch();
        $stmt = null;
        $db = null;

        if ($result[0] != 0) {
            header('Location: index.php');
            $_SESSION["login_id"] = $result["id"];
            exit;
        } else {
            $err_msg = "アカウント情報が間違っています";
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }
}





?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">

    <title>ログイン</title>
</head>

<body>
    <form action="login.php" method="post">
        <table border=1>
            <tr>
                <td>ユーザーID</td>
                <td><input name="name" type="text"></td>
            </tr>
            <tr>
                <td>パスワード</td>
                <td><input name="password" type="password"></td>
            </tr>
        </table>
        <input name="login" type="submit" value="認証">
    </form>
</body>

</html>