<?php include('partials/menu.php') ?>

        <!-- Main section starts -->
        <div class="main-content">
            <div class="wrapper"> 
                <br>
                <?php         
                    if(isset($_SESSION['login']))
                    {
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }
                ?>
                <br>
               <div class="col-4 text-center">
                    <?php 
                        $sql = "SELECT * FROM tbl_category";
                        $res = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($res);
                    ?>
                    <h1><?php echo $count; ?></h1>
                    <br>
                    Categories
               </div>
               <div class="col-4 text-center">
                    <?php 
                        $sql2 = "SELECT * FROM tbl_food";
                        $res2 = mysqli_query($conn, $sql2);
                        $count2 = mysqli_num_rows($res2);
                    ?>
                    <h1><?php echo $count2; ?></h1>
                    <br>
                    Foods
               </div>
               <div class="col-4 text-center">
                    <?php 
                        $sql3 = "SELECT * FROM tbl_oder";
                        $res3 = mysqli_query($conn, $sql3);
                        $count3 = mysqli_num_rows($res3);
                    ?>
                    <h1><?php echo $count3; ?></h1>
                   <br>
                   Total Orders
               </div>
               <div class="col-4 text-center">
                    <?php 
                        $sql4 = "SELECT SUM(total) AS Total FROM tbl_oder WHERE status='Deliveried'";
                        $res4 = mysqli_query($conn, $sql4);                        
                        $row4 = mysqli_fetch_assoc($res4);
                        $total = $row4['Total'];
                    ?>
                    <h1>
                        <?php 
                            if($total == "") 
                                echo '0$';
                            else
                                echo $total.'$';
                        ?>
                    </h1>
                    <br>
                    Total Money
               </div>
               <div class="clearfix"></div>
            </div>    
           
        </div>
        <?php 
        
            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }

        ?>
       
        <!-- Main section ends -->

<?php include('partials/footer.php') ?>