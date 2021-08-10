<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1 class="text-center">Add Admin</h1>
            <?php 
               
               if(isset($_SESSION['add']))
               {
                   echo $_SESSION['add'];
                   unset($_SESSION['add']);
               }
          
            ?> 
            <br></br> <br></br>

            <form action="" method="POST">
                <table class="tbl-40">
                    <tr>
                        <td>Full Name: </td>
                        <td><input type="text" name="full_name" placeholder="Enter your name"></td>
                    </tr>
                    <tr>
                        <td>Username: </td>
                        <td><input type="text" name="username" placeholder="Enter your username"></td>
                    </tr>
                    <tr>
                        <td>Password: </td>
                        <td><input type="password" name="password" placeholder="Enter your password"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Admin" class="btn-sussces" >
                        </td>
                    </tr>
                    
                </table>
            </form>

        </div>
    </div>
    Ư
<?php include('partials/footer.php'); ?>

<?php 
    
    if(isset($_POST['submit']))
    {
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $sql = "INSERT INTO `tbl_admin`(`full_name`, `username`, `password`) 
        VALUES ('$full_name','$username','$password')
        ";

        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        if($res)
        {
            $_SESSION['add'] = "<div class ='sussces'>Add Admin Sussecflly.!</div>";
            header('location:'. SITEURL . 'admin/mananger-admin.php' );
        }
        else
        {
            $_SESSION['add'] = "<div class = 'error'Failed to add Admin.!</div>";
            hear('location:'. SITEURL . 'admin/add-admin.php' );
        }
    }

?>