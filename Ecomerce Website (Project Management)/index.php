<?php 
    session_start();
    include 'includes/connect.php';
    include 'includes/header.php';
?>

<div class="slider-area">
    <div class="slider-active owl-carousel">
        <div class="food-slider bg-img slider-height-5" style="background-image: url(image/banner/delibanner.jpg)">
            <div class="container">
                <div class="food-slider-content text-center fadeinup-animated">
                <p class="animated" style="color:black; font-size:500%; font-family:Amithen">Deli Lovers</p>
                    <p class="animated" style="color:black">Browse through the deli products for you perfect needs</p>
                    <a class="food-slider-btn animated" href="shop.php">Shop Now</a>
                </div>
            </div>
        </div>
        <div class="food-slider bg-img slider-height-5" style="background-image: url(image/banner/cheesebanner.jpg)">
            <div class="container">
                <div class="food-slider-content text-center fadeinup-animated">
                    <p class="animated" style="color:black; font-size:400%; font-family:Amithen">Cheese Lovers</p>
                    <p class="animated" style="color:black">Want some great cheese for you salad, burgers, pastas, etc</p>
                    <a class="food-slider-btn animated" href="shop.php">Shop Now</a>
                </div>
            </div>
        </div>
        <div class="food-slider bg-img slider-height-5" style="background-image: url(image/banner/vegetablebanner.jpg)">
            <div class="container">
                <div class="food-slider-content text-center fadeinup-animated">
                <p class="animated" style="color:black; font-size:400%; font-family:Amithen">Vegan Lovers</p>
                    <p class="animated" style="color:black">Search through our shops to get the best and freshest vegetables and fruits you can get around the city</p>
                    <a class="food-slider-btn animated" href="shop.php">Shop Now</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- product area start -->
<!-- popular product area start -->
<div class="popular-product-area wrapper-padding-6 pt-115 pb-70 bg-img" style="background-image: url(assets/img/bg/13.jpg)">
    <div class="container-fluid">
        <div class="section-title-10 text-center mb-85">
            <h2>Most Popular for this month</h2>
            <p> </p>
        </div>
        <div class="popular-product-wrapper">
        <?php
            $stid = oci_parse($conn, 'SELECT * FROM Product WHERE ROWNUM <= 3 AND PRODUCTSTOCK>=30');
            oci_execute($stid);
            while (($row = oci_fetch_assoc($stid)) != false) {
        ?>
            <div class="single-popular-product food-border-1 text-center mb-40">
                <a><img src="<?php echo $row['PRODUCTIMAGE']?>" width="90%" alt=""></a>
                <h3><a href="product-details.php?id=<?php echo $row['PRODUCTID'];?>"><?php echo $row['PRODUCTNAME']?></a></h3>
                <p><?php echo $row['PRODUCTDESCRIPTION']?></p>
                <div class="popular-product">
                <span class="pizza-new-price">
                    <?php
                        if(isset($row['PRODUCT_DISCOUNT_PERCENT'])){
                            $oldprice = $row['PRODUCTPRICE'];
                            $discount = $row['PRODUCT_DISCOUNT_PERCENT'];
                            $price = $oldprice-($oldprice*$discount/100);
                            echo '<del>&pound;'.$oldprice.'</del>';
                            echo '&nbsp; &pound;'.$price;
                        }
                        else{
                            echo '&pound;'.$row['PRODUCTPRICE'];
                        }
                    ?>
                </span>
                </div>
            </div>
        <?php  
            }
        ?>
        </div>
    </div>
</div>
<div class="food-services-area bg-img pt-200 pb-155" style="background-image: url(assets/img/bg/12.jpg)">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <div class="single-food-services text-center food-services-padding1 mb-40">
                    <img src="image/shop/shop.png" alt="">
                    <h4>Choose Shop</h4>
                    <p>Choose from various shops the products you want</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="single-food-services text-center food-services-padding2 mb-40">
                    <img src="" alt="">
                    <h4>Select Your Foods</h4>
                    <p>Select the products that you require</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="single-food-services text-center food-services-padding3 mb-40">
                    <img src="image/shop/clock.png" alt="">
                    <h4>Choose Collection Slot</h4>
                    <p>Choose the time when you want to pick up your order</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- services area end -->
<!-- menu area start -->
<div class="food-menu-area bg-img pt-110 pb-120" style="background-image: url(assets/img/bg/13.jpg)">
    <div class="container">
        <div class="section-title-10 text-center mb-60">
            <h2>Categories</h2>
            <p>Search Foods with different categories of your need</p>
        </div>
        <div class="food-menu-product-style">
            <div class="food-menu-list text-center mb-65 nav" role="tablist">
                <a class="active" href="#menu1" data-toggle="tab" role="tab">
                    <h4>All Categories  </h4>
                </a>
                <a href="#menu2" data-toggle="tab" role="tab">
                    <h4>Meat  </h4>
                </a>
                <a href="#menu3" data-toggle="tab" role="tab">
                    <h4>Veggies  </h4>
                </a>
                <a href="#menu4" data-toggle="tab" role="tab">
                    <h4>Fish  </h4>
                </a>
                <a href="#menu5" data-toggle="tab" role="tab">
                    <h4>Cheese </h4>
                </a>
                <a href="#menu6" data-toggle="tab" role="tab">
                    <h4>Bakery </h4>
                </a>
            </div>
            <div class="tab-content">
                <div class="tab-pane active show fade" id="menu1" role="tabpanel">
                    <div class="row">
                    <?php
                        $stid = oci_parse($conn, 'SELECT * FROM Product WHERE ROWNUM <= 6 ORDER BY PRODUCTNAME');
                        oci_execute($stid);
                        while (($row = oci_fetch_assoc($stid)) != false) {
                    ?>
                        <div class="col-lg-6">
                            <div class="menu-product-wrapper">
                                <div class="single-menu-product mb-30">
                                    <div class="menu-product-img">
                                        <img src="<?php echo $row['PRODUCTIMAGE']?>" width = "160px" alt="">
                                    </div>
                                    <div class="menu-product-content">
                                        <h4><a href="product-details.php?id=<?php echo $row['PRODUCTID'];?>"><?php echo $row['PRODUCTNAME']?></a></h4>
                                        <div class="menu-product-price-rating">
                                            <div class="menu-product-price">
                                            <span class="pizza-new-price">
                                                <?php
                                                    if(isset($row['PRODUCT_DISCOUNT_PERCENT'])){
                                                        $oldprice = $row['PRODUCTPRICE'];
                                                        $discount = $row['PRODUCT_DISCOUNT_PERCENT'];
                                                        $price = $oldprice-($oldprice*$discount/100);
                                                        echo '<del>&pound;'.$oldprice.'</del>';
                                                        echo '&nbsp; &pound;'.$price;
                                                    }
                                                    else{
                                                        echo '&pound;'.$row['PRODUCTPRICE'];
                                                    }
                                                ?>
                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>    
                        </div>
                    <?php
                        }
                    ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="menu2" role="tabpanel">
                    <div class="row">
                        <?php
                            $stid = oci_parse($conn, 'SELECT * FROM Product WHERE CATEGORYID=1 AND ROWNUM <= 6');
                            oci_execute($stid);
                            while (($row = oci_fetch_assoc($stid)) != false) {
                        ?>
                            <div class="col-lg-6">
                                <div class="menu-product-wrapper">
                                    <div class="single-menu-product mb-30">
                                        <div class="menu-product-img">
                                            <img src="<?php echo $row['PRODUCTIMAGE']?>" width = "160px" alt="">
                                        </div>
                                        <div class="menu-product-content">
                                            <h4><a href="product-details.php?id=<?php echo $row['PRODUCTID'];?>"><?php echo $row['PRODUCTNAME']?></a></h4>
                                            <div class="menu-product-price-rating">
                                                <div class="menu-product-price">
                                                <span class="pizza-new-price">
                                                    <?php
                                                        if(isset($row['PRODUCT_DISCOUNT_PERCENT'])){
                                                            $oldprice = $row['PRODUCTPRICE'];
                                                            $discount = $row['PRODUCT_DISCOUNT_PERCENT'];
                                                            $price = $oldprice-($oldprice*$discount/100);
                                                            echo '<del>&pound;'.$oldprice.'</del>';
                                                            echo '&nbsp; &pound;'.$price;
                                                        }
                                                        else{
                                                            echo '&pound;'.$row['PRODUCTPRICE'];
                                                        }
                                                    ?>
                                                </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>    
                            </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="menu3" role="tabpanel">
                    <div class="row">
                        <?php
                            $stid = oci_parse($conn, 'SELECT * FROM Product WHERE CATEGORYID=3 AND ROWNUM <= 6');
                            oci_execute($stid);
                            while (($row = oci_fetch_assoc($stid)) != false) {
                        ?>
                            <div class="col-lg-6">
                                <div class="menu-product-wrapper">
                                    <div class="single-menu-product mb-30">
                                        <div class="menu-product-img">
                                            <img src="<?php echo $row['PRODUCTIMAGE']?>" width = "160px" alt="">
                                        </div>
                                        <div class="menu-product-content">
                                            <h4><a href="product-details.php?id=<?php echo $row['PRODUCTID'];?>"><?php echo $row['PRODUCTNAME']?></a></h4>
                                            <div class="menu-product-price-rating">
                                                <div class="menu-product-price">
                                                <span class="pizza-new-price">
                                                    <?php
                                                        if(isset($row['PRODUCT_DISCOUNT_PERCENT'])){
                                                            $oldprice = $row['PRODUCTPRICE'];
                                                            $discount = $row['PRODUCT_DISCOUNT_PERCENT'];
                                                            $price = $oldprice-($oldprice*$discount/100);
                                                            echo '<del>&pound;'.$oldprice.'</del>';
                                                            echo '&nbsp; &pound;'.$price;
                                                        }
                                                        else{
                                                            echo '&pound;'.$row['PRODUCTPRICE'];
                                                        }
                                                    ?>
                                                </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>    
                            </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="menu4" role="tabpanel">
                    <div class="row">
                        <?php
                            $stid = oci_parse($conn, 'SELECT * FROM Product WHERE CATEGORYID=2 AND ROWNUM <= 6');
                            oci_execute($stid);
                            while (($row = oci_fetch_assoc($stid)) != false) {
                        ?>
                            <div class="col-lg-6">
                                <div class="menu-product-wrapper">
                                    <div class="single-menu-product mb-30">
                                        <div class="menu-product-img">
                                            <img src="<?php echo $row['PRODUCTIMAGE']?>" width = "160px" alt="">
                                        </div>
                                        <div class="menu-product-content">
                                            <h4><a href="product-details.php?id=<?php echo $row['PRODUCTID'];?>"><?php echo $row['PRODUCTNAME']?></a></h4>
                                            <div class="menu-product-price-rating">
                                                <div class="menu-product-price">
                                                <span class="pizza-new-price">
                                                    <?php
                                                        if(isset($row['PRODUCT_DISCOUNT_PERCENT'])){
                                                            $oldprice = $row['PRODUCTPRICE'];
                                                            $discount = $row['PRODUCT_DISCOUNT_PERCENT'];
                                                            $price = $oldprice-($oldprice*$discount/100);
                                                            echo '<del>&pound;'.$oldprice.'</del>';
                                                            echo '&nbsp; &pound;'.$price;
                                                        }
                                                        else{
                                                            echo '&pound;'.$row['PRODUCTPRICE'];
                                                        }
                                                    ?>
                                                </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>    
                            </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="menu5" role="tabpanel">
                    <div class="row">
                        <?php
                            $stid = oci_parse($conn, 'SELECT * FROM Product WHERE CATEGORYID=5  AND ROWNUM <= 6');
                            oci_execute($stid);
                            while (($row = oci_fetch_assoc($stid)) != false) {
                        ?>
                            <div class="col-lg-6">
                                <div class="menu-product-wrapper">
                                    <div class="single-menu-product mb-30">
                                        <div class="menu-product-img">
                                            <img src="<?php echo $row['PRODUCTIMAGE']?>" width = "160px" alt="">
                                        </div>
                                        <div class="menu-product-content">
                                            <h4><a href="product-details.php?id=<?php echo $row['PRODUCTID'];?>"><?php echo $row['PRODUCTNAME']?></a></h4>
                                            <div class="menu-product-price-rating">
                                                <div class="menu-product-price">
                                                <span class="pizza-new-price">
                                                    <?php
                                                        if(isset($row['PRODUCT_DISCOUNT_PERCENT'])){
                                                            $oldprice = $row['PRODUCTPRICE'];
                                                            $discount = $row['PRODUCT_DISCOUNT_PERCENT'];
                                                            $price = $oldprice-($oldprice*$discount/100);
                                                            echo '<del>&pound;'.$oldprice.'</del>';
                                                            echo '&nbsp; &pound;'.$price;
                                                        }
                                                        else{
                                                            echo '&pound;'.$row['PRODUCTPRICE'];
                                                        }
                                                    ?>
                                                </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>    
                            </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="menu6" role="tabpanel">
                    <div class="row">
                        <?php
                            $stid = oci_parse($conn, 'SELECT * FROM Product WHERE CATEGORYID=6 AND ROWNUM <= 6');
                            oci_execute($stid);
                            while (($row = oci_fetch_assoc($stid)) != false) {
                        ?>
                            <div class="col-lg-6">
                                <div class="menu-product-wrapper">
                                    <div class="single-menu-product mb-30">
                                        <div class="menu-product-img">
                                            <img src="<?php echo $row['PRODUCTIMAGE']?>" width = "160px" alt="">
                                        </div>
                                        <div class="menu-product-content">
                                            <h4><a href="product-details.php?id=<?php echo $row['PRODUCTID'];?>"><?php echo $row['PRODUCTNAME']?></a></h4>
                                            <div class="menu-product-price-rating">
                                                <div class="menu-product-price">
                                                <span class="pizza-new-price">
                                                    <?php
                                                        if(isset($row['PRODUCT_DISCOUNT_PERCENT'])){
                                                            $oldprice = $row['PRODUCTPRICE'];
                                                            $discount = $row['PRODUCT_DISCOUNT_PERCENT'];
                                                            $price = $oldprice-($oldprice*$discount/100);
                                                            echo '<del>&pound;'.$oldprice.'</del>';
                                                            echo '&nbsp; &pound;'.$price;
                                                        }
                                                        else{
                                                            echo '&pound;'.$row['PRODUCTPRICE'];
                                                        }
                                                    ?>
                                                </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>    
                            </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
            <div class="menu-btn-area text-center mt-40">
                <a class="menu-btn btn-hover" href="shop.php">More Category Items</a>
            </div>
        </div>
    </div>
</div>
<!-- menu area end -->

<!-- special items area start -->
<div class="special-food-area wrapper-padding-7 pt-115 pb-115">
    <div class="container">
        <div class="section-title-10 text-center mb-65">
            <h2>Special Products</h2>
            <p>..</p>
        </div>
    </div>
    <div class="container-fluid">
        <div class="special-food-active owl-carousel">
            <?php
                    $stid = oci_parse($conn, 'SELECT * FROM Product WHERE ROWNUM <= 10 ORDER BY PRODUCTPRICE DESC');
                    oci_execute($stid);
                    while (($row = oci_fetch_assoc($stid)) != false) {
                ?>
            <div class="single-special-food">
                
                <a href="product-details.php?id=<?php echo $row['PRODUCTID'];?>"><img src="<?php echo $row['PRODUCTIMAGE']?>" alt="" width="20%"></a>
                <div class="special-food-content text-center">
                    <h4><a href="product-details.php?id=<?php echo $row['PRODUCTID'];?>"><?php echo $row['PRODUCTNAME']?></a></h4>
                    <p><?php echo $row['PRODUCTDESCRIPTION']?></p>
                    <span>
                        <?php
                            if(isset($row['PRODUCT_DISCOUNT_PERCENT'])){
                                $oldprice = $row['PRODUCTPRICE'];
                                $discount = $row['PRODUCT_DISCOUNT_PERCENT'];
                                $price = $oldprice-($oldprice*$discount/100);
                                echo '<del>&pound;'.$oldprice.'</del>';
                                echo '&nbsp; &pound;'.$price;
                            }
                            else{
                                echo '&pound;'.$row['PRODUCTPRICE'];
                            }
                        ?>
                    </span>
                </div>
                
            </div>
            <?php
                    }
                ?>
        </div>
    </div>
</div>
<!-- special food area end -->




<div class="brand-logo-area-3 wrapper-padding-7 ptb-120 bg-img" style="background-image: url(images/.jpg)">
    <div class="container-fluid">
        <div class="brand-logo-active3 owl-carousel">
            <div class="single-brand">
                <img src="image/shop/v2.jpg" alt="">
            </div>
            <div class="single-brand">
                <img src="image/shop/v3.jpg" alt="">
            </div>
            <div class="single-brand">
                <img src="image/shop/v4.jpg" alt="">
            </div>
            <div class="single-brand">
                <img src="image/shop/v5.jpg" alt="">
            </div>
            <div class="single-brand">
                <img src="image/shop/v6.jpg" alt="">
            </div>
            <div class="single-brand">
                <img src="image/shop/v7.jpg" alt="">
            </div>
            <div class="single-brand">
                <img src="image/shop/v8.jpg" alt="">
            </div>
        </div>
    </div>
</div>
<?php
    include 'includes/footer.php';
?>