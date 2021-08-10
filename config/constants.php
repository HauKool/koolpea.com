<?php

    //Start session
    session_start();
    define('SITEURL', 'http://localhost/web-food/');

    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'food-oder');

    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME) or die("Connection failed: " . mysqli_connect_error());
    //$db_select = mysqli_select_db($conn, DB_NAME);

?>