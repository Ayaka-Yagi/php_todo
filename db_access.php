<?php

function get_todo_list($user_id)
{

    require_once "db_connection.php";

    //prepareメソッド: ?のとこを変数にして複数回実行される文の中を変えられる
    //さらに、エスケープ処理をしてくれるのでSQLインジェクション対策ができる
    $stmt = $dbh->prepare("SELECT * FROM tasks WHERE user_id = ? AND done = 0 ORDER BY id DESC");

    try {
        $ret = $stmt->execute([$user_id]);
        if ($ret === true) {
            return (["result" => true, "stmt" => $stmt]);
        } else {
            return (["result" => false, "stmt" => $stmt]);
        }
    } catch (PDOException $e) {
        return (["result" => false, "exception" => $e]);
    }
}


function generate_todo_table($stmt)
{
    if ($stmt->rowCount() === 0) {
        return ("<tr><td colspan='3'>データがありません</td></tr>");
    }
    $elms = "";
    while ($item = $stmt->fetch()) {
        $tr = "<tr>
        <td>{$item['title']}</td>
        <td>{$item['detail']}</td>
        <div>
        <td>
        
        <button type='submit' name='done_id' value='{$item['id']}'>完了</button>
        
        <form action='./delete_task.php' method='POST'>
        <button type='submit' name='delete_id' value='{$item['id']}'>削除</button>
        </form>
        </td>

        </div>
        </tr>";

        $elms .= $tr;
    }
    return ($elms);
}
