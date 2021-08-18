<?php
    session_start();
    include 'includes/header.php';
    include 'includes/connect.php';
?>
<div class="product-details ptb-100 pb-90">
    <div class="container">
    <?php
        if (isset ($_GET['id'])) {
            $_SESSION["PRODUCTNO"] = $_GET['id'];
        }
        $productno = $_SESSION["PRODUCTNO"];
        $query = "SELECT * FROM Product WHERE PRODUCTID=$productno";
        $stid = oci_parse($conn, $query);
        
        $reviewquery = "SELECT AVG(REVIEWSCORE) AS RATING, COUNT(*) AS NUMROWS FROM REVIEW WHERE PRODUCTID=$productno GROUP BY PRODUCTID";
        $reviewval = oci_parse($conn, $reviewquery);

        oci_execute($stid);
        $row = oci_fetch_assoc($stid);

        oci_execute($reviewval);
        $rev = oci_fetch_assoc($reviewval);
        $rating = floor($rev['RATING'] * 2) / 2;
        $cat = $row['CATEGORYID'];
    ?>
        <div class="row">
            <div class="col-md-12 col-lg-7 col-12">
                <div class="product-details-5 pr-70">
                    <img src="<?php echo $row['PRODUCTIMAGE']?>" alt="">
                </div>
            </div>
            <div class="col-md-12 col-lg-5 col-12">
                <div class="sidebar-active product-details-content">
                    <?php
                        if (isset($_SESSION['QUANTITYERROR'])) {
                            echo '<h6>Mininmum Order Quantity is '.$row["MINIMUMORDER"].' and Maximum Order Quantity is '.$row["MAXIMUMORDER"].'</h6>';
                            unset($_SESSION['QUANTITYERROR']);
                        }

                    ?>
                    <h3><?php echo $row['PRODUCTNAME']?><p><?php echo $row['PRODUCTSTOCK']?> item(s) in stock</p></h3>
                    <div class="rating-number">
                        <div class="placeholder" style="color: lightgray;">
                            <?php
                                if (isset($rev['RATING'])) {
                                    if($rating==0.5 ||$rating==1.5 ||$rating==2.5 ||$rating==3.5 ||$rating==4.5){
                                        $starsprinted=0;
                                        for ($i=1; $i < round($rating, PHP_ROUND_HALF_DOWN); $i++) { 
                                            echo "<img src=\"image/star/fullstar.png\">";
                                            $starsprinted = $i;
                                        }
                                        echo "<img src=\"image/star/halfstar.png\">";
                                        for ($i=1; $i < 5-$starsprinted ; $i++) { 
                                            echo "<img src=\"image/star/emptystar.png\">";
                                        }
                                    }
                                    else{
                                        $starsprinted;
                                        for ($i=1; $i <= $rating; $i++) { 
                                            echo "<img src=\"image/star/fullstar.png\">";
                                            $starsprinted = $i;
                                        }
                                        for ($i=1; $i <= 5-$starsprinted ; $i++) { 
                                            echo "<img src=\"image/star/emptystar.png\">";
                                        }
                                    }
                                }
                                else{
                                    for ($i=1; $i <= 5 ; $i++) { 
                                        echo "<img src=\"image/star/emptystar.png\">";
                                    }
                                }
                            ?>
                        </div>
                        <div class="quick-view-number">
                            <span>
                                <?php
                                    if (isset($rev['RATING'])) {
                                        echo $rating." stars";
                                    }
                                    else{
                                        echo "0"." stars";
                                    }
                                ?>
                            </span>     
                        </div>
                        <div class="quick-view-number">
                        <span>
                            <?php 
                                if (isset($rev['NUMROWS'])) {
                                    echo $rev['NUMROWS'];
                                }
                                else{
                                    echo "0";
                                }
                            ?>   
                        Rating (s)</span>     
                        </div>
                    </div>
                    <?php
                        if(isset($row['PRODUCT_DISCOUNT_PERCENT'])){
                            echo '<span>'.$row['PRODUCT_DISCOUNT_PERCENT'].'% Discount </span>';
                        }
                    ?>
                    <div class="details-price">
                    
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
                    <p><?php echo $row['PRODUCTDESCRIPTION']?></p>
                    <div class="product-color-2">
                                <h4 class="details-title"><img src="image/shop/warning.png" width="6%">Allergy Information: </h4>
                                <div class="product-color-style2">
                                <p><?php echo $row['ALLERGYINFORMATION']?></p>
                                </div>
                            </div>
                    
                    <p>Minimum Order: <?php echo $row['MINIMUMORDER']?> &nbsp&nbsp&nbsp&nbsp Maximum Order: <?php echo $row['MAXIMUMORDER']?></p>
                    <form action="additemstocart.php?id=<?php echo $row['PRODUCTID'];?>" method="POST">
                    <div class="quickview-plus-minus">
                        <div class="cart-plus-minus">
                            <input name="quantity" type="text" value="<?php echo $row['MINIMUMORDER'];?>" name="qtybutton" class="cart-plus-minus-box">
                        </div>
                        <div class="quickview-btn-cart">
                            <input class="btn-outline-dark btn-hover-black" type="submit" value="Add to Cart" />
                        </div>
                    </div>
                    </form>
                    <div class="product-details-cati-tag mt-35">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="product-description-review-area pb-90">
    <div class="container">
        <div class="product-description-review text-center">
            <div class="description-review-title nav" role=tablist>
                <a class="active" href="#pro-dec" data-toggle="tab" role="tab" aria-selected="true">
                    Description
                </a>
                <a href="#pro-review" data-toggle="tab" role="tab" aria-selected="false">
                    Reviews (<?php 
                                if (isset($rev['NUMROWS'])) {
                                    echo $rev['NUMROWS'];
                                }
                                else{
                                    echo "0";
                                }
                            ?>)
                </a>
            </div>
            <div class="description-review-text tab-content">
                <div class="tab-pane active show fade" id="pro-dec" role="tabpanel">
                    <p><?php echo $row['PRODUCTDESCRIPTION']?></p>
                </div>
                <div class="tab-pane fade container" id="pro-review" role="tabpanel">
                    <?php
                        $qry = "SELECT * FROM REVIEW WHERE PRODUCTID=$productno";
                        $stid = oci_parse($conn, $qry);
                        oci_execute($stid);

                        while (($row = oci_fetch_assoc($stid)) != false) {
                    ?>
                    <div class="row">  
                        <div>
                            <h4 class="details-title">
                            <?php echo $row['CUSTOMERNAME'];?>
                            </h4>
                        </div>
                        <div class="col-1"></div> 
                        <div>
                            <h4 class="details-title">
                                    <?php echo $row['REVIEWDATE'];?>
                            </h4>
                        </div>
                    </div>    
                    <div class="row">
                        <?php
                            for ($i=1; $i <= $row['REVIEWSCORE']; $i++) { 
                                echo "<img src=\"image/star/fullstar.png\">";
                                $starsprinted = $i;
                            }
                            for ($i=1; $i <= 5-$starsprinted ; $i++) { 
                                echo "<img src=\"image/star/emptystar.png\">";
                            }
                        ?> 
                    </div>  
                    <br>
                    <div class="row">  
                            <?php echo $row['REVIEWDESCRIPTION'];?>
                    </div> 
                    <hr>
                    <?php
                        }
                    ?>
                    <?php
                        if (!isset($rev['RATING'])) {
                            echo '<a href="#add" class="" data-toggle="modal"><i class="fa fa-edit" name ="edit"></i>Be the First to Write a review!</a> ';
                        }
                        else{
                            echo '<a href="#add" class="" data-toggle="modal"><i class="fa fa-edit" name ="edit"></i>Write your review!</a> ';
                            
                        }
                    ?>    
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>
<!-- product area start -->
<div class="special-food-area wrapper-padding-7 pt-115 pb-115">
    <div class="container">
        <div class="section-title-10 text-center mb-65">
            <h2>Related Products</h2>
            <p>..</p>
        </div>
    </div>
    <div class="container-fluid">
        <div class="special-food-active owl-carousel">
            <?php
                    $querys = "SELECT * FROM Product WHERE ROWNUM <= 6 AND CATEGORYID = $cat";
                    $stid = oci_parse($conn, $querys);
                    oci_execute($stid);
                    while (($rows = oci_fetch_assoc($stid)) != false) {
                ?>
            <div class="single-special-food">
                
                <a href="product-details.php?id=<?php echo $rows['PRODUCTID'];?>"><img src="<?php echo $rows['PRODUCTIMAGE']?>" alt="" width="20%"></a>
                <div class="special-food-content text-center">
                    <h4><a href="product-details.php?id=<?php echo $rows['PRODUCTID'];?>"><?php echo $rows['PRODUCTNAME']?></a></h4>
                    <p><?php echo $rows['PRODUCTDESCRIPTION']?></p>
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
                                echo '&pound;'.$rows['PRODUCTPRICE'];
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
<!-- product area end -->
    <?php include 'includes/footer.php';
    include 'add_review.php'; ?>                            
    </body>
</html>
