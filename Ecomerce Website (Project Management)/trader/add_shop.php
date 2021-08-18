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
	
	$isUsed = false;
	$txtName = $txtPh1  = $loc = "";
	$isRegistered = 0;
	$sql="SELECT * FROM TRADER WHERE USER_ID='$USER_ID' ";
	$qry = oci_parse($conn, $sql);

if (isset($_POST['addprod'])){	
	
	$txtName = $_POST["txtName"];
    $txtPh1 = $_POST["txtPh1"];
    $loc = $_POST["loc"];

	$error_count = 0;
	$txtCapName = strtoupper($txtName);
	$detail="SELECT * FROM SHOP WHERE UPPER(NAME)='$txtCapName'";
	$detailqry = oci_parse($conn, $detail);
	oci_execute($detailqry);
	while($row = oci_fetch_array($detailqry)){
		$error_count++;
	}
	if($error_count!=0){
		$isUsed = true;
		echo "<script>alert('Shop Name Already Taken. Please Enter New Shop Name');</script>";
	}else{	
		//if there are no errors save it to database
		if ($error_count == 0){
			$sql = "INSERT INTO SHOP (SHOP_ID, TRADER_ID,  NAME,  PHONE_NO_1, LOCATION) VALUES 
			(seq_SHOPS.nextval, '$trader_id','$txtName','$txtPh1', '$loc')";			
			$result = oci_parse($conn,$sql);		
			oci_execute($result);			
			echo "<script>alert('New shop have been added successfully.');window.location.href='shop.php';</script>";
		} 
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
       	Add Shop
      </h1>
      <ol class="breadcrumb">
        <li><a href="../../../index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add Shop</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-8">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Enter Shop details</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="" enctype="multipart/form-data">
				<div class="box-body">					
					
					<br><br>
				
                <div class="form-group">
                  <label for="exampleInputDescription">Shop Name</label>
                  <input type="text" required class="form-control" id="name" placeholder="Name of your shop ..." name="txtName" value = "<?php if($txtName!="" AND $isUsed==false){echo $txtName;}?>">
                </div>
              
               	<div class="form-group">
                  <label for="exampleInputAllergy">Phone 	Number</label>
                  <input type="text" required class="form-control" id="l1" placeholder="Phone Line 1 ..." name="txtPh1" value = "<?php if($txtPh1!=""){echo $txtPh1;}?>">
                </div>

                <div class="form-group">
                  <label for="exampleInputPrice">Shop Location</label>
                  <input type="text" required class="form-control" id="mail" placeholder="Location" name="loc" value = "<?php if($loc!=""){echo $loc;}?>">
                </div>  
                               
               </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name="addprod" class="btn btn-success">Add </button>
              </div>
            </form>
          </div>
      </section>
    <!-- /.content -->
  </div>
   <!-- /.content-wrapper -->
 <?php include('includes/footer.php'); ?>

<!-- ./wrapper -->
<?php include('includes/script.php'); ?>
</body>
</html>
