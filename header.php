<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<!-- As a link -->
<nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">Todo</a>
    <?php if (isset($_SESSION['user'])): ?>
        <a class="text-white" href="todo.php">Dashboard</a>
        <a class="text-white" href="logout.php">Logout</a>
    <?php else: ?>
        <a class="text-white" href="register.php">Register</a>
    <?php endif; ?>
</nav>
