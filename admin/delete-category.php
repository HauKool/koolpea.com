<?php

    include('../config/constants.php');

    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        if($image_name != "")
        {
            $path = "../images/category/".$image_name;

            $remove = unlink($path);
            if($remove == FALSE)
            {
                $_SESSION['remove'] ="<div class='error'>Failed to Delete Category Image.!</div>";
                header('location:'.SITEURL.'admin/mananger-category.php');                
                die();
            }
        }

        $sql = "DELETE FROM `tbl_category` WHERE ID='$id'";

        $res = mysqli_query($conn, $sql);

        if($res == TRUE)
        {
            $_SESSION['delete'] ="<div class='sussces'>Category Deleted Susscesfully.!</div>";
            header('location:'.SITEURL.'admin/mananger-category.php');    
        }
        else
        {
            $_SESSION['delete'] ="<div class='error'>Failed to Delete Category.!</div>";
            header('location:'.SITEURL.'admin/mananger-category.php');   
        }
    }
    else
    {
        header('location:'.SITEURL.'admin/mananger-category.php');

    }

?>