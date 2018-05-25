<?php
namespace root;

require 'connection.php';

class TodoHome
{

    public function __construct()
    {

    }

    public function showTodoPage()
    {
        echo 'hello';
    }

    public function addTodo()
    {
        if (!empty($_POST['title']) && !empty($_POST['content'])) {

            $ob = new \Connection();
            $ob->db_connect();
            $conn = $ob->conn;

            $title = mysqli_real_escape_string($conn, $_POST['title']);
            $content = mysqli_real_escape_string($conn, $_POST['content']);
            $query = "INSERT INTO  todos (title,content) VALUES ('{$title}','{$content}')";

            $data = mysqli_query($conn, $query);
            var_dump($data);

            if (!$data) {
                die('Could not enter data: ' . mysqli_error($conn));
            }

            header('Location: index.php');

        }

    }

    public function deleteTodo($id)
    {

        $ob = new \Connection();
        $ob->db_connect();
        $conn = $ob->conn;

        $id = mysqli_real_escape_string($conn, $id);

        $query = "DELETE FROM `todos` WHERE `id` = {$id}";

        $data = mysqli_query($conn, $query);
        if ($data == false) {
            return json_encode(mysqli_error());
        } else {
            return 'deleted successfully';
        }

    }

}

$obj = new TodoHome();
$obj->addTodo();

header('Content-type: application/json');
if (!empty($_POST['delete'])) {
    $an['message'] = $obj->deleteTodo($_POST['id']);
    echo json_encode($an);
}
