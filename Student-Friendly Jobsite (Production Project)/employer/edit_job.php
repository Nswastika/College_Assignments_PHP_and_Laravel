<?php include 'includes/header.php'; 
include 'includes/sidebar.php'; 
 include ('../includes/connection.php');
include ('imageupload.php');
  $conn = mysqli_connect("localhost","root");
  $detail = mysqli_select_db($conn, 'Students_Jobsite');
if(isset($_GET['sid'])){	
  $error_count=0;
	$sid = $_GET['sid'];
	$detail = "SELECT * FROM job WHERE job_id = $sid";
	$detailqry = mysqli_query($conn, $detail);
	while($row = mysqli_fetch_assoc($detailqry)){
     
	  $tjname = $row['job_name'];
    $tjlocation = $row['job_location'];
    $tjtime = $row['job_time'];
    $tvac = $row['vacancy'];
    $tcname = $row['company_name'];
    $testatus = $row['emp_status'];
    $tsal = $row['salary'];
    
    $tjdeadline = $row['job_deadline'];
    $tjdescription = $row['job_description'];
    $tres = $row['responsibilities'];
    $tres1 = $row['responsibilities1'];
    $tres2 = $row['responsibilities2'];
    $tres3 = $row['responsibilities3'];
    $tres4 = $row['responsibilities4'];
    $tres5 = $row['responsibilities5'];
    $tedu = $row['education'];
    $tedu1 = $row['education1'];
    $tedu2 = $row['education2'];
    $tedu3 = $row['education3'];
    $tedu4 = $row['education4'];
    $tedu5 = $row['education5'];
    $tben = $row['benefits'];
    $tben1 = $row['benefits1'];
    $tben2 = $row['benefits2'];
    $tben3 = $row['benefits3'];
    $tben4 = $row['benefits4'];
    $tben5 = $row['benefits5'];
  
   $pimagePath = $row['company_image'];

	}
}

if(isset($_POST['updateprod'])){
  $error_count=0;
    
  $jname = $_POST['jname'];
  $jlocation = $_POST['jlocation'];
  $jtime = $_POST['jtime'];
  $vac = $_POST['vac'];
  $cname = $_POST['cname'];
  $estatus = $_POST['estatus'];
  $sal = $_POST['sal'];
  // $gen = $_POST['gen'];
  $jdeadline = $_POST['jdeadline'];
  $jdescription = $_POST['jdescription'];
  $res = $_POST['res'];
  $res1 = $_POST['res1'];
  $res2 = $_POST['res2'];
  $res3 = $_POST['res3'];
  $res4 = $_POST['res4'];
  $res5 = $_POST['res5'];
  
  $edu = $_POST['edu'];
  $edu1 = $_POST['edu1'];
  $edu2 = $_POST['edu2'];
  $edu3 = $_POST['edu3'];
  $edu4 = $_POST['edu4'];
  $edu5 = $_POST['edu5'];
  $ben = $_POST['ben'];
  $ben1 = $_POST['ben1'];
  $ben2 = $_POST['ben2'];
  $ben3 = $_POST['ben3'];
  $ben4 = $_POST['ben4'];
  $ben5 = $_POST['ben5'];
    $company_image = $_FILES['company_image']["name"];
  
	
    $maxsize = 2097152;
    $img_haystack = array('jpg', 'jpeg', 'png');
    $image_filter = array('images/jpeg', 'images/jpg', 'images/png');
    if (!empty($company_image)) {
		$target_dir = "../images/";
		$target_file = $target_dir . basename($_FILES["company_image"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
		if (!in_array($imageFileType, $img_haystack)) {
			$errors['invalid_img'] = "Invalid file type. Only JPG and PNG types are accepted.";
		} else {
			$flag = 1;
		}
		if ($flag) {
			$imgSize = $_FILES["company_image"]["size"];
			if ($imgSize > $maxsize) {
				$errors['max'] = 'File you\'re trying to upload is too large. File must be less than 2 megabytes.';
			}
		}
		$check = getimagesize($_FILES["company_image"]["tmp_name"]);
		if ($check !== false) {
			$uploadOk = 1;
			$imgPath = $target_dir . uniqid() . '.' . $imageFileType;
			if (move_uploaded_file($_FILES["company_image"]["tmp_name"], $imgPath)) {
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

 
		$sql = "UPDATE job SET job_name = '$jname', job_location = '$jlocation', job_time = '$jtime', vacancy = '$vac', company_name = '$cname', emp_status = '$estatus', salary = '$sal', job_deadline = '$jdeadline', job_description = '$jdescription', responsibilities = '$res', responsibilities1 = '$res1', responsibilities2 = '$res2', responsibilities3 = '$res3', responsibilities4 = '$res4', responsibilities5 = '$res5', education = '$edu',  education1 = '$edu1',  education2 = '$edu2',  education3 = '$edu3',  education4 = '$edu4',  education5 = '$edu5', benefits = '$ben', benefits1 = '$ben1', benefits2 = '$ben2', benefits3 = '$ben3', benefits4 = '$ben4', benefits5 = '$ben5', company_image = '$imgPath' WHERE job_id = $sid";
	
  
  
  
    $result = mysqli_query($conn, $sql);	
    echo "<script>alert('Job is edited successfully.');window.location.href='job.php';</script>";		
		
}
}

?>

 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       	<!-- Update Product Category -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="../../../index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Update Product Category</li>
      </ol>
    </section>
    
    <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Edit Advice Title</div>
                        <div class="ibox-tools">
                            <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                        </div>
                    </div>
                    <div class="ibox-body">
                        <form class="form-horizontal" id="form-sample-1" method="post" action="" enctype="multipart/form-data" novalidate="novalidate">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                <input type="text" required class="form-control" placeholder="Job Name" value="<?php echo $tjname?>" name="jname"><br/>
                                </div>
                                <label class="col-sm-2 col-form-label">Location</label>
                                <div class="col-sm-10">
                                <input type="text" required class="form-control" placeholder="Job Location" value="<?php echo $tjlocation?>" name="jlocation"><br/>
                                </div>
                                <label class="col-sm-2 col-form-label">Time</label>
                                <div class="col-sm-10">
                                <input type="text" required class="form-control" placeholder="Job Time" value="<?php echo $tjtime?>" name="jtime"><br/>
                                </div>
                                <label class="col-sm-2 col-form-label">Vacancy</label>
                                <div class="col-sm-10">
                                <input type="text" required class="form-control" placeholder="Vacancy" value="<?php echo $tvac?>" name="vac"><br/>
                                </div>
                                <label class="col-sm-2 col-form-label">Company Name</label>
                                <div class="col-sm-10">
                                <input type="text" required class="form-control" placeholder="Company Name" value="<?php echo $tcname?>" name="cname"><br/>
                                </div>
                                <label class="col-sm-2 col-form-label">Employment Status</label>
                                <div class="col-sm-10">
                                <input type="text" required class="form-control" placeholder="Employment Status" value="<?php echo $testatus?>" name="estatus"><br/>
                                </div>
                                <label class="col-sm-2 col-form-label">Salary</label>
                                <div class="col-sm-10">
                                <input type="text" required class="form-control" placeholder="Salary" value="<?php echo $tsal?>" name="sal"><br/>
                                </div>
                                <label class="col-sm-2 col-form-label">Deadline</label>
                                <div class="col-sm-10">
                                <input type="text" required class="form-control" placeholder="Job Deadline" value="<?php echo $tjdeadline?>" name="jdeadline"><br/>
                                </div>
                                <label class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                <input type="text" required class="form-control" placeholder="Job Description" value="<?php echo $tjdescription?>" name="jdescription"><br/>
                                </div>
                                <label class="col-sm-2 col-form-label">Responsibility</label>
                                <div class="col-sm-10">
                                <input type="text" required class="form-control" placeholder="Responsibilities" value="<?php echo $tres?>" name="res"><br/>
                                </div>
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                <input type="text" required class="form-control" placeholder="Responsibilities1" value="<?php echo $tres1?>" name="res1"><br/>
                                </div>
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                <input type="text" required class="form-control" placeholder="Responsibilities2" value="<?php echo $tres2?>" name="res2"><br/>
                                </div>
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                <input type="text" required class="form-control" placeholder="Responsibilities3" value="<?php echo $tres3?>" name="res3"><br/>    
                                </div>
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                <input type="text" required class="form-control" placeholder="Responsibilities4" value="<?php echo $tres4?>" name="res4"><br/>
                                </div>
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                <input type="text" required class="form-control" placeholder="Responsibilities5" value="<?php echo $tres5?>" name="res5"><br/>
                                </div>
                                <label class="col-sm-2 col-form-label">Education</label>
                                <div class="col-sm-10">
                                <input type="text" required class="form-control" placeholder="Education" value="<?php echo $tedu?>" name="edu"><br/>
                                </div>
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                <input type="text" required class="form-control" placeholder="Education1" value="<?php echo $tedu1?>" name="edu1"><br/>
                                </div>
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                <input type="text" required class="form-control" placeholder="Education2" value="<?php echo $tedu2?>" name="edu2"><br/>
                                </div>
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                <input type="text" required class="form-control" placeholder="Education3" value="<?php echo $tedu3?>" name="edu3"><br/>
                                </div>
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                <input type="text" required class="form-control" placeholder="Education4" value="<?php echo $tedu4?>" name="edu4"><br/>
                                </div>
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                <input type="text" required class="form-control" placeholder="Education5" value="<?php echo $tedu5?>" name="edu5"><br/>
                                </div>
                                <label class="col-sm-2 col-form-label">Benefits</label>
                                <div class="col-sm-10">
                                <input type="text" required class="form-control" placeholder="Beenfits" value="<?php echo $tben?>" name="ben"><br/>
                                </div>
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                <input type="text" required class="form-control" placeholder="Beenfits1" value="<?php echo $tben1?>" name="ben1"><br/>
                                </div>
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                <input type="text" required class="form-control" placeholder="Beenfits2" value="<?php echo $tben2?>" name="ben2"><br/>
                                </div>
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                <input type="text" required class="form-control" placeholder="Beenfits3" value="<?php echo $tben3?>" name="ben3"><br/>
                                </div>
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                <input type="text" required class="form-control" placeholder="Beenfits4" value="<?php echo $tben4?>" name="ben4"><br/>
                                </div>
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                <input type="text" required class="form-control" placeholder="Beenfits5" value="<?php echo $tben5?>" name="ben5"><br/>
                                </div>
                                <label class="col-sm-2 col-form-label">Image</label>
                                <div class="col-sm-10">
                                <input type="file"  name="company_image"><br/><br/>
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

