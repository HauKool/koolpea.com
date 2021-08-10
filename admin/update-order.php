<?php include('partials/menu.php'); ?>

 <div class="main-content">
     <div class="wrapper">
         <h1>Update Order</h1>
         <br><br><br>

         <?php
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];
                $sql = "SELECT * FROM tbl_oder WHERE ID='$id'";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                if($count == 1)
                {
                    $row = mysqli_fetch_assoc($res);
                    $food = $row['food'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name']; 
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];
                }
                

            }
         ?>

         <form action="" method="POST">
             <table class="tbl-40">
                 <tr>
                     <td>Food: </td>
                     <td >
                        <?php echo $food; ?>
                     </td>
                 </tr>
                 <tr>
                     <td>Price: </td>
                     <td>
                         $<?php echo $price; ?>
                     </td>
                 </tr>
                 <tr>
                     <td>Qty: </td>
                     <td>
                         <input type="number" name="qty" value="<?php echo $qty; ?>">
                     </td>
                 </tr>
                 <tr>
                     <td>Status: </td>
                     <td>
                        <select name="status">
                            <option value="Ordered">Ordered</option>
                            <option value="On Delivery">On Delivey</option>
                            <option value="Deliveried">Deliveried</option>
                            <option value="Cancelled">Cancelled</option>
                        </select>
                     </td>
                 </tr>
                 <tr>
                     <td>Customer Name: </td>
                     <td>
                         <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                     </td>
                 </tr>
                 <tr>
                     <td>Customer Contact: </td>
                     <td>
                         <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
                     </td>
                 </tr>
                 <tr>
                     <td>Customer Email: </td>
                     <td>
                         <input type="text" name="customer_email" value="<?php echo $customer_email; ?>">
                     </td>
                 </tr>
                 <tr>
                     <td>Customer Address: </td>
                     <td>
                         <textarea name="customer_address"cols="30" rows="5"><?php echo $customer_address; ?></textarea>
                     </td>
                 </tr>
                 <tr>
                     <td>
                         <input type="hidden" name="id" value="<?php echo $id; ?>">
                         <input type="hidden" name="price" value="<?php echo $price; ?>">
                         <input type="submit" name="submit" value="Update" class="btn-sussces">
                     </td>
                 </tr>
             </table>
         </form>

        <?php
            if(isset($_POST['submit']))
            {
                $id = $_POST['id'];
                $qty = $_POST['qty'];
                $price = $_POST['price'];
                $total = $price * $qty;
                $status = $_POST['status'];

                $customer_name = $_POST['customer_name'];
                $customer_contact = $_POST['customer_contact'];
                $customer_email = $_POST['customer_email'];
                $customer_address = $_POST['customer_address'];

                $sql2 = "UPDATE `tbl_oder` SET `qty`='$qty',`total`='$total',`status`='$status',`customer_name`='$customer_name',`customer_contact`='$customer_contact',`customer_email`='$customer_email',`customer_address`='$customer_address' WHERE ID='$id'";

                $res2 = mysqli_query($conn, $sql2);

                if($res2 == TRUE)
                {
                    $_SESSION['update'] = "<div class='sussces'>Order updated Susscessfully.!</div>";
                    header('location:'.SITEURL.'admin/mananger-oder.php');
                }
                else
                {
                    $_SESSION['update'] = "<div class='error'>Failed to Update Order.!</div>";
                    header('location:'.SITEURL.'admin/mananger-oder.php');
                }
            }
        ?>
     </div>
 </div>

<?php include('partials/footer.php'); ?>