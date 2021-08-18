<?php
session_start();
if(isset($_SESSION['USER_ID']) && $_SESSION['USER_TYPE'] = "Trader"){
	$USER_ID = $_SESSION['USER_ID'];	
}else{
	header('location:../login.php');
}
include ('../includes/connect.php');
include ('imageupload.php');
$trader_id = $USER_ID;
?>

<?php
  if(isset($_GET['id'])){
      $eid = $_GET['id'];
    $details = "DELETE FROM product WHERE productid = '$eid'";
      $detailqry = oci_parse($conn, $details);
    oci_execute($detailqry); 
    header("location:products.php"); 
  }
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
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Products List
       
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Products List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="panel-heading">
      <h3 class="page-header p-b-md m-b-sm">
        <br>
        
        <span class="pull-left">
          
          <form method="get" action="add_products.php">
            <button type="submit" name="submit" class="btn btn-info btn-block btn-flat">New <i class="fa fa-plus"></i> </button>
          <form>
        </span>
      </h3>
    </div>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
           
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <!-- <th>Trader ID</th> -->
                  <th>Product ID</th>
                  <th>Product Name</th>
                   <th>Product Image</th>
                  <th>Product Description</th>
                  <th>Minimum Order</th>                  
                  <th>Maximum Order</th>
                  <th>Allergy Information</th>
                  <th>Discount Percent</th>
                  <th>Product Price</th>
                  <th>Product Stock</th>
                  <th>Product Quantity</th>
                  <th>Tools</th>
                                  
                </tr>
                </thead>
                <tbody>
                	<?php
						$detail1="SELECT * FROM SHOP WHERE TRADER_ID=$trader_id";
						$detailqry1 = oci_parse($conn, $detail1);
						oci_execute($detailqry1);
                    	while($row1 = oci_fetch_array($detailqry1)){
							$SHOP_ID = $row1['SHOP_ID'];
							?>
							<?php
							$detail="SELECT * FROM PRODUCT WHERE PRODUCT_SHOP_ID=$SHOP_ID";
							$detailqry = oci_parse($conn, $detail);
							oci_execute($detailqry);
							while($row = oci_fetch_array($detailqry)){	
                $url = "../".$row['PRODUCTIMAGE'];	
                $id = $row['PRODUCTID'];						
								?>
							<tr>
                <!-- <td><?php echo $row['TRADER_ID'];?></td> -->
							  <td><?php echo $row['PRODUCTID'];?></td>
							  <td><?php echo $row['PRODUCTNAME'];?></td>
                <!-- <td><a class='btn btn-primary btn-secondary' href='update_products.php'"?><b>View <i class="fa fa-search"></i></b></a></td> -->
                <td><img style="height:120px; width:100px;" class="img-responsive" src="<?php echo $url;?>" alt="No Image Found"></td>
							  <td><?php echo $row['PRODUCTDESCRIPTION'];?></td>
                 <td><?php echo $row['MINIMUMORDER'];?></td>						  
                  <td><?php echo $row['MAXIMUMORDER'];?></td>
                   <td><?php echo $row['ALLERGYINFORMATION'];?></td>
                    <td><?php echo $row['PRODUCT_DISCOUNT_PERCENT'];?></td>
							  <td>&pound;<?php echo $row['PRODUCTPRICE'];?></td>
							  <td><?php echo $row['PRODUCTSTOCK'];?></td>
                <td><?php echo $row['PRODUCTSTOCK'];?></td>			  
							 <td>
              
              <?php echo "<a class='btn btn-primary btn-warning' href='alter_products.php?id=".$id."'"?><b><i class="fa fa-pencil"></i></b></a>
              <p></p>
              <?php echo "<a class='btn btn-primary btn-danger' href='?id=".$id."'"?><b><i class="fa fa-trash"></i></b></a>
              </td>
							</tr>
						<?php }?>
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
