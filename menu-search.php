<?php include('partials-front/menu1.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <?php 

                //get the search keyword
                $search = $_POST['search'];

            ?>
            
            <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->


    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Explore Menu</h2>

            <?php 
            
            //sql query to get foods based on search keyword
            $sql = "SELECT * FROM   tbl_food WHERE title LIKE '%$search%'";
            
            
            //execute the query
            $res = mysqli_query($conn, $sql);

            //count rows
            $count = mysqli_num_rows($res);
            if($count>0)
            {
                //food available 
                while($row=mysqli_fetch_assoc($res))
                {
                    //get the deatils
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    //$description = $row['description'];
                    $image_name = $row['image_name'];

                    ?>
                    <div class="food-menu-box" style="height: 150px; border-radius: 20px; border: 2px solid #000;">
                        <div class="food-menu-img">
                            <?php 

                                //check wheather image name is available or not
                                if($image_name=="")
                                {
                                    //image not available
                                    echo "<div class='error'>Image not Available.</div>";
                                }
                                else
                                {
                                    //image available
                                    ?>
                                    
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="BEVERAGES" class="img-responsive img-curve">

                                    <?php
                                }
                            
                            
                            ?>
                            
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price">₹<?php echo $price; ?></p>
                
                            <br>

                            <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                         </div>
                    </div>

                    <?php


                }

            }
            else
            {
                //food not available
                echo "<div class='error'>Food not found.</div>";
            }
            
            ?>


            
            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>