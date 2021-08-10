<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Add Food</h1>
            <br><br>
            
            <?php

                if(isset($_SESSION['upload']))
                {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }

            ?>

            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-40">
                    <tr>
                        <td>Title:</td>
                        <td>
                            <input type="text" name="title" placeholder="Title of the Food">
                        </td>
                    </tr>
                    <tr>
                        <td>Description:</td>
                        <td>
                            <textarea name="description" cols="30" rows="5" placeholder="Description of the Food"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Price:</td>
                        <td>
                            <input type="number" name="price">
                        </td>
                    </tr>
                    <tr>
                        <td>Select Image:</td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>
                    <tr>
                        <td>Category:</td>
                        <td>
                            <select name="category">
                                <?php 
                                
                                    $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                                    $res = mysqli_query($conn, $sql);

                                    $count = mysqli_num_rows($res);
                                    if($count > 0)
                                    {
                                        while($row = mysqli_fetch_assoc($res))
                                        {
                                            $id = $row['ID'];
                                            $title = $row['title'];
                                            ?>
                                            <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        ?>
                                        <option value="0">No Category Found</option>
                                        <?php
                                    }
                                
                                ?>
                                
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Featured:</td>
                        <td>
                            <input type="radio" name="featured" value="Yes">Yes
                            <input type="radio" name="featured" value="No">No
                        </td>
                    </tr>
                    <tr>
                        <td>Active:</td>
                        <td>
                            <input type="radio" name="active" value="Yes">Yes
                            <input type="radio" name="active" value="No">No
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Food" class="btn-sussces">
                        </td>
                    </tr>
                </table>
            </form>
            
        </div>
    </div>
<?php 

    if(isset($_POST['submit']))
    {
        $title= $_POST['title'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $category = $_POST['category'];
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
                $image_name ="Food-Name-".rand(0000,9999).'.'.$ext;
                $source_path = $_FILES['image']['tmp_name'];
                $destination_path = "../images/food/".$image_name;

                $upload = move_uploaded_file($source_path,$destination_path);
                if($upload == FALSE)
                {
                    $_SESSION['upload'] = "<div class='error'>Failed to upload Image.!</div>";
                    header('location:'.SITEURL.'admin/add-food.php');
                    die();
                }
            }
            
        }
        else
        {
            $image_name != "";
        }

        $sql2 = "INSERT INTO `tbl_food`(`title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES ('$title','$description','$price','$image_name','$category','$featured','$active')";

        $res2 = mysqli_query($conn, $sql2);

        if($res2 == TRUE)
        {
            $_SESSION['add'] = "<div class='sussces'>Food Added Susscesfully.!</div>";
            header('location:'.SITEURL.'admin/mananger-food.php');
        }
        else
        {
            $_SESSION['add'] = "<div class='error'>Failed To Add Food.!</div>";
            header('location:'.SITEURL.'admin/mananger-food.php');
        }
    }

?>

<?php include('partials/footer.php'); ?>