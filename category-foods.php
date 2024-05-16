<?php include('partials-front/menu1.php'); ?>

<?php
    //check wheather the id is passed or not
    if(isset($_GET['category_id']))
    {
        //category id is set and get the id
        $category_id = $_GET['category_id'];
        //get category title based on category id
        $sql = "SELECT title FROM tbl_category WHERE id=$category_id";

        //execute the sql
        $res = mysqli_query($conn, $sql);

        //get the value from database
        $row = mysqli_fetch_assoc($res);
        //get the title
        $category_title = $row['title'];
    }
    else
    {
        //category not passed
        //redirect to home page
        header('location:'.SITEURL);
    }

?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



   <!--food-menu start-->
    <section class="food-menu">
        <div class="container">
        <h2 class="text-center">Explore Menu</h2>


        <?php 
        
            //create sql query to get foods based on selected category
            $sql2 = "SELECT * FROM tbl_food WHERE category_id=$category_id";

            //execute the query
            $res2 = mysqli_query($conn, $sql2);

            //count the rows
            $count2 = mysqli_num_rows($res2);

            //check wheather food is available or not
            if($count2>0)
            {
                //food is available
                while($row2=mysqli_fetch_assoc($res2))
                {
                    $id = $row2['id'];
                    $title = $row2['title'];
                    $price = $row2['price'];
                    $image_name = $row2['image_name'];
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
       <!--food-menu end-->
       
       <?php include('partials-front/footer.php'); ?>