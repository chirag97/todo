<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://bootswatch.com/4/sketchy/bootstrap.min.css">
    <title>Todo Page</title>
</head>

<body>

<?php
$obj = new Connection();
$obj->db_connect();
$conn = $obj->conn;

$query = "SELECT * FROM  todos";

$data = mysqli_query($conn, $query);

if (!$data) {
    die('Could not print data: ' . mysqli_error($conn));
}

?>
    <div class="container">
        <div class="col-lg-10 col-lg-offset-2">
            <h1 class="text-center">The TODO Site</h1>

            <button class="btn btn-primary float-right" style="color:#fff;" data-target="#taskModal" data-toggle="modal">Add Task</button>
            <br>
            <br>

            <table class="table text-center">
                <thead>
                    <tr>
                        <th>Task Title</th>
                        <th>Task Content</th>
                        <th>Task Action</th>
                    </tr>
                </thead>
                <tbody>
<?php
if ($data->num_rows > 0) {
    while ($row = $data->fetch_assoc()) {

        ?>

                    <tr>
                        <td><?php echo $row['title']?></td>
                        <td><?php echo $row['content']?></td>
                        <td>
                        <button onclick="deleteTask(<?php echo $row['id'] ?>)" class="btn btn-sm btn-danger">
                            delete                            
                        </button>


                    </tr>
<?php
}
}
?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="taskModal" tabindex="-1" role="dialog" aria-labelledby="taskModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="taskModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/TodoHome.php">
                        <div class="form-group">
                            <label for="title">Task Title</label>
                            <input type="text" class="form-control" id="title" name="title"  placeholder="Enter Task Title">
                        </div>
                        <div class="form-group">
                            <label for="title">Task Content</label>
                            <textarea  class="form-control" id="content" name="content"  placeholder="Enter Task Content"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>


<script>
var headers = {
            'Content-Type': 'application/json'
        }
    function deleteTask(id)
    {
        axios.post('/TodoHome.php',{
            'id' : id,
            'delete' : '1'
        },headers)
        .then( response => {
            console.log(response)
        })
        .catch(error => {
            console.log(error)
        });
    }
</script>
</body>

</html>