<?php
error_reporting(0);
 include 'includes/header.php';
 include 'includes/sidebar.php';
 include ('../includes/connection.php');
include ('imageupload.php');


$error_count = 0;
$isUsed = false;
$category_id = "";
$isRegistered = 0;
$link = mysqli_connect("localhost", "root", "", "students_jobsite") or die($link);


$conn = mysqli_connect("localhost","root");
$detail = mysqli_select_db($conn, 'Students_Jobsite');
if(isset($_POST['submit'])){
  unset($_POST['submit']);

  date_default_timezone_set('Asia/Kathmandu');
	$date = date("Y-m-d h:i:sA");


	  $jname = $_POST['jname'];
    $jlocation = $_POST['jlocation'];
    $jtime = $_POST['jtime'];
    $vac = $_POST['vac'];
    $cname = $_POST['cname'];
    $estatus = $_POST['estatus'];
    $sal = $_POST['sal'];
    // $gen = $_POST['gen'];
    $jdeadline = $_POST['jdeadline'];
    $jdescription = mysqli_real_escape_string($link, $_POST['jdescription']);
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
    $user_id = $_SESSION['user_id'];  
    $category_id = $_POST['category_id'];  
  
	

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
		$imgPath = "";
	}
       


    $detail = "INSERT INTO job(job_name, job_location, job_time, vacancy, company_name, emp_status, salary, job_deadline, job_description, responsibilities, responsibilities1, responsibilities2, responsibilities3, responsibilities4, responsibilities5, education,  education1,  education2,  education3,  education4,  education5, benefits, benefits1, benefits2, benefits3, benefits4, benefits5, company_image, is_activated, category_id, user_id)VALUES('$jname', '$jlocation', '$jtime', '$vac', '$cname', '$estatus', '$sal', '$jdeadline', '$jdescription', '$res', '$res1', '$res2', '$res3', '$res4', '$res5', '$edu', '$edu1', '$edu2', '$edu3', '$edu4', '$edu5', '$ben', '$ben1', '$ben2', '$ben3', '$ben4', '$ben5', '$imgPath', '0', '$category_id', '$user_id')";

	$detailqry = mysqli_query($conn, $detail);
    echo "<script>alert('Job is added successfully.');window.location.href='job.php';</script>";			
        
}
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
            <!-- START PAGE CONTENT-->
            <div class="page-heading">
                <h1 class="page-title">Add Job</h1>
                <ol class="breadcrumb">
                    <li><a href="../../../index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Add Job</li>
                </ol>
            </div>
            <div class="page-content fade-in-up">

      <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Add a Job</div>
                        <div class="ibox-tools">
                            <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                        </div>
                    </div>
                    <div class="ibox-body">
                        <form class="form-horizontal" id="form-sample-1" method="post"  action="" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                <input type="text" required class="form-control" placeholder="Job Name" name="jname" required><br/>
                                </div>
                                <label class="col-sm-2 col-form-label">Location</label>
                                <div class="col-sm-10">
                                <input type="text" required class="form-control" placeholder="Job Location" name="jlocation" required><br/>
                                </div>
                                <label class="col-sm-2 col-form-label">Vacancy</label>
                                <div class="col-sm-10">
                                <input type="text" required class="form-control" placeholder="Vacancy" name="vac" required><br/>
                                </div>
                                <label class="col-sm-2 col-form-label">Company Name</label>
                                <div class="col-sm-10">
                                <input type="text" required class="form-control" placeholder="Company Name" name="cname" required><br/>
                                </div>
                                <label class="col-sm-2 col-form-label">Company Description</label>
                                <div class="col-sm-10">
                                <textarea class="form-control" placeholder="Job Description"  id="exampleFormControlTextarea1" rows="6" name="jdescription" required></textarea><br/>
                                </div>
                                <label class="col-sm-2 col-form-label">Employment Status</label>
                                <div class="col-sm-10">
                                <input type="text" required class="form-control" placeholder="Employment Status" name="estatus" required><br/>
                                </div>
                                <label class="col-sm-2 col-form-label">Salary</label>
                                <div class="col-sm-10">
                                <input type="text" required class="form-control" placeholder="Salary" name="sal" required><br/>
                                </div>
                                <label class="col-sm-2 col-form-label">Deadline</label>
                                <div class="col-sm-10">
                                <input type="text" required class="form-control" placeholder="Job Deadline" name="jdeadline" required><br/>
                                </div>
                                <label class="col-sm-2 col-form-label">Education</label>
                                <div class="col-sm-10">
                                <input type="text" required class="form-control" placeholder="Education" name="jtime" required><br/>
                                </div>
                                <label class="col-sm-2 col-form-label">Job Description</label>
                                <div class="col-sm-10">
                                <textarea class="form-control" placeholder="Responsibility1" id="exampleFormControlTextarea1" rows="6" name="res" required></textarea><br/>
                                </div>
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                <textarea class="form-control" placeholder="Responsibility2" id="exampleFormControlTextarea1" rows="6" name="res1" required></textarea><br/>
                                </div>
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                <textarea class="form-control" placeholder="Responsibility3" id="exampleFormControlTextarea1" rows="6" name="res2" required></textarea><br/>
                                </div>
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                <textarea class="form-control" placeholder="Responsibility4" id="exampleFormControlTextarea1" rows="6" name="res3" required></textarea><br/>
                                </div>
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                <textarea class="form-control" placeholder="Responsibility5" id="exampleFormControlTextarea1" rows="6" name="res4" required></textarea><br/>
                                </div>
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                <textarea class="form-control" placeholder="Responsibility6"  id="exampleFormControlTextarea1" rows="6" name="res5" required></textarea><br/>
                                </div>
                                <label class="col-sm-2 col-form-label">Job Specification</label>
                                <div class="col-sm-10">
                                <textarea class="form-control" placeholder="Education" id="exampleFormControlTextarea1" rows="6" name="edu" required></textarea><br/>
                                </div>
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                <textarea class="form-control" placeholder="Education1" id="exampleFormControlTextarea1" rows="6" name="edu1" required></textarea><br/>
                                </div>
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                <textarea class="form-control" placeholder="Education2"  id="exampleFormControlTextarea1" rows="6" name="edu2" required></textarea><br/>
                                </div>
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                <textarea class="form-control" placeholder="Education3"  id="exampleFormControlTextarea1" rows="6" name="edu3" required></textarea><br/>
                                </div>
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                <textarea class="form-control" placeholder="Education4" id="exampleFormControlTextarea1" rows="6" name="edu4" required></textarea><br/>
                                </div>
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                <textarea class="form-control" placeholder="Education5"  id="exampleFormControlTextarea1" rows="6" name="edu5" required></textarea><br/>
                                </div>
                                <label class="col-sm-2 col-form-label">Benefits</label>
                                <div class="col-sm-10">
                                <textarea class="form-control" placeholder="Benefits" id="exampleFormControlTextarea1" rows="6" name="ben" required></textarea><br/>
                                </div>
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                <textarea class="form-control" placeholder="Benefits1" id="exampleFormControlTextarea1" rows="6" name="ben1" required></textarea><br/>
                                </div>
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                <textarea class="form-control" placeholder="Benefits2" id="exampleFormControlTextarea1" rows="6" name="ben2" required></textarea><br/>
                                </div>
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                <textarea class="form-control" placeholder="Benefits3" id="exampleFormControlTextarea1" rows="6" name="ben3" required></textarea><br/>
                                </div>
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                <textarea class="form-control" placeholder="Benefits4" id="exampleFormControlTextarea1" rows="6" name="ben4" required></textarea><br/>
                                </div>
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                <textarea class="form-control" placeholder="Benefits5" id="exampleFormControlTextarea1" rows="6" name="ben5" required></textarea><br/>
                                </div>
                                <label class="col-sm-2 col-form-label">Image</label>
                                <div class="col-sm-10">
                                
                                <input type="file" name="company_image" required><br/>
                                </div>
                                <br/><br/>
                                <label class="col-sm-2 col-form-label">Category</label>
                                <div class="col-sm-10">
                                <select class="form-control" name="category_id" required>								
								<?php
                                    $conn = mysqli_connect("localhost","root");
                                    $sql2 = mysqli_select_db($conn, 'Students_Jobsite');
									$sql2 = "SELECT * FROM category";
									$result2 = mysqli_query($conn,$sql2);
															
									while ($row = mysqli_fetch_assoc($result2)){									
										?>
										<option value="<?php echo $row['category_id']; ?>">
											<?php echo $row['categoryname']; ?>
										</option>
										<?php
									}
								?>
							</select>	
                                 
                                
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
  
   <!-- /.content-wrapper -->
  <?php include('includes/footer.php'); ?>

