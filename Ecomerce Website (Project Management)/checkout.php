<!DOCTYPE html>
<head>
    <!-- Add meta tags for mobile and IE -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" href= "https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> 
    <script src= "https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script> 
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>
<body>


<style type="text/css">
 
 .button {
  background-color: #050035;
  border: none;
  color: white;
  padding: 16px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  transition-duration: 0.4s;
  cursor: pointer;
}

.button1 {
  background-color: white; 
  color: black; 
  border: 2px solid #050035;
}

.button1:hover {
  background-color: #050035;
  color: white;
}
    </style>



    <!--adding header-->
    <?php
        session_start();
        include 'includes/header.php';
        include 'includes/connect.php';
        $custid = $_SESSION["USER_ID"];
        $total = 0;
    ?>
 
<!-- checkout-area start -->
    <div class="checkout-area ptb-100">
        <div class="container">
            <div class="row">   
                <div class="col-lg-6 col-md-12 col-12">
                    <div class="your-order">
                        <h3>Your order</h3>
                        <div class="your-order-table table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="product-name">Product</th>
                                        <th class="product-total">Total</th>
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
                                    <tr class="cart_item">
                                        <td class="product-name">
                                        <?php echo $rows['PRODUCTNAME']?> <strong class="product-quantity"> × <?php echo $quantity?></strong>
                                        </td>
                                        <td class="product-total">
                                            <span class="amount">&pound;<?php echo $subtotal ?></span>
                                        </td>
                                    </tr>
                                    <?php
                                            }
                                        }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr class="order-total">
                                        <th>Order Total</th>
                                        <td><strong><span class="amount">&pound;<?php echo $total ?></span></strong>
                                        </td>
                                    </tr>   
                                    <tr>
                                        
                                    </tr>                            
                                </tfoot>
                                
                            </table>
                        </div>
                        <div class="payment-method">
                            <div class="payment-accordion">
                                <style> 
                                    #paypal-button-container { 
                                        display: none; 
                                    } 
                                </style> 
                                <button class="button button1" onclick="GFG_Fun(); this.style.visibility='hidden'";>Place Order</button>
                                <script> 
                                    function show(divId) { 
                                        $("#" + divId).show(); 
                                    }
                                    function GFG_Fun() { 
                                        show('paypal-button-container'); 
                                        $('#GFG_DOWN').text(""); 
                                    } 
                                </script>
                                <!-- Set up a container element for the button -->
                                <div id="paypal-button-container"></div>

                                <!-- Include the PayPal JavaScript SDK -->
                                <script src="https://www.paypal.com/sdk/js?client-id=AcSsDz8gpmhS1RkROXmFDIJc1On_VvnJ90Nz3wIePkaUIlzS_pi2feY-YCjSdKh3fc1ccVlu6IZED3Mj&currency=GBP"></script>
                                <script>
                                    // Render the PayPal button into #paypal-button-container
                                    paypal.Buttons({
                                        // Set up the transaction
                                        createOrder: function(data, actions) {
                                            return actions.order.create({
                                                purchase_units: [{
                                                    amount: {
                                                        value: '<?php echo $total; ?>'
                                                    }
                                                }]
                                            });
                                        },
                                        // Finalize the transaction
                                        onApprove: function(data, actions) {
                                            return actions.order.capture().then(function(details) {
                                                // Show a success message to the buyer
                                                //swal('Transaction completed by ' + details.payer.name.given_name + '!');
                                            location.replace("success.php")                                           
                                        });
                                        }
                                    }).render('#paypal-button-container');
                                </script>
                                </div>                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--adding footer-->
    <?php
        include 'includes/footer.php';
    ?>
</body>
</html>