<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>
        <?php 
        
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }

        ?>
        <?php

            if(isset($_GET['id']))
            {
                $id = $_GET['id'];

                $sql = "SELECT * FROM tbl_category WHERE ID='$id'";

                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                if($count == 1)
                {
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                }
                else
                {
                    $_SESSION['no-category'] = "<div class='error'>Category not found.!</div>";
                    header('location:'.SITEURL.'admin/mananger-category.php');
                }
            }
            else
            {
                header('location:'.SITEURL.'admin/mananger-category.php');
            }

        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-40">
                <tr>
                    <td>Tilte:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                        
                            if($current_image != "")
                            {
                                ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="80px">
                                <?php
                            }
                            else
                            {
                                echo "<div class='error'>Image not added.!</div>";
                            }
                        
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if($featured == "Yes") {echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes
                        <input <?php if($featured == "No") {echo "checked";} ?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if($active == "Yes") {echo "checked";} ?> type="radio" name="active" value="Yes"> Yes 
                        <input <?php if($active == "No") {echo "checked";} ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="submit" name="submit" value="Update" class="btn-sussces">                       
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php 

    if(isset($_POST['submit']))
    {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $current_image = $_POST['current_image'];
        $featured = $_POST['featured'];
        $active = $_POST['active'];

        if(isset($_FILES['image']['name']))
        {
            $image_name = $_FILES['image']['name'];

            if($image_name != "")
            {
                $ext = end(explode('.',$image_name));
                $image_name = "Food_Category_".rand(000,999).'.'.$ext;
                $source_path = $_FILES['image']['tmp_name'];
                $destination_path = "../images/category/".$image_name;

                //upload image
                $upload = move_uploaded_file($source_path, $destination_path);
                if($upload == FALSE)
                {
                    $_SESSION['upload'] = "<div class='error'>Failed to upload Image.!</div>";
                    header('location:'.SITEURL.'admin/mananger-category.php');
                    // stop the process
                    die();
                }
                if($current_image != "")
                {
                    $remove_path = "../images/category/".$current_image;
                    $remove = unlink($remove_path);

                    if($remove == FALSE)
                    {
                        $_SESSION['remove-image'] = "<div class='error'>Failed to remove current Image.!</div>";
                        header('location:'.SITEURL.'admin/mananger-category.php');
                        // stop the process
                        die();
                    }
                }
                
            }
            else
            {
                $image_name = $current_image;
            }
        }
        else
        {
            $image_name = $current_image;
        }

        $sql2 = "UPDATE `tbl_category` SET `title`='$title',`image_name`='$image_name',`featured`='$featured',`active`='$active' WHERE ID='$id'";

        $res2 = mysqli_query($conn, $sql2);

        if($res2 == TRUE)
        {
            $_SESSION['update-cate'] = "<div class='sussces'>Category Updated Susscesfully.!</div>";
            header('location:'.SITEURL.'admin/mananger-category.php');
        }
        else
        {
            $_SESSION['update-cate'] = "<div class='error'>Failed to Update Category.!</div>";
            header('location:'.SITEURL.'admin/update-category.php');
        }
    }


?>

<?php include('partials/footer.php'); ?>

