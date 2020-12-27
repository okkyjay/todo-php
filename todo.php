<?php
include "function.php";
if (!isset($_SESSION['user'])){
    header('location:index.php');
}
$error = "";
if (isset($_POST['submit'])){
     $todo = $_POST['todo'];
     $date = $_POST['date'];
     $id = $_POST['id']??'';
     if (empty($todo)){
         $error = "Todo input cannot be empty";
     }else{
         $conn = connectDB();
         if ($conn){
             $sqlStatement = "";
             if (!$id){
                 $sqlStatement = "INSERT INTO todo_list (todo, todo_date) VALUES ('".$todo."', '".$date."')";
             }else{
                 $sqlStatement = "UPDATE todo_list SET todo ='".$todo."', todo_date = '".$date."' WHERE id='".$id."'";
             }
             $query = $conn->query($sqlStatement);
         }else{
             echo "Oops!!! something went wrong";
         }
     }
 }
if (isset($_REQUEST['type']) && $_REQUEST['type'] == 'delete'){
    $conn = connectDB();
    $id = $_REQUEST['id'];
    $sqlStatement = "DELETE from todo_list WHERE id='".$id."'";
    $conn->query($sqlStatement);

}
include "header.php";
?>
<div class="container">
    <div class="row">
        <div style="margin-top:10px " class="col-md-12">
            <form class="todo-form" method="post" action="index.php">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <div class="form-group">
                            <input id="todo-input" required type="text" name="todo" placeholder="Enter Todo" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="form-group">
                            <input id="todo-date" value="" required type="date" name="date" placeholder="Enter Todo" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <button name="submit" class="btn btn-primary submit"> Create</button>
                    </div>
                </div>
                <?php if ($error): ?>
                    <div class="alert alert-danger">
                        <?php echo $error ?>
                    </div>
                <?php endif; ?>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Todo List
                </div>
                <?php
                    $conn = connectDB();
                    $sqlStatement = "SELECT * FROM todo_list";
                    $query = $conn->query($sqlStatement);
                    $todos = $query->fetch_all(MYSQLI_ASSOC);
                ?>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <th>S/N</th>
                                <th>Todo</th>
                                <th>Date</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                            <?php foreach ($todos as $key => $todo): ?>
                                <tr>
                                    <td> <?php echo ($key + 1)?> </td>
                                    <td> <?php echo $todo['todo'] ?> </td>
                                    <td> <?php echo date('d M Y', strtotime($todo['todo_date'])) ?> </td>
                                    <td>
                                        <a class="todo-update" data-todo="<?php echo $todo['todo']?>" data-date="<?php echo $todo['todo_date']?>" data-id="<?php echo $todo['id']?>" href="">Edit</a> |
                                        <a href="index.php?type=delete&id=<?php echo $todo['id']?>">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(document).on('click', '.todo-update', function (){
        let obj = $(this)
        let form = $('.todo-form')
        let hiddenInput = form.find('#update-id')
        if (hiddenInput.length > 0){
            hiddenInput.remove()
        }
        let todo = obj.data('todo')
        let todoDate = obj.data('date')
        let todoID = obj.data('id')
        let input = "<input id='update-id' type='hidden' name='id' value="+ todoID+">"
        $('.submit').html('Update')
        $('#todo-input').val(todo)
        $('#todo-date').val(todoDate)
        form.append(input)
        return false;
    })
</script>
</html>

