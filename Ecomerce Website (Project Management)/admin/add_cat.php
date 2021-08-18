<?php
session_start();
if(isset($_SESSION['USER_ID']) && $_SESSION['USER_TYPE'] = "Admin"){
	$USER_ID = $_SESSION['USER_ID'];	
}else{
	header('location:../login.php');
}
include '../includes/connect.php';
if(isset($_POST['submit'])){
	$pname = $_POST["pname"];
	
  $detail = "INSERT INTO CATEGORY VALUES(seq_CATEGORY.nextval,'$pname')";
  echo $detail;
	$detailqry = oci_parse($conn, $detail);		
	oci_execute($detailqry);
	echo "<script>alert('Category is added successfully.');window.location.href='category.php';</script>";			
}
?>
<?php include('../includes/backend/head.php');?>
 
  <aside class="main-sidebar">
   
    <?php include('./includes/nav.php'); ?>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       	Add Category
      </h1>
      <ol class="breadcrumb">
        <li><a href="../../../index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add Category</li>
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
					             <input type="text" required class="form-control" placeholder="Category Name" name="pname">
					            <span class="form-control-feedback"></span>
				        </div>
				 	  

               </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name="submit" class="btn btn-success">Add</button>
              </div>
            </form>
          </div>
      </section>
    <!-- /.content -->
  </div>
   <!-- /.content-wrapper -->
  <?php include('includes/footer.php'); ?>



<!-- ./wrapper -->
<?php include('./includes/script.php'); ?>
</body>
</html>
