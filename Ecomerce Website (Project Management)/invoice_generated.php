<?php
ob_start();
include 'includes/connect.php';
//error_reporting(0);
 
session_start();
if(isset($_SESSION['USER_ID'])){
	$USER_ID = $_SESSION['USER_ID'];	
}else{
	header('location:../eProject/login.php');
}
date_default_timezone_set('Asia/Kathmandu');
$date = date('Y/m/d');
$invoice = mt_rand();
$select_customer ="SELECT * FROM USERS WHERE USER_ID ='$USER_ID'";
$run_customer =oci_parse($conn, $select_customer);
oci_execute($run_customer);
$row_customer =oci_fetch_array($run_customer);
$customer_id =$row_customer['USER_ID'];
$email = $row_customer['USER_EMAIL'];
$user_first_name = $row_customer['USER_FIRST_NAME'];
$user_last_name = $row_customer['USER_LAST_NAME'];


$totalprice = 0;
?>



<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Invoice Generated</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="assets/paypal/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/paypal/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="assets/paypal/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="assets/dist/css/skins/_all-skins.min.css">


  <!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">


  <!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Invoice
        <small><?php echo $invoice?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i></a></li>
        <li class="active">Invoice</li>
      </ol>
    </section>

    <div class="pad margin no-print">
      <div class="callout callout-info" style="margin-bottom: 0!important;">
        <h4><i class="fa fa-info"></i> Note:</h4>
       <strong> This Page Has Been Enhanced For Printing Cleckhuddersfax Invoice. </strong> <b>Go Green! Do Not Print Unless Required.</b>
      </div>
    </div>

    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <img src="image/logo/logo.png">
            <small class="pull-right">Date: <?php echo $date?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <!-- /.col -->
        <div class="col-sm-4 invoice-col col-md-offset-0.2">
          <b>Invoice #<?php echo $invoice?></b><br>
          <b>Account:</b> <?php echo $email?><br>
          <b>Name:</b> <?php echo $user_first_name . ' ' . $user_last_name?><br>
		  <?php
			date_default_timezone_set('Asia/Kathmandu');											
			$date = date('Y-m-d');
			$day = date('l', strtotime($date));
			$day = strtoupper($day);
			$hour = date('H');
			$min = date('i');											
			$timeslot = "";
			if($day=="FRIDAY" OR $day=="SATURDAY" OR $day=="SUNDAY" OR $day=="MONDAY"){
				$date = date('Y-m-d', strtotime("next wednesday"));
				$timeslot = "10AM-1PM";
			}else{								
				
				if($day=="TUESDAY" AND $hour<=19){
					if($hour==19 AND $min!=0){
						$date = date('Y-m-d', strtotime($date. ' +2 days'));														
						$timeslot = "10AM-1PM";														
					}else{
						$date = date('Y-m-d', strtotime($date. ' +1 days'));
						$timeslot = getTimeSlot($hour,$min);
						if($timeslot==""){
							$date = date('Y-m-d', strtotime($date. ' +1 days'));
							$timeslot = "10AM-1PM";
						}
					}
				}else{
					if($day=="TUESDAY" AND $hour>19){
						$date = date('Y-m-d', strtotime($date. ' +2 days'));													
						$timeslot = "10AM-1PM";
					}
				}
				if($day=="WEDNESDAY" AND $hour<=19){
					if($hour==19 AND $min!=0){														
						$date = date('Y-m-d', strtotime($date. ' +2 days'));														
						$timeslot = "10AM-1PM";														
					}else{
						$date = date('Y-m-d', strtotime($date. ' +1 days'));
						$timeslot = getTimeSlot($hour,$min);
						if($timeslot==""){
							$date = date('Y-m-d', strtotime($date. ' +1 days'));
							$timeslot = "10AM-1PM";
						}
					}
				}else{
					if($day=="WEDNESDAY" AND $hour>19){
						$date = date('Y-m-d', strtotime($date. ' +2 days'));													
						$timeslot = "10AM-1PM";
					}
				}
				if($day=="THURSDAY" AND $hour<=19){
					
					if($hour==19 AND $min!=0){
						$date = date('Y-m-d', strtotime('next wednesday', strtotime($date)));
						$timeslot = "10AM-1PM";													
					}else{
						
						$timeslot = getTimeSlot($hour,$min);
						if($timeslot==""){															
							$date = date('Y-m-d', strtotime('next wednesday', strtotime($date)));															
							$timeslot = "10AM-1PM";
						}else{															
							$date = date('Y-m-d', strtotime($date. ' +1 days'));
						}
					}
				}else{
					if($day=="THURSDAY" AND $hour>19){
						$date = date('Y-m-d', strtotime('next wednesday', strtotime($date)));													
						$timeslot = "10AM-1PM";
					}
				}									
				
				
			}											
			function getTimeSlot($hour,$min){
				$timeslot = "";												
				if($hour<=13){
					if($hour==13 AND $min!=0){
						$timeslot = "1PM-4PM";
						
						
					}else{
						$timeslot = "10AM-1PM";
						
					}
				}else if($hour>=13 AND $hour<=16){
					if($hour==16 AND $min!=0){
						$timeslot = "4PM-7PM";
						
					}else{														
						$timeslot = "1PM-4PM";
						
					}
				}else if($hour>=16 AND $hour<=19){
					if($hour==19 AND $min!=0){
						$timeslot = "";
						
					}else{
						$timeslot = "4PM-7PM";
						
					}
				}else{}												
				return $timeslot;
			}
		?>

 <b>Pickup Day : </b><br><font size="5"><?php $cal_day = strtotime($date); $day = date('l', $cal_day); print($day)?></font>
 <br>
 <b>Pickup Available After : </b><br><font size="5"><?php echo $date . ' ' . $timeslot;?></font>
          
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <br>
          <table class="table table-striped">
            <thead>
            <tr>
              <th>Quantity</th>
              <th>Name</th>
              <th>Discount</th>
              
              <th>Price</th>
            </tr>
            </thead>
            <tbody>
            <?php
				
				$sql = "SELECT * FROM cart WHERE CUSTOMERID = '$USER_ID'";
				$query = oci_parse($conn, $sql);
				oci_execute($query);
				while ($row = oci_fetch_assoc($query)) {
				?>

            <tr>
				<?php
					$pid = $row['PRODUCTID'];
					$sql1 = "SELECT * FROM PRODUCT WHERE PRODUCTID = '$pid'";
					$result = oci_parse($conn, $sql1);
					oci_execute($result);
					$row2 = oci_fetch_array($result);
					//TODO
					$total = $row['PRODUCTPRICE'] * $row['QUANTITY'];
					$totalafterdis = $total - 0; //(($row2['PRODUCT_DISCOUNT_PERCENT']/100)*$total);
					$totalprice = $totalafterdis + $totalprice;
				?>
              <td><?php echo $row['QUANTITY'];?></td>
              <td><?php echo $row2['PRODUCTNAME'];?></td>
              <td><?php if($row2['PRODUCT_DISCOUNT_PERCENT']==""){echo '0'.'%';}else{echo $row2['PRODUCT_DISCOUNT_PERCENT'].'%';}?></td>
              
              <td><?php echo '£'.$totalafterdis;?></td>
            </tr>
            <?php } ?>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- /.col -->
        <div class="col-xs-6 col-md-offset-6">
          
          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Subtotal:</th>
                <td><?php echo '£'.$totalprice?></td>
              </tr>
              
              <tr>
                <th>Total:</th>
                <td><?php echo '£'.$totalprice?></td>
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      
      <?php
		$get_cart ="SELECT * FROM CART WHERE CUSTOMERID='$USER_ID'";
		$run_cart=oci_parse($conn	, $get_cart);
		oci_execute($run_cart);
		
		$getslot="SELECT * FROM COLLECTION_SLOT WHERE USER_ID='$USER_ID'";
		$runslot=oci_parse($conn, $getslot);
		oci_execute($runslot);
		$slotdata =oci_fetch_array($runslot);
		$collectionslotid = $slotdata['COLLECTION_SLOT_ID'];
		
		while ( $row_cart =oci_fetch_array($run_cart)) {
            
			$pro_id =$row_cart['PRODUCTID'];
			$get_products="SELECT * FROM PRODUCT WHERE PRODUCTID='$pro_id'";
			$run_products=oci_parse($conn, $get_products);
			oci_execute($run_products);
			$row_products =oci_fetch_array($run_products);
			$trader_id =$row_products['TRADER_ID'];
			$product_name =$row_products['PRODUCTNAME'];
			$product_shop =$row_products['PRODUCT_SHOP_ID'];
			$PRODUCT_PRICE =$row_products['PRODUCTPRICE'];
			$PRODUCT_DISCOUNT_PERCENT =$row_products['PRODUCT_DISCOUNT_PERCENT'];
		   	
			if (isset($row_products['PRODUCT_DISCOUNT_PERCENT']) && $row_products['PRODUCT_DISCOUNT_PERCENT']!='') {
				$total = ($row_products['PRODUCTPRICE']-($row_products['PRODUCT_DISCOUNT_PERCENT']/100)*$row_products['PRODUCTPRICE'])*$row_cart['QUANTITY'];
			}
			else{
				$total = $PRODUCT_PRICE*$row_cart['QUANTITY']; 
			}
			$paymentsql = "INSERT INTO PAYMENT(PAYMENT_ID, INVOICE_ID, USER_EMAIL,PRODUCTID, PRICE, PAYMENT_DATE, TRADER_ID) VALUES (SEQ_PAY.nextval, $invoice, '$email', $pro_id, $total, sysdate, '$trader_id')";
			$result = oci_parse($conn, $paymentsql);
			oci_execute($result);
			
			$orderquantity = $row_cart['QUANTITY'];
			$ordersql = oci_parse($conn, "INSERT INTO ORDERS(ORDERID, ORDERDATE, TRADER_ID, COLLECTION_SLOT_ID, PRODUCTID, PRODUCTNAME, QUANTITY) VALUES (SEQ_ORDER.nextval, sysdate, '$trader_id', $collectionslotid, $pro_id, '$product_name', '$orderquantity')");
			oci_execute($ordersql);

			$quantity = $row_products['PRODUCTSTOCK'] - $row_cart['QUANTITY'];			
			$qtysql = "UPDATE PRODUCT SET PRODUCTSTOCK =$quantity WHERE PRODUCTID=$pro_id"; 
			$qtyresult = oci_parse($conn, $qtysql);
			oci_execute($qtyresult);
			}
		file_put_contents('invoice.html', ob_get_clean());  


	  ?>

	  	<script type="text/javascript">window.location.href="invoice_download.php";</script>

	  
<?php
	$deletesql = "DELETE FROM CART WHERE CUSTOMERID = '$USER_ID'";
	$delresult = oci_parse($conn, $deletesql);
	oci_execute($delresult);
?>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="assets/dist/js/demo.js"></script>
</body>
</html>
