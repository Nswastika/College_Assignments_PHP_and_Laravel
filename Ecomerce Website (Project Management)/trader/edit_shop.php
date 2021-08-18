<?php
	session_start();
	if(isset($_SESSION['USER_ID']) && $_SESSION['USER_TYPE'] = "Trader"){
	$USER_ID = $_SESSION['USER_ID'];	
	}else{
		header('location:../login.php');
	}
include '../includes/connect.php';
if(isset($_GET['mid'])){	
	$mid = $_GET['mid'];
	$detail = "SELECT * FROM SHOP WHERE SHOP_ID = $mid";
	$detailqry = oci_parse($conn, $detail);
	oci_execute($detailqry);
	while($row = oci_fetch_assoc($detailqry)){
		$sname = $row['NAME'];
    $phone = $row['PHONE_NO_1'];
		
	}
}
if(isset($_POST['updateshop'])){
  $error_count=0;
  If(!empty($_POST["sname"])){
  $pname = $_POST["sname"];
  $phone = $_POST['phone'];
    
  }else{
    $error_count++;
  }
  
	
	if ($error_count == 0){
		$detail = "UPDATE SHOP SET NAME = '$sname', PHONE_NO_1 = '$phone' WHERE SHOP_ID = '$mid'";
		$detailqry = oci_parse($conn, $detail);		
		oci_execute($detailqry);
		echo "<script>alert('You have sucessfully Edited a Shop.');window.location.href='shop.php';</script>";		
	}		
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
       	Update Shop
      </h1>
      <ol class="breadcrumb">
        <li><a href="../../../index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Update Shop</li>
      </ol>
    </section>

    <!-- Main content -->
<section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-8">
          <!-- general form elements -->
          <div class="box box-primary">
            
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="" enctype="multipart/form-data">
				<div class="box-body">		
				  <div class="form-group has-feedback">
					<label>Shop Name</label>
					<input type="text" required class="form-control" placeholder="SHOP Name" value="<?php echo $sname?>" name="sname">
					<span class="form-control-feedback"></span>
          <label>Phone No</label>
          <input type="text" required class="form-control" placeholder="Phone Number" value="<?php echo $phone?>" name="phone">
          <span class="form-control-feedback"></span>
				  </div>
				  	  

               </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name="updateshop" class="btn btn-success">Update Shop</button>
              </div>
            </form>
          </div>
      </section>
    <!-- /.content -->
  </div>

   <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      All rights reserved.
    </div>
    <strong>Copyright &copy; 2020 <a href="">Cleckhuddersfax E-Convenient Store</a>.</strong> 
  </footer>  


<!-- ./wrapper -->
<?php include('./includes/script.php'); ?>
</body>
</html>
