<?php include('partials/menu.php'); ?>

        <!-- Main section starts -->

        <div class="main-content">
            <div class="wrapper"> 
               <h1>Manange Admin</h1>

               <?php 
               
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }
                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                    if(isset($_SESSION['user not-found']))
                    {
                        echo $_SESSION['user not-found'];
                        unset($_SESSION['user not-found']);
                    }
                    if(isset($_SESSION['pwd-not-match']))
                    {
                        echo $_SESSION['pwd-not-match'];
                        unset($_SESSION['pwd-not-match']);
                    }
                    if(isset($_SESSION['change-pwd']))
                    {
                        echo $_SESSION['change-pwd'];
                        unset($_SESSION['change-pwd']);
                    }
               ?> 

                <br></br>
                <a href="add-admin.php" class="btn-add">Add Admin</a>
                <br><br><br>

               <table class="tbl-full">
                   <tr>
                       <th>ID</th>
                       <th>Username</th>
                       <th>Full Name</th>
                       <th>Actions</th>
                   </tr>
                    <?php 
                    
                        $sql = "SELECT * FROM `tbl_admin` WHERE 1";
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
                                    $full_name = $rows['full_name'];
                                    $username = $rows['username'];

                                    ?>

                                        <tr>
                                            <td><?php echo $temp++;?></td>
                                            <td><?php echo $username;?></td>
                                            <td><?php echo $full_name;?></td>
                                            <td>
                                                <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id?>" class="btn-sussces">Change Password</a> 
                                                <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id?>" class="btn-sussces">Update</a> 
                                                <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id?>" class="btn-danger">Delete</a> 
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

        <!-- Main section ends -->

<?php include('partials/footer.php'); ?>