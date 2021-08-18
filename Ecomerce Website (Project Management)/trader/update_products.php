 <?php
	session_start();
	if(isset($_SESSION['USER_ID']) && $_SESSION['USER_TYPE'] = "Trader"){
		$USER_ID = $_SESSION['USER_ID'];	
	}else{
		header('location:../login.php');
	}
	include ('imageupload.php');
	include ('../includes/connect.php');
	$trader_id = $USER_ID;
	
	if(isset($_GET['id'])){
    	$eid = $_GET['id'];
		$details = "DELETE FROM product WHERE productid = '$eid'";
   		$detailqry = oci_parse($conn, $details);
		oci_execute($detailqry); 
		header("location:update_products.php");	
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
        Products
      </h1>
      <ol class="breadcrumb">
        <li><a href="../../index.php"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Products</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">        
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

        <div class="col-md-8">
		 
			
          <!-- Profile Image -->
          <div class="box box-primary">
             <div class="box-body">
            
      <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Product Image</th>
                <th>Name</th>                  
                  <th>Action</th>
                  </tr>
                </thead>
                <tbody>
             
  <tr>
    <td>
              <img style="height:120px; width:100px;" class="img-responsive" src="<?php echo $url;?>" alt="No Image Found"></td>
              <td><?php echo $row['PRODUCTNAME'];?></td>
           
            <td>
              
              <?php echo "<a class='btn btn-primary btn-warning' href='alter_products.php?id=".$id."'"?><b>Update <i class="fa fa-pencil"></i></b></a>
              <?php echo "<a class='btn btn-primary btn-danger' href='?id=".$id."'"?><b>Delete <i class="fa fa-trash"></i></b></a>
</td>
  </tr>
      
          
                </tbody>
                
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
	</div>
        <?php } ?>
	<?php } ?>
    </div>
    </section>
  </div>
   <!-- /.content-wrapper -->
  <?php include('includes/footer.php'); ?>


<!-- ./wrapper -->
<?php include('./includes/script.php'); ?>
</body>
</html>
