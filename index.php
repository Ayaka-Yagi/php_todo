<?php

session_start();


include_once "./db_access.php";


$res = get_todo_list($_SESSION['login_id']);
if ($res['result'] === true) {
    $todo_items = generate_todo_table($res['stmt']);
} else {
    $todo_items = "<tr><td>データの取得に失敗しました</td></tr>";
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>My Todo List</title>
</head>

<body>
    <h1>My Todo List</h1>
    <div class="my_account">
        <?php echo $_SESSION["name"] ?>
        <a href="./logout.php"><button class="my-acc-btn">ログアウト</button></a>
    </div>
    <br>

    <div>
        <button class="button" data-toggl="collapse" aria-expanded="false" data-target="#form_add">
            ✚新しいTodoを追加
        </button>
        <div>
            <div id="form_add">
                <form action="./add_task.php" method="POST">
                    <div>
                        <label for="task_name">件名</label>
                        <input type="text" name="title">
                    </div>
                    <div>
                        <label for="detail">詳細</label>
                        <textarea name="detail" rows="4"></textarea>
                    </div>
                    <button type="submit">追加する</button>
                </form>
            </div>
        </div>
    </div>
    <br>
</body>

<body>
    <br>
    <div>
        <table border=1>
            <thead>
                <tr>
                    <th>件名</th>
                    <th>詳細</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                print($todo_items);
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>