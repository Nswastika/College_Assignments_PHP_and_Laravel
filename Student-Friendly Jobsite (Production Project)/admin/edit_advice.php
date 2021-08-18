<?php

  include 'includes/header.php';
  include 'includes/sidebar.php';
  include ('../includes/connection.php');
  include ('imageupload.php');
  $conn = mysqli_connect("localhost","root");
  $detail = mysqli_select_db($conn, 'Students_Jobsite');
  if(isset($_GET['sid'])){	
    $error_count=0;
	$sid = $_GET['sid'];
	$detail = "SELECT * FROM advice WHERE advice_id = $sid";
	$detailqry = mysqli_query($conn, $detail);
	while($row = mysqli_fetch_assoc($detailqry)){
    $pimagePath = $row['advisor_image'];
    $aname = $row['advisor_name'];
    $dname = $row['advice_description'];	
	}
}

if(isset($_POST['updateprod'])){
    $aname = $_POST["aname"];
    $dname = $_POST["dname"];
    $advisor_image = $_FILES['advisor_image']["name"];
    $maxsize = 2097152;
    $img_haystack = array('jpg', 'jpeg', 'png');
    $image_filter = array('images/jpeg', 'images/jpg', 'images/png');
    if (!empty($advisor_image)) {
		$target_dir = "../images/";
		$target_file = $target_dir . basename($_FILES["advisor_image"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
		if (!in_array($imageFileType, $img_haystack)) {
			$errors['invalid_img'] = "Invalid file type. Only JPG and PNG types are accepted.";
		} else {
			$flag = 1;
		}
		if ($flag) {
			$imgSize = $_FILES["advisor_image"]["size"];
			if ($imgSize > $maxsize) {
				$errors['max'] = 'File you\'re trying to upload is too large. File must be less than 2 megabytes.';
			}
		}
		$check = getimagesize($_FILES["advisor_image"]["tmp_name"]);
		if ($check !== false) {
			$uploadOk = 1;
			$imgPath = $target_dir . uniqid() . '.' . $imageFileType;
			if (move_uploaded_file($_FILES["advisor_image"]["tmp_name"], $imgPath)) {
			} else {
				$errors['fail'] = "Sorry, there was an error uploading your file.";
			}
		}		
		$imgPath = substr($imgPath,3,strlen($imgPath)-3);
	}else{
		$imgPath = $pimagePath;
	}


	$sql = mysqli_select_db($conn, 'Students_Jobsite');
    if ($error_count == 0){
		$sql = "UPDATE advice SET advisor_name = '$aname', advisor_image = '$imgPath', advice_description = '$dname' WHERE advice_id = $sid";
		$result = mysqli_query($conn, $sql);	
    echo "<script>alert('Advice is edited successfully.');window.location.href='advice.php';</script>";				
}
}
?>
<div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="page-heading">
                <h1 class="page-title">Edit Advice</h1>
                <ol class="breadcrumb">
                    <li><a href="../../../index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Edit Advice</li>
                </ol>
            </div>
            <br>
            <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Edit Advice </div>
                        <div class="ibox-tools">
                            <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                        </div>
                    </div>
                   
                    <div class="ibox-body">
                        <form class="form-horizontal" id="form-sample-1" method="post" action="" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" required class="form-control" placeholder="Advisor Name" value="<?php echo $aname?>" name="aname"><br/>
                                </div>
                                <label class="col-sm-2 col-form-label">Image</label>
                                <div class="col-sm-10">
                                    <input type="file"  name="advisor_image"><br/><br/>                  
                                </div>
                                <label class="col-sm-2 col-form-label">Advice</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Advice Description" value="<?php echo $dname?>" name="dname"><br/>
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

