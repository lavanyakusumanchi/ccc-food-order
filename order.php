<?php include('partials-front/menu1.php'); ?>

<?php 
    //check wheather food id is set or not
    if(isset($_GET['food_id']))
    {
        //get the food id and details of the selected food
        $food_id = $_GET['food_id'];

        //GET the deatils of the selected food
        $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
        //execute the query
        $res = mysqli_query($conn, $sql);
        //count the rows
        $count = mysqli_num_rows($res);
        //check wheather the data is available or not
        if($count==1)
        {
            //we have data
            //get the data from databasehaa
            $row = mysqli_fetch_assoc($res);

            $title = $row['title'];
            $price = $row['price'];
            $image_name = $row['image_name'];
      
        }
        else
        {
            //food not available
            //redirect to homepage
        header('location:'.SITEURL);

        }
    }
    else
    {
        //redirect to homepage
        header('location:'.SITEURL);
        
    }



?>

<!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search" style="padding: 20px;">
        <div class="container">
            
            

            <form action="" method="POST" class="order" style="background-color: #f9f9f9; padding: 20px; border-radius: 10px; margin-bottom: 20px; ">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img" style="margin-bottom: 20px;">
                        <?php
                        
                            //check wheather the image is available or not
                            if($image_name=="")
                            {
                                //image not available
                                echo "<div class='error'>Image not Available.</div>";
                            }
                            else
                            {
                                //image is available
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="BEVERAGES" class="img-responsive img-curve">
                                <?php
                            }
                        
                        
                        ?>
                        
                        
                    </div>
    
                    <div class="food-menu-desc" style="margin-bottom: 5px; color: #333;">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">

                        <p class="food-price">Rs:<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity:</div>
                        <br>
                        <input type="number" name="qty" class="input-responsive" style="width: 100%; padding: 10px; border-radius: 2px; border: 3px solid grey; margin-bottom: 15px;" value="1" required>
                        
                    </div>
                   

                </fieldset>
                <h2 class="text-center text-white">Fill this form to confirm your order.</h2>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label" style="margin-bottom: 5px; font-weight: bold;">Full Name</div>
                    <input type="text" name="full-name" placeholder="Enter your name" class="input-responsive" style="width: 100%; padding: 10px; border-radius: 5px; border: 3px solid grey; margin-bottom: 15px;" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" style="width: 100%; padding: 10px; border-radius: 5px; border: 3px solid grey; margin-bottom: 15px;" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="Enter email address" class="input-responsive" style="width: 100%; padding: 10px; border-radius: 5px; border: 3px solid grey; margin-bottom: 15px;" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" style="width: 100%; padding: 10px; border-radius: 5px; border: 3px solid grey; margin-bottom: 15px;" required></textarea>

                    <input type="submit" name="submit" value="CONFIRM ORDER" class="btn btn-primary" style="background-color: #ff4d4dcd; color: white; padding: 12px 24px; border: none; border-radius: 5px; cursor: pointer;">
                </fieldset>

            </form>
            <?php 
            
                //check wheather submit button is clicked or not
                if(isset($_POST['submit']))
                {
                    //get all the details from the form

                    $food = $_POST['food'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];
                    
                    $total = $price * $qty; //total = price * qty

                    $order_date = date("Y-m-d H:i:s"); //order date

                    $status = "Ordered"; //ordered, on delivered, cancelled

                    $customer_name = $_POST['full-name'];
                    $customer_contact = $_POST['contact'];
                    $customer_email = $_POST['email'];
                    $customer_address = $_POST['address'];

                    //save the order in database
                    //create sql to save  the data
                    $sql2 = "INSERT INTO tbl_order SET
                        food =  '$food',
                        price = $price,
                        qty = $qty,
                        total = $total,
                        order_date = '$order_date',
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address'
                        
                    ";

                    //execute the query
                    $res2 = mysqli_query($conn, $sql2);

                    //check wheather query executed sucessfully or not
                    if($res2==true)
                    {
                        //query executed and order saved
                        $_SESSION['order'] = "<div class='success text-center'>Food Ordered Successfully.</div>";
                        header('location:'.SITEURL);
                    }
                    else
                    {
                        //Failed to save order
                        $_SESSION['order'] = "<div class='error text-center'>Failed to order Food.</div>";
                        header('location:'.SITEURL);

                    }


                }
            
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
       


    <?php include('partials-front/footer.php'); ?>