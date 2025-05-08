<?php
    session_start();
    
    include_once('connection.php');
    $con = connection();


    if (isset($_POST['login'])){
        $username  = $_POST['username'];
        $password  = $_POST['password'];

        $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $users = $con->query($sql) or die ($con->error);
        $row = $users->fetch_assoc();
        $total = $users->num_rows;

        if ($total > 0){
            $_SESSION['userID'] = $row['UserID'];
            $_SESSION['username'] = $row['Username'];
            $_SESSION['usertype'] = $row['UserType'];
            echo header ("Location: read.php");
        } else {
            echo '<script type="text/javascript">alert("No user found!");</script>';

        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="bg-dark container-auto">
        <h1 class="text-center text-white">Simple Inventory Management System</h1>
    </header>
    <div class="container">
        <div class="row">
            <main class="container">
                <form class="card" method="post">
                    <h2 class="text-center card-title">Login</h2>
        
                    <label for="username" class="form-label">Username:</label>
                    <input class="form-control" type="text" name="username">
        
                    <label for="password" class="form-label">Password:</label>
                    <input class="form-control" type="password" name="password">
        
                    <div id="btn-container" class="d-grid gap-2 col-4 mx-auto">
                        <button type="submit" name="login" class="btn btn-dark ">Login</button>
                        <a href="register.php" class="btn btn-outline-dark ">Register</a>
                    </div>
                </form>
            </main>
        </div>
    </div>
</body>
</html>