<?php
    $servername = "localhost"; 
    $username = "root";           // change
    $password = "";               // change
    $database = "daily_expenses"; // change
    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    // echo "Connected successfully";
?>