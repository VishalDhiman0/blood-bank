<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $dbname = "blood_bank";

    $sql = "CREATE DATABASE IF NOT EXISTS {$dbname}";
    $connection = mysqli_connect($server, $username, $password);
    if(!$connection){
        die("Unable to connect");
    }
    
    mysqli_query($connection, $sql);
    mysqli_select_db($connection, $dbname);

    
?>