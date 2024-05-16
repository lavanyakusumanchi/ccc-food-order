<?php include('partials-front/menu1.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>menu-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="button button-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Explore Menu</h2>

        <?php 

            //getting foods from database that are active 
            //sql query
            $sql = "SELECT * FROM tbl_food WHERE active='Yes' LIMIT 28";

            //execute the query
            $res = mysqli_query($conn, $sql);

           //count rows
           $count = mysqli_num_rows($res);

           //check wheather food available or not
           if($count>0)
           {
                //food available
                while($row=mysqli_fetch_assoc($res))
                {
                    //get all the values
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    //$description =$row['description'];
                    $image_name = $row['image_name'];
                    ?>

                    <div class="food-menu-box"  style="height: 150px; border-radius: 20px; border: 2px solid #000;">
                        <div class="food-menu-img">
                            <?php
                                //check wheather image available or not
                                if($image_name=="")
                                {
                                    //image not availble
                                    echo "<div class='error'>Image not available.</div>";
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
                        <p class="food-price">Rs:<?php echo $price; ?></p>
                        
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
            echo "<div class='error'>Food not available.</div>";
        }

    ?>


    <div class="clearfix"></div>

     </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->



    <?php include('partials-front/footer.php'); ?>