<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "musicdb";

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    mysqli_set_charset($conn,"UTF8");
?>