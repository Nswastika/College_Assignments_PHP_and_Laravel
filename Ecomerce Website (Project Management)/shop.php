<?php
    session_start();
    include 'includes/header.php';
    include 'includes/connect.php';
    $custid = $_SESSION["custid"] = 30001;
?>
<div class="shop-page-wrapper shop-page-padding ptb-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3">
                <div class="shop-sidebar mr-50">
                    <div class="sidebar-widget mb-45">
                        <h3 class="sidebar-title">Browse By Categories</h3>
                        <div class="sidebar-categories">
                            <ul>
                            <?php
                                $qry = "SELECT * FROM CATEGORY";
                                $stid = oci_parse($conn, $qry);
                                oci_execute($stid);

                                if (isset($_GET['query'])) {
                                   $keyword = $_GET['query'];
                                }

                                while (($row = oci_fetch_assoc($stid)) != false) {
                                    $catid = $row['CATEGORYID'];
                                    $q = "SELECT COUNT(CATEGORYID) AS NUMROWS FROM PRODUCT WHERE CATEGORYID = $catid";
                                    $st = oci_parse($conn, $q);
                                    oci_execute($st);
                                    $r = oci_fetch_assoc($st);
                            ?>
                                <li class="active"><a href="shop.php?categoryset=<?php echo $catid;?>"><?php echo $row['CATEGORYNAME']?><span><?php echo $r['NUMROWS'];?></span></a></li>
                            <?php 
                            }
                            ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container col-lg-9">
                <div class="shop-product-wrapper res-xl">
                    <div class="shop-bar-area">
                        <div class="shop-bar pb-60">
                            <?php
                            if (isset($_GET['pageno'])) {
                                $pageno = $_GET['pageno'];
                            } else {
                                $pageno = 1;
                            }

                            if (isset($_GET['sorttype'])) {
                                $sort = $_GET['sorttype'];
                            } else {
                                $sort = "PRODUCTID";
                            }

                            $no_of_records_per_page = 10;
                            $offset = ($pageno-1) * $no_of_records_per_page;

                            if (isset($_GET['categoryset'])) {
                                $_SESSION['cate'] = $_GET['categoryset'];
                                $cate = $_SESSION['cate'];
                                $qry = "SELECT * FROM (SELECT A.*, ROWNUM RNUM FROM (SELECT * FROM PRODUCT WHERE CATEGORYID = $cate ORDER BY $sort) A WHERE ROWNUM <= $offset+10) WHERE RNUM > $offset";
                                $total_pages_sql = "SELECT COUNT(*) AS NUMROWS FROM PRODUCT WHERE CATEGORYID LIKE $cate";
                            }
                            else if(isset($_GET['query'])){
                                $search = strtolower($_GET['query']);
                                $qry = "SELECT * FROM (SELECT A.*, ROWNUM RNUM FROM (SELECT * FROM PRODUCT WHERE lower(PRODUCTNAME) LIKE '%$search%' OR lower(PRODUCTDESCRIPTION) LIKE '%$search%' OR lower(PRODUCTPRICE) LIKE '%$search%' OR CATEGORYID LIKE (SELECT CATEGORYID FROM PRODUCT WHERE CATEGORYID = (SELECT CATEGORYID FROM CATEGORY WHERE lower(CATEGORYNAME) LIKE '%$search%') GROUP BY CATEGORYID) ORDER BY PRODUCTID) A WHERE ROWNUM <= $offset+10) WHERE RNUM > $offset";
                                $total_pages_sql = "SELECT COUNT(*) AS NUMROWS FROM PRODUCT WHERE lower(PRODUCTNAME) LIKE '%$search%' OR lower(PRODUCTDESCRIPTION) LIKE '%$search%' OR lower(PRODUCTPRICE) LIKE '%$search%' OR CATEGORYID LIKE (SELECT CATEGORYID FROM PRODUCT WHERE CATEGORYID = (SELECT CATEGORYID FROM CATEGORY WHERE lower(CATEGORYNAME) LIKE '%$search%') GROUP BY CATEGORYID) ORDER BY PRODUCTID";
                            }
                            else {
                                $qry = "SELECT * FROM (SELECT A.*, ROWNUM RNUM FROM (SELECT * FROM PRODUCT ORDER BY $sort) A WHERE ROWNUM <= $offset+10) WHERE RNUM > $offset";
                                $total_pages_sql = "SELECT COUNT(*) AS NUMROWS FROM PRODUCT";
                            }
                            
                            
                            $result = oci_parse($conn,$total_pages_sql);
                            oci_execute($result);
                            $total_row = oci_fetch_assoc($result);
                            $total_rows = $total_row['NUMROWS'];
                            $total_pages = ceil($total_rows / $no_of_records_per_page);

                            $stid = oci_parse($conn, $qry);
                            oci_execute($stid);
                            ?>
                            <div class="shop-found-selector">
                                <div class="shop-found">
                                    <p>Showing <span><?php if (($offset+10)>$total_rows) {echo $total_rows;} else{echo $offset+10;}?></span> Products of<span> <?php echo $total_rows; ?></span></p>
                                </div>
                                <div class="shop-selector">
                                    <?php 
                                    if (!isset($search)) {
                                    ?>
                                    <div class="dropdown show">
                                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <?php
                                                if (isset($sort) && $sort=="PRODUCT_SHOP_ID") {
                                                    echo "Sorted by Shop";
                                                }
                                                else if (isset($sort) && $sort=="CATEGORYID") {
                                                    echo "Sorted by Category";
                                                }
                                                else if (isset($sort) && $sort=="PRODUCTPRICE") {
                                                    echo "Sorted by Price";
                                                }
                                                else if (isset($sort) && $sort=="PRODUCTNAME") {
                                                    echo "Sorted By Name";
                                                }
                                                else if (isset($sort) && $sort=="PRODUCTSTOCK") {
                                                    echo "Sorted by Stock";
                                                }
                                                else{
                                                    echo "Sort By";
                                                }
                                            ?>    
                                            
                                        </a>
                                        
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item" href="?sorttype=PRODUCT_SHOP_ID">Shop</a>
                                            <a class="dropdown-item" href="?sorttype=CATEGORYID">Category</a>
                                            <a class="dropdown-item" href="?sorttype=PRODUCTPRICE">Price</a>
                                            <a class="dropdown-item" href="?sorttype=PRODUCTNAME">Alphabetically</a>
                                            <a class="dropdown-item" href="?cate&sorttype=PRODUCTSTOCK">In Stock</a>
                                        </div>
                                        
                                    </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                                
                            </div>
                            <?php
                            if(isset($_GET['query'])){
                                echo "Showing Results for ".$_GET['query'];
                            }
                            ?>
                        </div>
                        <!--add product in here-->
                        <div id="grid-sidebar12" class="tab-pane fade active show">
                            <div class="row">
                            <?php
                            while (($row = oci_fetch_assoc($stid)) != false) {
                            ?>
                                <div class="col-md-12 col-xl-6">
                                    <div class="product-wrapper mb-30 single-product-list product-list-right-pr mb-60">
                                        <div class="product-img list-img-width"> 
                                            <a href="product-details.php?id=<?php echo $row['PRODUCTID'];?>">
                                                <img src="<?php echo $row['PRODUCTIMAGE']?>" alt="">
                                            </a>
                                            <span>
                                                <?php 
                                                    if($row['PRODUCTSTOCK']<$row['MINIMUMORDER']){
                                                        echo"Out of Stock";
                                                    }
                                                    else{
                                                        echo"In Stock";
                                                    }        
                                                ?>
                                            </span>
                                        </div>
                                        <div class="product-content-list">
                                            <div class="product-list-info">
                                                <h4><a href="product-details.php?id=<?php echo $row['PRODUCTID'];?>"><?php echo $row['PRODUCTNAME']; ?></a></h4>
                                                <?php
                                                    if(isset($row['PRODUCT_DISCOUNT_PERCENT'])){
                                                        echo '<span>'.$row['PRODUCT_DISCOUNT_PERCENT'].'% Discount </span>';
                                                    }
                                                ?>
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
                                                <p><?php echo $row['PRODUCTDESCRIPTION']?></p>
                                                <p><?php echo $row['PRODUCTSTOCK']?> item(s) in stock</p>
                                            </div>
                                            <div class="product-list-cart-wishlist">
                                                <div class="product-list-cart">
                                                    <a class="btn-hover list-btn-style" href="additemstocart.php?id=<?php echo $row['PRODUCTID'];?>">add to cart</a>
                                                </div>
                                                <div class="product-list-wishlist">
                                                    <a class="btn-hover list-btn-wishlist" href="#">
                                                        <i class="pe-7s-like"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                }
                                oci_free_statement($stid);
                                ?>
                            </div>
                            <div class="pagination-style mt-10 text-center">
                                <ul>
                                <?php
                                $number = 1;
                                for ($number; $number <= $total_pages; $number +=1) {
                                    if ($pageno == $number) {
                                        echo " <li class=\"active\"><a> $number </a></li> ";
                                    } else {
                                        if (isset($search)) {
                                            echo " <li><a href='?pageno=$number&query=$search'>$number</a></li>";
                                        }
                                        else if (isset($cate)) {
                                            echo " <li><a href='?pageno=$number&sorttype=$sort&categoryset=$cate'>$number</a></li>";
                                        }
                                        else{
                                            echo " <li><a href='?pageno=$number&sorttype=$sort'>$number</a></li>";
                                        }
                                    }
                                }
                                ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php
    include 'includes/footer.php';
?>