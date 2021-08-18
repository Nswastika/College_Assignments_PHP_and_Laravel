<?php

  include 'includes/header.php';
  include 'includes/sidebar.php';
  include ('../includes/connection.php');
  $conn = mysqli_connect("localhost","root");
  $detail = mysqli_select_db($conn, 'Students_Jobsite');
if(isset($_GET['sid'])){	
	$sid = $_GET['sid'];
	$detail = "SELECT * FROM category WHERE category_id = $sid";
	$detailqry = mysqli_query($conn, $detail);
	while($row = mysqli_fetch_assoc($detailqry)){
		$txtName = $row['categoryname'];
		
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
		$detail = "UPDATE category SET categoryname = '$pname' WHERE category_id = $sid";
		$detailqry = mysqli_query($conn, $detail);	
    echo "<script>alert('Category is edited successfully.');window.location.href='category.php';</script>";		
		
	}		
}
?>

 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
            <div class="page-heading">
                <h1 class="page-title">Edit Category</h1>
                <ol class="breadcrumb">
                    <li><a href="../../../index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Edit Category</li>
                </ol>
            </div>
            <br/>
            <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Edit Category Title</div>
                        <div class="ibox-tools">
                            <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                        </div>
                    </div>
                    <div class="ibox-body">
                        <form class="form-horizontal" id="form-sample-1" method="post" action="" enctype="multipart/form-data" novalidate="novalidate">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" required class="form-control" placeholder="Category Name" value="<?php echo $txtName?>" name="pname" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10 ml-sm-auto">
                                    <button type="submit" name="updateprod" class="btn btn-info" type="submit">Submit</button>
                                </div>
                            </div>
    
                        </form>
                    </div>
                </div>
  <?php include('includes/footer.php'); ?>

