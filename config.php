<?php
    /*
    Imported using require into most other php files. Concisely establishes a
    connection to localhost phpMyAdmin for sql queries
    */
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "music_db";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }
?>