<?php
include ('includes/header.php');
include ('includes/sidebar.php');
include ('../includes/connection.php');
error_reporting(0);
include ('imageupload.php');
$conn = mysqli_connect("localhost","root");
$detail = mysqli_select_db($conn, 'Students_Jobsite');
if(isset($_POST['submit'])){
  unset($_POST['submit']);
	  $aname = $_POST["aname"];
    $advisor_image = $_FILES['advisor_image']["name"];
    $dname = $_POST["dname"];
    $maxsize = 2097152;
    $img_haystack = array('jpg', 'jpeg', 'png');
    $image_filter = array('images/jpeg', 'images/jpg', 'images/png');
    if (!empty($advisor_image)) {
		$target_dir = "../images/";
		$target_file = $target_dir . basename($_FILES["advisor_image"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
		if (!in_array($imageFileType, $img_haystack)) {
			$errors['invalid_img'] = "<script>alert('Invalid file type. Only JPG and PNG types are accepted.');window.location.href='advice.php';</script>";
		} else {
			$flag = 1;
		}
		if ($flag) {
			$imgSize = $_FILES["advisor_image"]["size"];
			if ($imgSize > $maxsize) {
				$errors['max'] = "<script>alert('File you\'re trying to upload is too large. File must be less than 2 megabytes.');window.location.href='advice.php';</script>";
			}
		}
		$check = getimagesize($_FILES["advisor_image"]["tmp_name"]);
		if ($check !== false) {
			$uploadOk = 1;
			$imgPath = $target_dir . uniqid() . '.' . $imageFileType;
			if (move_uploaded_file($_FILES["advisor_image"]["tmp_name"], $imgPath)) {
			} else {
				$errors['fail'] = "<script>alert('Sorry, there was an error uploading your file.');window.location.href='advice.php';</script>";
			}
		}		
		$imgPath = substr($imgPath,3,strlen($imgPath)-3);
	}else{
		$imgPath = "";
	}
    $detail = "INSERT INTO advice(advisor_name, advisor_image, advice_description)VALUES('$aname','$imgPath','$dname')";
  echo $detail;
	$detailqry = mysqli_query($conn, $detail);
  echo "<script>alert('Advice is added successfully.');window.location.href='advice.php';</script>";			
        
}
?>
  <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
              <div class="page-heading">
                <h1 class="page-title">Add Advice</h1>
                <ol class="breadcrumb">
                    <li><a href="../../../index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Add Advice</li>
                </ol>
              </div>
              <br>
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Advice</div>
                        <div class="ibox-tools">
                            <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                        </div>
                    </div>
                    <div class="ibox-body">
                        <form class="form-horizontal" id="form-sample-1" method="post" action="" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" required class="form-control" placeholder="Advisor Name" name="aname" required><br/>
                                </div>
                                    <label class="col-sm-2 col-form-label">Image</label>
                                <div class="col-sm-10">
                                    <input type="file" name="advisor_image" required><br/><br/>
                                </div>
                                <label class="col-sm-2 col-form-label">Advice</label>
                                <div class="col-sm-10">
                                    <textarea type="text" required class="form-control" placeholder="Advice Description" name="dname" required></textarea><br/>  
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
    <!-- /.content -->
  </div>
   <!-- /.content-wrapper -->
  <?php include('includes/footer.php'); ?>

