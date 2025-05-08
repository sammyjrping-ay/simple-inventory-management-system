<?php
    session_start();
    unset($_SESSION['username']);
    unset($_SESSION['usertype']);
    echo header("Location: login.php");
?>