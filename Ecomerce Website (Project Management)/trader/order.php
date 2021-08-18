<?php
	session_start();
	if(isset($_SESSION['USER_ID']) && $_SESSION['USER_TYPE'] = "Trader"){
	$USER_ID = $_SESSION['USER_ID'];	
	}else{
		header('location:../login.php');
	}
include ('../includes/connect.php');
?>
<?php include('../includes/backend/head.php');?>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <?php include('./includes/nav.php'); ?>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">      
 <section class="content-header">
      <h1>
       	Orders
      </h1>
      <ol class="breadcrumb">
        <li><a href="../../../index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Orders</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>                  
				  <th>Invoice Id</th>
				  <th>Product Name</th>
				  <th>Payment Date</th>
				  <th>Collection Date</th>
				  <th>Collection Time</th>
				  <th>Quantity</th>
				 <!--  <th>Delivery Date</th>
				  <th>Delivery Time</th> -->
				  <th>Status</th>
				  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                	
					<?php

					$details = "SELECT ORDERS.ORDERID, ORDERS.PRODUCTNAME, ORDERS.IS_DELIVERED, ORDERS.ORDERDATE, COLLECTION_SLOT.DAY, COLLECTION_SLOT.SLOT, PRODUCTNAME, QUANTITY 
					FROM ORDERS, COLLECTION_SLOT
					WHERE COLLECTION_SLOT.COLLECTION_SLOT_ID = ORDERS.COLLECTION_SLOT_ID
					AND ORDERS.TRADER_ID ='$USER_ID'";
					$detailqrys = oci_parse($conn, $details);
					oci_execute($detailqrys);
					while($rows = oci_fetch_array($detailqrys)){
					?>
						<tr>
						  <td><?php echo $rows['ORDERID'];?></td>	
						  <td><?php echo $rows['PRODUCTNAME'];?></td>				  
						  <td><?php echo $rows['ORDERDATE'];?></td>
						  <td><?php echo $rows['DAY'];?></td>
						  <td><?php echo $rows['SLOT'];?></td>
						  <td><?php echo $rows['QUANTITY'];?></td>
						  <!-- <td><?php echo $rows[''];?></td>
						  <td><?php echo $rows[''];?></td> -->
						  
						
						
						<?php
									if($rows['IS_DELIVERED']==1){
										//echo '<td bgcolor="#8ed100">';
										echo '<td>';
										echo "<font color='#8ed100'><b>DELIVERED</b></font>";
										$buttonText = "NOT DELIVERED";
									}else{
										echo '<td>';
										echo "<font color='#750000'><b>NOT DELIVERED</b></font>";
										$buttonText = "DELIVERED";
									}
									echo "</td>";
								?>	
							<td class="text-center">							
								<a class="btn btn-danger" href="order_action.php?sid=<?php echo $rows['ORDERID']; ?>"><b><?php echo $buttonText; ?></b>
								   
								</a>							
								
							</td>
						</tr>
				<?php }?>
					
                </tbody>
                
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

         
          <!-- /.box -->


        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
<?php include('includes/footer.php'); ?>
<!-- ./wrapper -->
<?php include('./includes/script.php'); ?>
</body>
</html>

