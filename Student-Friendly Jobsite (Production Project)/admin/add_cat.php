<?php
include 'includes/header.php';
include 'includes/sidebar.php';
include ('../includes/connection.php');
$conn = mysqli_connect("localhost","root");
$detail = mysqli_select_db($conn, 'Students_Jobsite');
if(isset($_POST['submit'])){
	$pname = $_POST["pname"];
	$detail = "INSERT INTO category(categoryname)VALUES('$pname')";
	$detailqry = mysqli_query($conn, $detail);
  echo "<script>alert('Category is added successfully.');window.location.href='category.php';</script>";			
}
?>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
            <div class="page-heading">
                <h1 class="page-title">Add Category</h1>
                <ol class="breadcrumb">
                    <li><a href="../../../index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Add Category</li>
                </ol>
            </div>
            <br>
            <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Category</div>
                        <div class="ibox-tools">
                            <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                        </div>
                    </div>
                    <div class="ibox-body">
                        <form class="form-horizontal" id="form-sample-1" method="post" action="" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text"  placeholder="Category Name" name="pname" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10 ml-sm-auto">
                                    <button class="btn btn-info"  name="submit" type="submit">Add</button>
                                </div>
                            </div>
                        </form>
                    </div>
            </div>
</div>
<?php include('includes/footer.php'); ?>

