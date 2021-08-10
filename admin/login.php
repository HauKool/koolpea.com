<?php include('../config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login - Food Order System</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>

    <div class="login">
        <h1 class="text-center">Login</h1>        

        <form action="" method="POST">
            Username:<br>
            <input style="padding: 1%; height: 20px; width: 80%; margin: 3%;" type="text" name="username" placeholder="Enter username">
            <br><br>
            Password:<br>
            <input style="padding: 1%; height: 20px; width: 80%; margin: 3%;" type="password" name="password" placeholder="Enter password">
            <br>
            <?php 
        
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                if(isset($_SESSION['no-login']))
                {
                    echo $_SESSION['no-login'];
                    unset($_SESSION['no-login']);
                }
        
            ?>
            <br>
            <input style="padding: 3%; width: 25%; margin-left: 25%;" type="submit" name="submit" value="Login" class="btn-sussces">
            <input style="padding: 3%; width: 25%; " type="submit" name="cancel" value="SignUp" class="btn-add">

        </form>
        
    </div>
    
</body>
</html>

<?php 

    if(isset($_POST['submit']))
    {
        // $username = $_POST['username'];
        // $password = md5($_POST['password']);

        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $raw_password = md5($_POST['password']);
        $password =  mysqli_real_escape_string($conn, $raw_password);

        $sql = "SELECT * FROM tbl_admin WHERE username ='$username' AND password ='$password'";

        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);

        if($count == 1)
        {
            $_SESSION['login'] ="<div class ='sussces text-center'>Login Susccesfully.!</div>";
            $_SESSION['user'] = $username;
            header('location:'.SITEURL.'admin/');

        }
        else
        {
            $_SESSION['login'] ="<div class ='error text-center'>Username or Password not Match.!</div>";
            header('location:'.SITEURL.'admin/login.php');
        }
    
    }

?>