<?php
session_start();
  if(isset($_SESSION['user_id']) && $_SESSION['user_type'] = "Student"){
  $user_id = $_SESSION['user_id'];    
 }
else{
  header('location:login.php');
 }
include 'includes/header.php';
include ('includes/connection.php');
include ('imageupload.php');

$conn = mysqli_connect("localhost","root");
$detail = mysqli_select_db($conn, 'Students_Jobsite');
if(isset($_POST['submit'])){
  unset($_POST['submit']);
	$sname = $_POST["sname"];
    $success_student_image = $_POST["success_student_image"];
    $dsname = $_POST["dsname"];
    $jname = $_POST["jname"];
	
    $detail = "INSERT INTO success_story(success_student_name, success_student_image, success_description, success_job_name, user_id, active)VALUES('$sname','$success_student_image','$dsname', '$jname', '$user_id', 0)";
	$detailqry = mysqli_query($conn, $detail);
    echo "<script>alert('Success Story is added successfully.');window.location.href='success_story.php';</script>";			
}
?>

    <section class="inner-banner" style="background:#242c36 url(images/xxxx.jpg) no-repeat">
		<div class="container">
			<div class="caption">
				<h2>Add Success Story</h2>
				<p>Get your dream jobs <span>2021</span></p>
			</div>
		</div>
	</section>

    <section class="login-wrapper">
			<div class="container" >
				<div class="col-md-6 col-sm-8 col-md-offset-3 col-sm-offset-2" style=" border: 2px solid white; border-style: ridge; border-radius: 12px;">
					<form class="form-horizontal" id="form-sample-1" method="post" action="" enctype="multipart/form-data">
						<img class="img-responsive" alt="logo" src="images/logooo.jpg"> 
                        <input type="text"  class="form-control" placeholder="Success Job Name" name="dsname" required>
                        <textarea type="text" class="form-control" placeholder="Success Story" name="jname"  required></textarea><br/>
						<select class="form-control" name="sname" style = "display: none;">								
							<?php
                            $conn = mysqli_connect("localhost","root");
                            $sql2 = mysqli_select_db($conn, 'Students_Jobsite');
							$sql2 = "SELECT * FROM users where user_id = $user_id";
							$result2 = mysqli_query($conn,$sql2);
							while ($row = mysqli_fetch_assoc($result2)){?>
								<option value="<?php echo $row['user_first_name']; ?>">
									<?php echo $row['user_first_name']; ?>
								</option>
							<?php } ?>
						</select>	
							
						<select class="form-control" name="success_student_image" style = "display: none;">								
							<?php $conn = mysqli_connect("localhost","root");
                            $sql2 = mysqli_select_db($conn, 'Students_Jobsite');
							$sql2 = "SELECT * FROM users where user_id = $user_id";
							$result2 = mysqli_query($conn,$sql2);
							while ($row = mysqli_fetch_assoc($result2)){?>
								<option value="<?php echo $row['user_image']; ?>">
									<?php echo $row['user_image']; ?>
								</option>
							<?php } ?>
						</select>					
						<button style="background-color:#ff8f3e;" type="submit" name="submit" value="submit" class="btn px-4 btn-primary text-white">Add</button>
                    <br/><br/>
					</form>
			</div>
		</div>
	</section>
   
  
  <?php include('includes/footer.php'); ?>

