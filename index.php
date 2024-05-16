<?php include('partials-front/menu1.php'); ?>

        <!--food-search start-->
    <section class="food-search text-center">
        <div class="container">

        <form action="<?php echo SITEURL; ?>menu-search.php" method="POST">
           
            <input type="search" name="search" placeholder="Search any item..." required>
            <input type="submit" name="submit" value="Search" class="button button-primary">
        </form>
    </div>
    </section>
       <!--food-search end-->
       <?php 
       if(isset($_SESSION['order']))
       {
           echo $_SESSION['order'];
           unset($_SESSION['order']);
       }

        ?>



         <!--categories start-->
    <section class="categories">
        <div class="container">
        <h2 class="text-center">Categories</h2>

        <?php 
         
            //create sql query to display categories from database
            $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
            //execute the query
            $res = mysqli_query($conn, $sql);
            //count rows to check wheather the category is available or not
            $count = mysqli_num_rows($res);

            if($count>0)
            {
                //categories available
                while($row=mysqli_fetch_assoc($res))
                {
                    //get the value like id, title, image_name 
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    ?>

                <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                    <div class="box-3 float-container"  >
                        <?php 
                        //check wheather image is available or not
                            if($image_name=="")
                            {
                                //display message
                                echo "<div class='error'>Image not Available</div>";
                            }
                            else
                            {
                                //image availble
                                ?>
                               <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="beverages" class="img-responsive img-curve">
                               <?php
                            }
                        
                        ?>
                        

                        <h3 class="float-text text-center"><?php echo $title; ?></h3>
                    </div>
                </a>


                    <?php
                }

            }
            else
            {
                //categories is not available
                echo "<div class='error'>Category not Added.</div>";
            }
          
          
        ?>
        
            
        <div class="clearfix"> </div>
    </div>
    </section>
       <!--categories end-->

         <!--food-menu start-->
    <section class="food-menu">
        <div class="container">
        <h2 class="text-center">Explore Menu</h2>

        <?php 

        //getting foods from database that are active and featured
        //sql query
        $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 28";
        
        //execute the query
        $res2 = mysqli_query($conn, $sql2);
        
        //count rows
        $count2 = mysqli_num_rows($res2);

        //check wheather food available or not
        if($count2>0)
        {
            //food available
            while($row=mysqli_fetch_assoc($res2))
            {
                //get all the values
                $id = $row['id'];
                $title = $row['title'];
                $price = $row['price'];
                //$description =$row['description'];
                $image_name = $row['image_name'];

                ?>

                <div class="food-menu-box" style= "height: 150px; border-radius: 20px; border: 2px solid #000;">
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