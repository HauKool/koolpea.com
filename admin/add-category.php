<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>

        <?php 
        
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-40">
                <tr>
                    <td>Tilte:</td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>
                <tr>
                    <td>Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes 
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes 
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-sussces">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php 

    if(isset($_POST['submit']))
    {
        $title = $_POST['title'];

        if(isset($_POST['featured']))
        {
            $featured = $_POST['featured'];
        }
        else
        {
            $featured = "No";
        }
        if(isset($_POST['active']))
        {
            $active = $_POST['active'];
        }
        else
        {
            $active = "No";
        }
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
                    header('location:'.SITEURL.'admin/add-category.php');
                    // stop the process
                    die();
                }
            }            
        }
        else
        {
            $image_name ="";
            echo "failed";
        }
        
        $sql = "INSERT INTO `tbl_category`(`title`, `image_name`,`featured`, `active`) VALUES ('$title','$image_name','$featured','$active')";

        $res = mysqli_query($conn,$sql);

        if($res == TRUE)
        {
            $_SESSION['add'] = "<div class='sussces'>Add Category Susscesfully.!</div>";
            header('location:'.SITEURL.'admin/mananger-category.php');
        }
        else
        {
            $_SESSION['add'] = "<div class='error'>Failed to Add Category.!</div>";
            header('location:'.SITEURL.'admin/add-category.php');
        }
        
    }

?>

<?php include('partials/footer.php'); ?>