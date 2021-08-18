<!DOCTYPE html>
<head>
    <!-- Add meta tags for mobile and IE -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
</head>
<body>
    <!--adding header-->
    <?php
        session_start();
        include 'includes/header.php';
        include 'includes/connect.php';
        if(isset($_SESSION["USER_ID"])){
            $custid = $_SESSION["USER_ID"];
        }
        else{
            echo '<script>window.location="login.php"</script>';
        }
        $total = 0;
    ?>
 
    <!-- shopping-cart-area start -->
    <div class="cart-main-area pt-95 pb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <h1 class="cart-heading">Cart</h1>
                        <form action="#">
                            
                            <div class="table-content table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>remove</th>
                                            <th>images</th>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>sub Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $query = "SELECT * FROM CART WHERE CUSTOMERID = $custid";
                                            $stid = oci_parse($conn, $query);
                                            oci_execute($stid);
                                            while (($row = oci_fetch_assoc($stid)) != false) {
                                                $pid = $row['PRODUCTID'];
                                                $innerquery = "SELECT PRODUCTNAME, PRODUCTPRICE, PRODUCTIMAGE, PRODUCT_DISCOUNT_PERCENT FROM PRODUCT WHERE PRODUCTID=$pid";
                                                $staging = oci_parse($conn, $innerquery);
                                                oci_execute($staging);
                                                while (($rows = oci_fetch_assoc($staging)) != false) {
                                                    $quantity = $row['QUANTITY'];
                                                    if (isset($rows['PRODUCT_DISCOUNT_PERCENT']) && $rows['PRODUCT_DISCOUNT_PERCENT']!='') {
                                                        $price = $rows['PRODUCTPRICE']-($rows['PRODUCT_DISCOUNT_PERCENT']/100)*$rows['PRODUCTPRICE'];
                                                    }
                                                    else{
                                                        $price = $rows['PRODUCTPRICE'];
                                                    }
                                                    $subtotal = $price*$quantity;
                                                    $total = $total+$subtotal;
                                        ?>
                                        <tr>
                                            <td class="product-remove"></a>
                                            <form action="remove.php" method="POST">
                                                <a href="removeitemfromcart.php?id=<?php echo $row['PRODUCTID'];?>"><i class="pe-7s-close"></i>
                                            </form>
                                            </td>
                                            <td class="product-thumbnail">
                                                <img src="<?php echo $rows['PRODUCTIMAGE']?>" width="150px" alt="">
                                            </td>
                                            <td class="product-name"><a href="product-details.php?id=<?php echo $row['PRODUCTID'];?>"><?php echo $rows['PRODUCTNAME']?></a></td>
                                            <td class="product-price-cart"><span class="amount">&pound;<?php echo $price?></span></td>
                                            <td class="product-price-cart"><span class="amount"><?php echo $quantity?></span></td>
                                            <td class="product-subtotal">&pound;<?php echo $subtotal ?></td>
                                        </tr>
                                        <?php
                                                }
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-5 ml-auto">
                                    <div class="cart-page-total">
                                        <h2>Cart totals</h2>
                                        <ul>
                                            <li>Total<span>&pound;<?php echo $total ?></span></li>
                                        </ul>
                                        <a href="../eProject/collectionslot.php">Proceed to checkout</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- shopping-cart-area end -->
    <!--adding footer-->
    <?php
        include 'includes/footer.php';
    ?>
</body>
</html>