<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Manange Oder</h1>
            <br><br><br>
            
            <?php 
                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
            ?>
            <br>
            <table class="tbl-full">
                <tr>
                    <th>ID</th>
                    <th>Food</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Cus_Name</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>

                <?php
                    $sql = "SELECT * FROM tbl_oder";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);
                    $temp = 1;
                    if($count>0)
                    {                        
                        while($row=mysqli_fetch_assoc($res))
                        {
                            $id = $row['ID'];
                            $food = $row['food'];
                            $price = $row['price'];
                            $qty = $row['qty'];
                            $total = $row['total'];
                            $status = $row['status'];
                            $name = $row['customer_name'];
                            $contact = $row['customer_contact'];
                            $email = $row['customer_email'];
                            $address = $row['customer_address'];

                            ?>
                                <tr>
                                    <td><?php echo $temp++;?></td>
                                    <td><?php echo $food?></td>
                                    <td><?php echo $price?></td>
                                    <td><?php echo $qty;?></td>
                                    <td><?php echo $total;?></td>
                                    <td>
                                        <?php 
                                            if($status == "Ordered")
                                            {
                                                echo "<label>$status</label>";
                                            }
                                            if($status == "On Delivery")
                                            {
                                                echo "<label style='color: #25CCF7;'>$status</label>";
                                            }
                                            if($status == "Deliveried")
                                            {
                                                echo "<label style='color: #4cd137;'>$status</label>";
                                            }
                                            if($status == "Cancelled")
                                            {
                                                echo "<label style='color: red;'>$status</label>";
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $name;?></td>
                                    <td><?php echo $contact;?></td>
                                    <td><?php echo $email;?></td>
                                    <td><?php echo $address;?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id?>" class="btn-sussces">Update</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete-order.php?id=<?php echo $id?>" class="btn-danger">Delete</a>
                                    </td>
                                </tr>
                            <?php                            
                        }
                    }
                    else
                    {
                        echo "<div class='error'>Order Not Availablr.!</div>";
                    }
                ?>

               
            </table>
        </div>
    </div>

<?php include('partials/footer.php'); ?>