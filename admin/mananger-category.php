<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Manange Category</h1>
            <br><br>    
            <a href="add-category.php" class="btn-add">Add Category</a>
            <br><br><br>
            <?php 
        
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
                if(isset($_SESSION['remove']))
                {
                    echo $_SESSION['remove'];
                    unset($_SESSION['remove']);
                }
                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
                if(isset($_SESSION['no-category']))
                {
                    echo $_SESSION['no-category'];
                    unset($_SESSION['no-category']);
                }
                if(isset($_SESSION['upload']))
                {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
                if(isset($_SESSION['remove-image']))
                {
                    echo $_SESSION['remove-image'];
                    unset($_SESSION['remove-image']);
                }
                if(isset($_SESSION['update-cate']))
                {
                    echo $_SESSION['update-cate'];
                    unset($_SESSION['update-cate']);
                }
            
            ?>

            <table class="tbl-full">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>

                <?php 
                
                    $sql = "SELECT * FROM tbl_category";
                    $res = mysqli_query($conn, $sql);
                    if($res == TRUE)
                    {
                        $count = mysqli_num_rows($res);
                        $temp=1;
                        if($count>0)
                        {
                            while($rows = mysqli_fetch_assoc($res))
                            {
                                $id = $rows['ID'];
                                $title = $rows['title'];
                                $image_name = $rows['image_name'];
                                $featured = $rows['featured'];
                                $active = $rows['active'];

                                ?>
                                    <tr>
                                        <td><?php echo $temp++;?></td>
                                        <td><?php echo $title;?></td>
                                        <td>
                                            <?php 
                                                if($image_name != "")
                                                {
                                                    ?>
                                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="80px">
                                                    <?php
                                                }
                                                else
                                                {
                                                    echo "<div class='error'>Image not Added.!</div>";
                                                }
                                            ?>
                                        </td>
                                        <td><?php echo $featured;?></td>
                                        <td><?php echo $active;?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id?>" class="btn-sussces">Update</a> 
                                            <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete</a> 
                                        </td>
                                    </tr>

                                <?php
                            }
                        }
                    }                
                ?>
            </table>
        </div>
    </div>

<?php include('partials/footer.php'); ?>