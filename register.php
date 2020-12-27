<?php
include "function.php";
$error = "";
if (isset($_POST['submit'])){
     $email = $_POST['email'];
     $password = $_POST['password'];
     if (empty($email) || empty($password)){
         $error = "Required field input cannot be empty";
     }else{
         $conn = connectDB();
         if ($conn){
             $password = md5($password);
                 $sqlStatement = "INSERT INTO todo_users (email, password) VALUES ('".$email."', '".$password."')";
                 $query = $conn->query($sqlStatement);
                 if ($query){
                     header("location:index.php");
                 }else{
                     $error = "Something went wrong";
                 }
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
    <h4>Registration</h4>
    <div class="row">
        <div style="margin-top:10px " class="col-md-12">
            <?php if ($error): ?>
                <div class="alert alert-danger">
                    <?php echo $error ?>
                </div>
            <?php endif; ?>
            <form action="register.php" method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                <button name="submit" type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</html>
