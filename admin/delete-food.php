<?php 

    include('../config/constants.php');

    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        if($image_name != "")
        {
            $path = "../images/food/".$image_name;

            $remove = unlink($path);
            if($remove == FALSE)
            {
                $_SESSION['remove'] ="<div class='error'>Failed to Delete Food Image.!</div>";
                header('location:'.SITEURL.'admin/delete-food.php');                
                die();
            }
        }

        $sql = "DELETE FROM `tbl_food` WHERE ID='$id'";

        $res = mysqli_query($conn, $sql);

        if($res == TRUE)
        {
            $_SESSION['delete'] ="<div class='sussces'>Food Deleted Susscesfully.!</div>";
            header('location:'.SITEURL.'admin/mananger-food.php');    
        }
        else
        {
            $_SESSION['delete'] ="<div class='error'>Failed to Delete Food.!</div>";
            header('location:'.SITEURL.'admin/mananger-food.php');   
        }
    }
    else
    {
        header('location:'.SITEURL.'admin/mananger-food.php');
    }

?>