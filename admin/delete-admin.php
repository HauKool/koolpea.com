<?php

    include('../config/constants.php');

    $id = $_GET['id'];

    $sql = "DELETE FROM `tbl_admin` WHERE ID = $id";

    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    if($res == TRUE)
    {
        $_SESSION['delete'] = "<div class='sussces'>Admin Delete Susscesfully.!</div>";
        header('location:'.SITEURL.'admin/mananger-admin.php');
    }
    else
    {
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Admin.!</div>";
        header('location:'.SITEURL.'admin/delete-admin.php');
    }

?>