<?php 
    include_once('connection.php');
    $con = connection();

    if (isset($_POST['submit'])) {
        $username  = $_POST['username'];
        $firstname  = $_POST['firstname'];
        $lastname  = $_POST['lastname'];
        $contactnumber  = $_POST['contactnumber'];
        $password  = $_POST['password'];

        $sql = "INSERT INTO `users`(`UserName`, `FirstName`, `LastName`, `Password`) VALUES ('$username', '$firstname', '$lastname', '$password')";

        $con->query($sql) or die ($con->error);
        echo header("Location: login.php");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/register.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1 class="bg-dark text-white">Simple Inventory Management System</h1>
    </header>
    <div class="container">
        <main>
            <form class="card" method="post">
                <h2 class="card-title text-center">Register</h2>
                <label class="form-label" for="username">Username:</label>
                <input class="form-control" type="text" name="username" required>
    
                <label class="form-label" for="firstname">First Name:</label>
                <input class="form-control" type="text" name="firstname" required>
    
                <label class="form-label" for="lastname">Last Name:</label>
                <input class="form-control" type="text" name="lastname" required>
    
                <label class="form-label" for="password">Password:</label>
                <input class="form-control" type="password" name="password" required>
    
                <div class="btns">
                    <a id="back" class="btn btn-outline-dark" href="login.php">Back</a>
                    <input id="save" class="btn btn-dark" type="submit" name="submit" value="Save">
                </div>
            </form>
        </main>
    </div>
</body>
</html>