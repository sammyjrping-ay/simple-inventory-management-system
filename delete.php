<?php
    if (!isset($_SESSION)){
        session_start();
    }

    include_once('connection.php');
    $con = connection();

    $itemID = $_GET['id'];

    $sql = "DELETE FROM items WHERE id = $itemID";
    $con->query($sql) or die($con->error);

    header("Location: read.php");
?>