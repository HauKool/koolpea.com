<?php 

    if(!isset($_SESSION['user']))
    {
        $_SESSION['no-login'] = "<div class = 'error text-center'> Please Login to acces Admin Panel.!</div>";
        header('location:'.SITEURL.'admin/login.php');
    }

?>