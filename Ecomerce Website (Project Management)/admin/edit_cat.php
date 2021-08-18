<?php
	session_start();
	if(isset($_SESSION['USER_ID']) && $_SESSION['USER_TYPE'] = "Admin"){
	$USER_ID = $_SESSION['USER_ID'];	
	}else{
		header('location:../login.php');
	}
include '../includes/connect.php';
if(isset($_GET['sid'])){	
	$sid = $_GET['sid'];
	$detail = "SELECT * FROM CATEGORY WHERE CATEGORYID = $sid";
	$detailqry = oci_parse($conn, $detail);
	oci_execute($detailqry);
	while($row = oci_fetch_assoc($detailqry)){
		$txtName = $row['CATEGORYNAME'];
		
	}
}
if(isset($_POST['updateprod'])){
	$error_count=0;
	If(!empty($_POST["pname"])){
	$pname = $_POST["pname"];
		
	}else{
		$error_count++;
	}
	
	
	if ($error_count == 0){
		$detail = "UPDATE CATEGORY SET CATEGORYNAME = '$pname' WHERE CATEGORYID = $sid";
		$detailqry = oci_parse($conn, $detail);		
		oci_execute($detailqry);
		echo "<script>alert('Category have been edited successfully.');window.location.href='category.php';</script>";		
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
       	Update Product Category
      </h1>
      <ol class="breadcrumb">
        <li><a href="../../../index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Update Product Category</li>
      </ol>
    </section>

    <!-- Main content -->
<section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="" enctype="multipart/form-data">
				<div class="box-body">		
				  <div class="form-group has-feedback">
					<label>Title</label>
					<input type="text" required class="form-control" placeholder="Category Name" value="<?php echo $txtName?>" name="pname">
					<span class="form-control-feedback"></span>
				  </div>
				  	  

               </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name="updateprod" class="btn btn-success">Update</button>
              </div>
            </form>
          </div>
      </section>
    <!-- /.content -->
  </div>

  <?php include('includes/footer.php'); ?>


<!-- ./wrapper -->
<?php include('./includes/script.php'); ?>
</body>
</html>
